<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function setAdmin($id)
    {
    	$user = User::find($id);
    	$user->isAdmin = 1;
    	$user->save();
    	return redirect()->route('configUsers')->with('success', $user->name.' est devenu un Admin');
    }

    public function delete($id)
    {
    	$user = User::find($id);
    	$user->delete();
    	return redirect()->route('configUsers')->with('success', $user->name.' est supprimé');
    }

    
}
