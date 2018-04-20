<?php

namespace App\Http\Controllers;

use App\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /***
     * @return mixed
     */
    public function preview() {
        return Rating::selectRaw('AVG(rating) avg, count(rating) cnt, post_id, post_title')->groupBy('post_id')->orderBy('post_title', 'asc')->get();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function save(Request $request) {

        $defaultRating = 5;
        $defaultPostId = 999;

        $rating = new Rating();
        $rating->author = $request->author ? : 'author';
        $rating->rating = $request->rating ? : $defaultRating;
        $rating->post_id = $request->post_id ? : $defaultPostId;
        $rating->post_title = $request->post_title ? : 'test';
        $rating->comment = $request->comment ? : '';
        $rating->save();

        $average = Rating::where('post_id', $rating->post_id)->avg('rating');

        return ['avg' => $average];
    }
}
