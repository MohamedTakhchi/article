@extends('layouts.app')

@section('content')

    @foreach( $posts as $post )

        <div class="card" id="card" style="width: 60%;margin: auto;margin-bottom: 3em;border-radius: 16px;" >

            <div class="card-body">
                <h1 class="card-title">{{ $post->title }}</h1>
                <p class="card-text">{{ $post->body }}</p>
                <small style="float: right;">
                    par : <b>{{ $post->user->name }}</b>
                    le : {{ $post->created_at }}
                </small>
                <br/>

            @if( $post->image )
                <img class="card-img-bottom" src="/Images/{{ $post->image }}">
            @endif

            <hr>
            <div class="row">
                <button type="button" id="like" data-userId="{{ Auth::user()->id }}" data-postId="{{ $post->id }}" class="btn btn-light" style="width: 50%;">
                    @if( count($post->likes) > 0 )
                        @for ($i = 0; $i < count($post->likes); $i++)
                            @if( $post->likes[$i]->pivot->user_id == Auth::user()->id )
                                <span class="fas fa-heart" style="color: red;"></span>Dislike
                                @break
                            @else
                                @if( count($post->likes) == ($i+1) )
                                    <span class="far fa-heart"></span>Like
                                @endif
                            @endif
                        @endfor
                    @else
                        <span class="far fa-heart"></span>Like
                    @endif
                </button>
                <button type="button" id="unsave" data-userId="{{ Auth::user()->id }}" data-postId="{{ $post->id }}" class="btn btn-light" style="width: 50%;">
                    <span class="fas fa-bookmark" style="color: #191970;"></span>Annuler Enregistrement
                </button>
            </div>

            </div>

        </div>

    @endforeach

    <div style="width: fit-content;margin: auto;">
        {{ $posts->links() }}
    </div>


    <!-- Message a afficher apres aimer un post -->
    <button type="button" id="likeModalButton" data-toggle="modal" data-target="#likeModal" style="display: none;">
        save model
    </button>
     <!-- The Modal -->
      <div class="modal fade" id="likeModal">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
          </div>
        </div>
      </div>

    <!-- Message a afficher apres enregistrer un post -->
    <button type="button" id="saveModalButton" data-toggle="modal" data-target="#saveModal" style="display: none;">
        save model
    </button>
     <!-- The Modal -->
      <div class="modal fade" id="saveModal">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
          </div>
        </div>
      </div>

<script src="{{ asset('js/functions.js') }}"></script>
@endsection
