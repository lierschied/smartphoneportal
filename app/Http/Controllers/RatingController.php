<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Smartphone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RatingController extends Controller
{
    public function update(Request $request, Smartphone $smartphone)
    {
        $request->validate(['stars' => 'required|min:0|max:5']);
        $newRating = Rating::make();
        $newRating->smartphone_id = $smartphone->id;
        $newRating->user_id =  Auth::id();
        $newRating->stars = (string) $request->stars;
        $newRating->save();

        return Redirect::back(303);
    }
}
