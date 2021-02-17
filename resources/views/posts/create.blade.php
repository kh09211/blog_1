@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header text-center" style="background-color: #e3f2fd;">{{ __('Nueva Entrada de Blog') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form action="/posts" method="POST">
                        @csrf

                        <div class="form-group row my-4">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Titulo: ') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row my-4">
                            <label for="text" class="col-md-4 col-form-label text-md-right">{{ __('Texto: ') }}</label>

                            <div class="col-md-6">
                                <textarea id="text" style="height: 100px;" class="form-control @error('text') is-invalid @enderror" name="text" value="{{ old('text') }}" required autocomplete="text" autofocus></textarea>

                                @error('text')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row my-4">
                            <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Foto URL: ') }}</label>

                            <div class="col-md-6">
                                <input id="photo" type="url" class="form-control @error('photo') is-invalid @enderror" name="photo" value="{{ old('photo') }}" required autocomplete="photo" autofocus>

                                @error('photo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row my-4 justify-content-center">
                            <button class="btn btn-primary text-center">Crear</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection