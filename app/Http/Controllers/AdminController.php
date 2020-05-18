<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Auth;

class AdminController extends Controller
{
    public function __construct() {

        $this->middleware('auth');
    }

    public function users() {

    	$users = User::All();
    	return view('admin.users',['users' => $users]);
    }

    public function posts() {

    	$posts = Post::All();
    	return view('admin.posts',['posts' => $posts]);
    }

}
