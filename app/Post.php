<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
    public function user()
	{
	    return $this->belongsTo('App\User')->withDefault();
	}

	public function likes()
	{
		return $this->belongsToMany('App\User','likes')->withTimestamps();
	}

	public function saves()
	{
		return $this->belongsToMany('App\User','saves')->withTimestamps();
	}
}
