<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function index() 
    {
        $comment = Comment::latest()->with(['user', 'image', 'likes']);

        return view('comments.index',[
            'comments' => $comments
        ]);
    }


    public function store(Request $request, Image $image)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->image_id = $image->id;
        $comment->user_id = auth()->id;
        $comment->save();

        return redirect()->back();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back();
    }
}
