@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <input type="text" id="filterUser" class="form-control" placeholder="Filtrer" style="width: 40%;float: right;">

            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                            <th>Nom d'utilisateur</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody id="listUsers">
                    @foreach ($users as $user)
                        <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if( $user->isAdmin == 0 )
                                        Utilisateur
                                    @else
                                        Admin
                                    @endif
                                </td>
                                <td>
                                    @if( $user->isAdmin == 0 )
                                        <form action="{{ route('setUserAsAdmin',['id'=>$user->id]) }}" method="post">
                                            @csrf
                                            <button type="submit"  class="btn btn-info"> Definir comme Admin </button>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    @if( $user->isAdmin == 0 )
                                        <form action="{{route('deleteUser',['id'=>$user->id])}}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Voulez-vous supprimer cet utilisateur!')"> Supprimer </button>
                                        </form>
                                    @endif
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
  $("#filterUser").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#listUsers tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
@endsection