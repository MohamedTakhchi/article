@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <input type="text" id="filterPost" class="form-control" placeholder="Filtrer" style="width: 40%;float: right;">

            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody id="listPosts">
                    @foreach ($posts as $post)
                        <tr>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->body }}</td>
                                <td>
                                    <img src="/Images/{{ $post->image }}" width="50px" height="50px" alt="Pas d'image dispponible">
                                </td>
                                <td>
                                    <form action="{{ route('updatePostForm',['id'=>$post->id]) }}">
                                        <button type="submit"  class="btn btn-success"> Modifier </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('deletePost',['id'=>$post->id])}}" method="post">
                                        @csrf
                                        <input type="hidden" name="deleteForUser" value="1">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Voulez-vous supprimer cet Article!')"> Supprimer </button>
                                    </form>
                                </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
  $("#filterPost").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#listPosts tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
@endsection