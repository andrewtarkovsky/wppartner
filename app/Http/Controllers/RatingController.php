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

        $request->validate([
            'author' => 'required',
            'rating' => 'required|integer|between:1,5',
            'post_id' => 'required',
            'post_title' => 'required',
            'comment' => 'required'
        ]);

        $rating = new Rating();
        $rating->author = $request->author;
        $rating->rating = $request->rating;
        $rating->post_id = $request->post_id;
        $rating->post_title = $request->post_title;
        $rating->comment = $request->comment;
        $rating->save();

        $average = Rating::where('post_id', $rating->post_id)->avg('rating');

        return ['avg' => $average];
    }
}
