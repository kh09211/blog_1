@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">

			<div class="text-center display-4 my-4 text-info">Contacto</div>

			<div class="card">

				<div class="card-body">
					@if (session('status'))
					<div class="alert alert-success" role="alert">
						{{ session('status') }}
					</div>
					@endif

					<form action="/contact/store" method="POST">
						@csrf

						<div class="form-group row my-4">
							<label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre: ') }}</label>

							<div class="col-md-6">
								<input id="nombre" type="text" class="form-control @error('email') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

								@error('nombre')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row my-4">
							<label for="correo" class="col-md-4 col-form-label text-md-right">{{ __('Correo: ') }}</label>

							<div class="col-md-6">
								<input id="correo" type="email" class="form-control @error('correo') is-invalid @enderror" name="correo" value="{{ old('correo') }}" required autocomplete="correo" autofocus>

								@error('correo')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row my-4">
							<label for="mensaje" class="col-md-4 col-form-label text-md-right">{{ __('Mensaje: ') }}</label>

							<div class="col-md-6">
								<textarea id="mensaje" style="height: 100px;" class="form-control @error('mensaje') is-invalid @enderror" name="mensaje" value="{{ old('mensaje') }}" required autocomplete="mensaje" autofocus></textarea>

								@error('mensaje')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row my-4 justify-content-center">
							<button class="btn btn-primary text-center ml-5">Enviar</button>
						</div>

					</form>

				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection