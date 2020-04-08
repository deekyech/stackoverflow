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
								    <a href="#" title="Up vote" class="d-block text-dark text-center">
									    <i class="fa fa-caret-up fa-3x" aria-hidden="true"></i>
								    </a>
								    <h4 class="text-dark m-0 text-center">{{ $question->votes_count }}</h4>
								    <a href="#" title="Down vote" class="d-block text-dark text-center">
									    <i class="fa fa-caret-down fa-3x" aria-hidden="true"></i>
								    </a>
							    </div>
							    <div class="ml-5 mt-2">
								    <a href="#" title="Mark as favourite" class="d-block text-center">
									    <i class="fa fa-star fa-2x text-dark" aria-hidden="true"></i>
								    </a>
								    <h4 class="text-dark m-0">45</h4>
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