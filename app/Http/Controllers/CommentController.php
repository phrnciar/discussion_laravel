<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Show all comments
     *
     * @return string
    */
    public function index()
    {
        $comments = Comment::get();
        
        return view('index', ['comments' => $comments]);
    }


    /**
     * Handle form requests
     *
     * @param Request $request 
    */
    public function handle(Request $request)
    {

        if($request->delete){
            
            $comment = Comment::find($request->parent_id);
            
            $comment->replies()->delete();
            
            $comment->delete();

        }

        if($request->edit){

            $comment = Comment::find($request->parent_id);

            $request->validate([
                'editMessage'=>'required'
            ]);
            
            $comment->message = $request->editMessage;
            $comment->save();
        }

        if($request->save){
            
            $newComment = $request->all();
            
            $request->validate([
                'name'=>'required',
                'message'=>'required',
            ]);
               
            Comment::create($newComment);
        }

        return back();
    }
}
