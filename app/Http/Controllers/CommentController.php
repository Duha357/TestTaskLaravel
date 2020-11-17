<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'articleId' => 'integer|min:1',
            'topic' => 'required|string|between:1,255',
            'text' => 'required|string',
        ]);

        $comment = new Comment();
        $comment->article_id = $request->input('articleId');
        $comment->topic = $request->input('topic');
        $comment->text = $request->input('text');
        $comment->save();

        return response()->json([
            'status' => '200',
            'topic' => $comment->topic,
        ]);
    }
}
