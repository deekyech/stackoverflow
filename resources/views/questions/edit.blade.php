@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3>Edit Question!</h3>
					</div>
					<div class="card-body">
						<form action="{{ route('questions.update', $question->id) }}" method="POST">
							@csrf
							@method('PUT')
							<div class="form-group">
								<label for="title">Title</label>
								<input type="text" name="title" id="title" placeholder="Enter Title!" class="form-control {{ $errors->has('title')? 'is-invalid': ''}}" value="{{ old('title', $question->title) }}">
								@error('title')
								<div class="text-danger">Title already used.</div>
								@enderror
							</div>
							
							<div class="form-group">
								<input id="body" type="hidden" name="body" value="{{ old('body', $question->body) }}">
								<trix-editor input="body"></trix-editor>
								@error('body')
								<div class="text-danger"></div>
								@enderror
							</div>
							
							<div class="form-group">
								<input type="submit" class="btn btn-outline-success" name="submit" value="Post the Question!">
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