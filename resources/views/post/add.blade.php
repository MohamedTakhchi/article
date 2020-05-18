@extends('layouts.app')

@section('content')


	<form action="{{route('createPost')}}" method="post" enctype="multipart/form-data">
	@csrf

		<div class="form-group">
		    <label for="title">Titre :</label>
		    <input type="text" class="form-control" id="title" name="title">
		</div>

		<div class="form-group">
		    <label for="body">Description :</label>
		    <textarea class="form-control" name="body" id="body" rows="6"></textarea>
		</div>

		<div class="custom-file">
		    <input type="file" accept="image/*" class="custom-file-input" id="customFile" name="image">
		    <label class="custom-file-label" for="customFile">Choisir une image</label>
		</div>

		<div class="mt-3">
			<button type="submit" class="btn btn-primary">Ajouter</button>
		</div>

	</form>

	<script>
		$(".custom-file-input").on("change", function() {
		  var fileName = $(this).val().split("\\").pop();
		  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});
	</script>

@endsection