@extends('layouts.app')

@section('content')
    <div class="container">
	    <div class="row">
		    <div class="col-md-12">
			    <div class="card">
				    <div class="card-header">
					    <h3>Edit Your Answer</h3>
				    </div>
				    <div class="card-body">
					    <form action="{{ route('questions.answers.update', [$question->id, $answer->id]) }}" method="POST">
						    @csrf
						    @method('PUT')
						
						    <div class="form-group">
							    <input id="body" type="hidden" name="body" value="{{ old('body', $answer->body) }}">
							    <trix-editor input="body"></trix-editor>
							    @error('body')
							    <div class="text-danger"></div>
							    @enderror
						    </div>
						
						    <div class="form-group">
							    <input type="submit" class="btn btn-outline-success" name="submit" value="Update Answer!">
						    </div>
					    </form>
				    </div>
			    </div>
		    </div>
	    </div>
    </div>
@endsection

@section('page-styles')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" integrity="sha256-yebzx8LjuetQ3l4hhQ5eNaOxVLgqaY1y8JcrXuJrAOg=" crossorigin="anonymous" />
@endsection

@section('page-scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js" integrity="sha256-2D+ZJyeHHlEMmtuQTVtXt1gl0zRLKr51OCxyFfmFIBM=" crossorigin="anonymous"></script>
@endsection