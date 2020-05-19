@extends('layouts.app')

@section('content')

	@foreach( $posts as $post )

		<div class="card" style="width: 60%;margin: auto;margin-bottom: 3em;border-radius: 16px;" >

			<div class="card-body">
		   		<h1 class="card-title">{{ $post->title }}</h1>
		    	<p class="card-text">{{ $post->body }}</p>
		    	<small style="float: right;">
	  				par : <b>{{ $post->user->name }}</b>
	  				le : {{ $post->created_at }}
	  			</small>

	  		@if( $post->image )
		    	<img class="card-img-bottom" src="/Images/{{ $post->image }}">
		    @endif

	  		</div>

		</div>

	@endforeach

	<div style="width: fit-content;margin: auto;">
		{{ $posts->links() }}
	</div>

@endsection


          
       
        
