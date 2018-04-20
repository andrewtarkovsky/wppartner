jQuery(document).ready(function() {
  var $rating = jQuery('.comment-rating');
  var $comment = jQuery('.comment-form-comment');
  $rating.prependTo($comment);
  $rating.show();
  // jQuery('.comment-rating').prependTo(jQuery('.comment-form-comment'));//alert('hello');
});