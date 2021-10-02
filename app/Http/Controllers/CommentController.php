<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CommentController extends Controller
{
    public function like(Request $request, Comment $comment)
    {
        $request->validate(
            [
                'type' => [
                    'required',
                    Rule::in(['Like', 'Dislike', 'delete'])
                ]
            ]);

        if ($request->type === 'delete') {
            $comment->likes()->where(['user_id' => Auth::id()])->delete();
            return back(303);
        }

        $comment->likes()->where([
            'user_id' => Auth::id(),
        ])->firstOrCreate([
            'user_id' => Auth::id()
        ]);

        $comment->likes()->where([
            'user_id' => Auth::id(),
        ])->update([
            'type' => $request->type
        ]);

        return back(303);
    }
}
