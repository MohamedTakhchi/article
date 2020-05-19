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
    	$posts = Auth::user()->posts()->get();
    	return view('post.list', ['posts' => $posts]);
    }

    public function savedPosts()
    {
        $posts = Auth::user()->saves()->orderBy('saves.created_at','desc')->paginate(5);
        return view('post.saved', ['posts' => $posts]);
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

    	if( $request->deleteForAdmin )
    		return redirect()->route('configPosts')->with('success', 'Article Supprimé');
    }


    public function liked(Request $request)
    {
        if ($request->ajax()) {

            $post = Post::find($request->post_id);
            $post->likes()->attach($request->user_id);

            return 1;
        }
    }

    public function unliked(Request $request)
    {
        if ($request->ajax()) {

            $post = Post::find($request->post_id);
            $post->likes()->detach($request->user_id);

            return 1;
        }
    }


    public function saved(Request $request)
    {
        if ($request->ajax()) {

            $post = Post::find($request->post_id);
            $post->saves()->attach($request->user_id);

            return 1;
        }
    }

    public function unsaved(Request $request)
    {
        if ($request->ajax()) {

            $post = Post::find($request->post_id);
            $post->saves()->detach($request->user_id);

            return 1;
        }
    }

}
