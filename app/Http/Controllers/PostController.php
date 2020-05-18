<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addForm()
    {
    	return view('post.add');
    }

    public function create(Request $request)
    {
    	$request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $post = new Post();
    	$post->title = $request->title;
    	$post->body = $request->body;

    	if ($files = $request->file('image')) {
            $destinationPath = public_path('/Images/');
            $image = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $image);
            $post->image = $image;
         }

    	$post->user()->associate(Auth::id());
    	$post->save();
    	return redirect()->route('addPostForm')->with('success', 'Article Ajouté');
    }

    public function userPosts()
    {
    	$posts = Post::All();
    	return view('post.list', ['posts' => $posts]);
    }

    public function updateForm($id)
    {
    	$post = Post::find($id);
    	return view('post.update', ['post' => $post]);

    }

    public function update(Request $request)
    {
    	$request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $post = Post::find($request->id);
    	$post->title = $request->title;
    	$post->body = $request->body;

    	if ($files = $request->file('image')) {
            $destinationPath = public_path('/Images/');
            $image = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $image);
            $post->image = $image;
         }

    	$post->save();
    	return redirect()->route('userPosts')->with('success', 'Article Modifié');
    }

    public function delete($id, Request $request)
    {
    	$post = Post::find($id);
    	$post->delete();

    	if( $request->deleteForUser )
    		return redirect()->route('userPosts')->with('success', 'Article Supprimé');
    }
}
