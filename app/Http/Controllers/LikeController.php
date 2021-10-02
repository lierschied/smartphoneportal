<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function getLikesCount(Comment $comment)
    {
        $totalCount = $comment->likes->count();
        $avg = $totalCount > 0 ? $comment->like_count / $comment->likes->count() : 0;
        return [
            'likes' => $comment->like_count,
            'dislikes' => $comment->dislike_count,
            'avg' => $avg
        ];
    }
}
