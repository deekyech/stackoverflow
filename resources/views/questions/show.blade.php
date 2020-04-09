@extends('layouts.app')

@section('content')
    <div class="container">
	    <div class="row">
		    <div class="col-md-12">
			    <div class="card">
				    <div class="card-header">
					    <h1>{{ $question->title }}</h1>
				    </div>
				    <div class="card-body">
					    {!! $question->body !!}
				    </div>
				    <div class="card-footer">
					    {{-- To display the information of the owner --}}
					    <div class="d-flex justify-content-between">
						    <div class="d-flex">
							    <div>
								    @auth
									    <form action="{{ route('questions.vote', [$question->id, 1]) }}" method="post">
										    @csrf
										    <button type="submit"
										            class="btn {{ auth()->user()->hasQuestionUpVote($question) ? 'text-dark' : 'text-black-50'}}">
											    <i class="fa fa-caret-up fa-3x" aria-hidden="true"></i>
										    </button>
									    </form>
								    @else
									    <a href="{{ route('login') }}" title="Up vote" class="d-block text-black-50 text-center">
										    <i class="fa fa-caret-up fa-3x" aria-hidden="true"></i>
									    </a>
								    @endauth
								    <h4 class="text-dark m-0 text-center">{{ $question->votes_count }}</h4>
								    @auth
									    <form action="{{ route('questions.vote', [$question->id, -1]) }}" method="post">
										    @csrf
										    <button type="submit"
										            class="btn {{ auth()->user()->hasQuestionDownVote($question) ? 'text-dark' : 'text-black-50'}}">
											    <i class="fa fa-caret-down fa-3x" aria-hidden="true"></i>
										    </button>
									    </form>
								    @else
									    <a href="{{ route('login') }}" title="Down vote" class="d-block text-black-50 text-center">
										    <i class="fa fa-caret-down fa-3x" aria-hidden="true"></i>
									    </a>
								    @endauth
							    </div>
							    <div class="ml-5 mt-4 {{$question->is_favorite ? 'text-warning': 'text-black'}}">
								    @can('markAsFavorite', $question)
									    <form action="{{ route($question->is_favorite ? 'questions.unfavorite' : 'questions.favorite', $question->id) }}" method="post">
										    @csrf
										    @if ($question->is_favorite)
										        @method('DELETE')
										    @endif
										    <button class="btn" type="submit">
											    <i class="fa  {{$question->is_favorite ? 'fa-star text-warning': 'fa-star-o text-black'}} fa-2x" aria-hidden="true"></i>
										    </button>
									    </form>
									    <h4 class="text-center m-0">{{ $question->favorites_count }}</h4>
								    @else
									    <i class="fa fa-star-o text-warning fa-2x" aria-hidden="true"></i>
									    <h4 class="text-center text-warning m-0">{{ $question->favorites_count }}</h4>
								    @endcan
							    </div>
						    </div>
						    <div class="d-flex flex-column">
							    <div class="text-muted flex-column">
								    Asked: {{ $question->created_date }}
							    </div>
							    <div class="d-flex mb-2">
								   <div>
									   <img src="{{ $question->owner->avatar }}" alt="{{ $question->owner->name }}">
								   </div>
								    <div class="mt-2 ml-2">
									    {{ $question->owner->name }}
								    </div>
							    </div>
						    </div>
					    </div>
				    </div>
			    </div>
		    </div>
	    </div>
	    
	    @include('answers._index')
	    @include('answers._create')
    </div>
@endsection

@section('page-styles')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" integrity="sha256-yebzx8LjuetQ3l4hhQ5eNaOxVLgqaY1y8JcrXuJrAOg=" crossorigin="anonymous" />
@endsection

@section('page-scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js" integrity="sha256-2D+ZJyeHHlEMmtuQTVtXt1gl0zRLKr51OCxyFfmFIBM=" crossorigin="anonymous"></script>
@endsection