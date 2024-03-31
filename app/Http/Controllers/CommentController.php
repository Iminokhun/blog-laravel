<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\Commet;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = Commet::create([
            'body' => $request->body,
            'post_id' => $request->post_id,
            'user_id' => auth()->id(),
        ]);
        return redirect()->back();

        // $post = Post::find($request->post_id);    SECOND VERSION
        // $post->comments()->create([
        //     'body' => $request->body,
        //     'user_id' => $request->user_id,
        // ]);
    }
    
}
