@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">

		<div class="col-md-10">
			<div class="display-4 my-4 py-2 text-center text-info">{{ $post->title }}</div>

			@can('update', $post)
			<!-- The current user can update the post... -->
			<div class="row justify-content-end">
				<a href="/posts/{{ $post->id }}/edit" class="h5 text-info mr-5">Editar</a>
			</div>
			@endcan

			<div class="row justify-content-center">
				<img src="{{ $post->photo }}" class="img-responsive w-50 my-4 border border-muted rounded shadow" />
			</div>

			<div class="text-secondary mt-3 py-1 text-center" style="font-size: 22px;">
				Autor: {{ $post->user->name }}
			</div>

			<div class="mb-4 text-center text-muted">{{ $post->created_at->format('m-d-Y') }}</div>


			<div class="text-secondary my-4 py-1" style="text-indent: 20px; font-size: 20px;">
				{{ $post->text }}
			</div>
		</div>

	</div>
</div>
@endsection