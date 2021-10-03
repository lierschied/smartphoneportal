<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Smartphone;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RatingController extends Controller
{
    public function update(Request $request, Smartphone $smartphone): RedirectResponse
    {
        $request->validate(['stars' => 'required|min:0|max:5']);
        $rating = Rating::firstOrCreate([
            'smartphone_id' => $smartphone->id,
            'user_id' => Auth::id(),
        ]);

        $rating->update([
            'stars' => (string)$request->input('stars')
        ]);

        return Redirect::back(303);
    }
}
