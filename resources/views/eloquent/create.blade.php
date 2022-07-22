@extends('layouts.app')

@section('title', '| Registrar')

@section('content')
    <div class="min-vh-100 d-flex justify-content-center align-items-center">
        <form class="mw-100" action="/clients/store" method="post" style="width: 400px;">
            @csrf
            @method('post')
            <h1 class="mb-5 text-secondary text-center">Cadastro do cliente</h1>

            <div class="mb-3">
                <input class="form-control" name="name" placeholder="Nome" required>
            </div>

            <div class="mb-3">
                <input class="form-control" type="email" name="email" placeholder="E-mail" required>
            </div>

            <div class="mb-3">
                <input class="form-control" type="tel" name="phone" placeholder="Número do telefone" required>
            </div>

            <div class="mb-3">
                <input class="form-control" type="number" name="id_number" placeholder="Id do número" required>
            </div>

            <h1 class="mb-5 text-secondary text-center">Cadastro da Bill</h1>

            <div class="mb-3">
                <input class="form-control" type="number" name="invoice" placeholder="Invoice" required>
            </div>
            
            <div class="mb-3">
                <input class="form-control" type="number" name="installment" placeholder="installment" required>
            </div>
            
            <div class="mb-3">
                <input class="form-control" name="value" placeholder="value" required>
            </div>


            <div class="d-grid gap-2">
                <button class="btn btn-outline-primary" type="submit">Cadastrar</button>
                <a class="link-secondary" href="{{ route('login') }}">Login</a>
            </div>
        </form>
    </div>
@endsection
