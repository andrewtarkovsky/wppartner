<?php
/**
 * @package VF_CommentRatings
 * @version 0.001
 */
/*
Plugin Name: VF Comment Ratings
Description: Simple plugin to rate post you're reading using comment form.
Author: Victor
Version: 0.1
*/

class VFCommentRating {

    const API_URL = 'http://wppartner.test';
    const APIPOINT_SAVE = '/api/rating/save/';

    public function __construct() {
        add_action( 'comment_form_top', array($this, 'vfcr_add_rating_box'));
        add_filter( 'preprocess_comment', array($this, 'vfcr_check_rating'));
        add_action( 'comment_post', array($this, 'vfcr_save_data' ));
    }

    /**
     * add field
     */
    public function vfcr_add_rating_box( ) {
        wp_enqueue_style( 'vfcr_style', plugin_dir_url( __FILE__ ) . 'style.css' );
        wp_enqueue_script( 'vfcr_js', plugin_dir_url( __FILE__ ) . 'script.js', array('jquery'),'1.0' , true );

        echo '
          <p class="comment-rating" id="comment-rating" style="display:none;">
            <label for="rating">Rating *</label>
            <select name="rating" class="comment-rating__input">
              <option value="">-</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </p>';
    }

    /**
     * on submit: check if exists
     * @param $data
     * @return mixed
     */
    public function vfcr_check_rating($data) {
        if (empty($_POST['rating'])) {
            wp_die(__('<p><strong>Error:</strong> Please rate!</p><p><a href="javascript:history.back()">« Back</a></p>'));
        }

        return $data;
    }

    /**
     * on submit: save rating using api point, add average rating from api to post
     * @param $comment_id
     */
    public function vfcr_save_data( $comment_id ) {
        $rating         = (empty($_POST['rating'])) ? FALSE : $_POST['rating'];
        $commentText    = empty($_POST['comment'])?'':$_POST['comment'];

        $author         = wp_get_current_user()->display_name?:$_POST['author'];
        $post           = get_post($_POST['comment_post_ID']);

        $result         = $this->callApi($post, $commentText, $rating, $author);

        update_post_meta($post->ID, 'rating_avg', $result['avg']);
    }

    /**
     * * Save rating data on api src
     * @param WP_Post $post
     * @param $commentText
     * @param $rating
     * @param $author
     * @return array|mixed|object
     */
    protected function callApi(WP_Post $post, $commentText, $rating, $author) {
        $url = self::API_URL . self::APIPOINT_SAVE;
        $params = [
            'author'        => $author,
            'rating'        => $rating,
            'post_id'       => $post->ID,
            'post_title'    => $post->post_title,
            'comment'       => $commentText
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result, true);
        return $result;
    }
}

$vfcr = new VFCommentRating();

?>
