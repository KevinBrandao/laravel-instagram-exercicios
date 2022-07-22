@extends('layouts.app')

@section('title', '| Criar Post')

@section('content')
    @include('components.navbar');
    <div class="min-vh-100 d-flex justify-content-center align-items-center">

        <form action="/photo" method="post" class="mw-100" enctype="multipart/form-data">
            @csrf
            <h1 class="text-secondary text-center mb-5">
                Criar post
            </h1>

            <input class="form-control mb-3" type="file" name="photo" accept="image/*">

            <button type="submit" class="btn btn-primary w-100">
                Enviar
            </button>
        </form>

    </div>
@endsection
