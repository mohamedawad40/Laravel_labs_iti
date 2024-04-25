<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('comments.index', ['comments' => $comments]);
    }

    public function create($postID)
    {
        // Your code to display the form for creating a new comment
        return view('comments.create',['id'=>$postID]);
    }

    public function store(Request $request)
    {
        Comment::create([
            'post_id' => $request->post_id,
            'body' => $request->body,
            'user_id' => Auth::id(),

        ]);
        return redirect("/posts/$request->post_id");
    }


    public function show($id)
    {
        $comment = Comment::find($id);
        return view('comments.show', ['comment' => $comment]);
    }



}
