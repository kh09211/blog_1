@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="text-center display-4 text-info">Blog</div>

			@can('create', App\Models\Post::class)
			<!-- The current user can create the post... -->
			<form action="/posts/create" method="GET">
				<div class="row justify-content-end">
					<button class="btn btn-primary mr-5">Nueva Entrada Blog</button>
				</div>
			</form>
			@endcan

			@foreach($posts as $post)
			<div class="card my-5">
				<div class="card-body">
					<a href="/posts/{{ $post->id }}" class="d-block h2 my-2 text-center text-info">{{ $post->title }}</a>

					@can('update', $post)
					<!-- The current user can update the post... -->
					<div class="row justify-content-end">
						<a href="/posts/{{ $post->id }}/edit" class="h5 text-info mr-5">Editar</a>
					</div>
					@endcan

					<div class="row justify-content-center">
						<img src="{{ $post->photo }}" class="text-center w-25 shadow border border-muted my-3" />
					</div>

					<div class="h3 mt-2 mb-1 text-center text-secondary">Autor: {{ $post->user->name }}</div>

					<div class="mb-2 text-center text-muted">{{ $post->created_at->format('m-d-Y') }}</div>

					<div class="row no-gutters" style="height: 50px; overflow-y: hidden;">
						<div class="col-11">
							<div class="text-left my-4 ml-5" style="text-indent: 20px; font-size: 18px; overflow-x: hidden;">{{ $post->text }}</div>
						</div>
						<div class="col-1 text-left my-4" style="font-size: 18px;">
							...
						</div>
					</div>

					<a href="/posts/{{ $post->id }}" class="d-block mb-2 text-center text-info">Leer Mas!</a>

				</div>
			</div>
			@endforeach

		</div>
	</div>
</div>
@endsection