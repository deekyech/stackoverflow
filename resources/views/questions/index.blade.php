@extends('layouts.app')

@section('content')
    <div class="container">
	    <div class="row">
		    <div class="col-md-12">
			    <div class="d-flex justify-content-end mb-3">
				    <a href="{{ route('questions.create') }}" class="btn btn-outline-primary">Ask a question!</a>
			    </div>
			    <div class="card">
				   <div class="card-header">All Questions</div>
				   @foreach($questions as $question)
					   <div class="card-body">
						   <div class="media">
							   <div class="d-flex flex-column mr-4 statistics">
								   <div class="text-center mb-3">
									   <strong class="d-block">{{ $question->votes_count }}</strong>
									   Votes
								   </div>
								   <div class="text-center mb-3 answers {{ $question->answers_style }}">
									   <strong class="d-block">{{ $question->answers_count }}</strong>
									   Answers
								   </div>
								   <div class="text-center">
									   <strong class="d-block">{{ $question->views_count }}</strong>
									   Views
								   </div>
							   </div>
							   <div class="media-body">
								   <div class="d-flex justify-content-between">
									   <h4><a href="{{ $question->url }}">{{ $question->title }}</a></h4>
									   <div class="d-flex flex-row">
										   @can('update', $question)
											   <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-outline-primary mr-3">Edit</a>
										   @endcan
										   @can('delete', $question)
											   <form action="{{ route('questions.destroy', $question->id) }}" method="POST">
												   @csrf
												   @method('DELETE')
												   <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this?')">Delete</button>
											   </form>
										   @endcan
									   </div>
								   </div>
								   <p>
									   Asked By: <a href="#">{{ $question->owner->name }}</a>
									   <span class="text-muted">{{ $question->created_date }}</span>
								   </p>
								   {{-- In blade {!!  !!} tags denote that it uses html_escape_sequence, this means that the html will be rendered. --}}
								   <p>{!! Str::limit($question->body, 250) !!}</p>
							   </div>
						   </div>
					   </div>
					   <hr>
				   @endforeach
				   <div class="card-footer">
					   {{ $questions->links() }}
				   </div>
			   </div>
		    </div>
	    </div>
    </div>
@endsection