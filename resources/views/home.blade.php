@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1>Home</h1>
@stop

@section('content')
@if (Route::has('login'))
    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
        @auth

        @else
            Para criar, editar ou excluir contatos, você precisa estar logado<br>
            Caso ainda não tenha um login, você pode se registrar.<br>

            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Registre-se</a>
            @endif
        @endauth
    </div>
    @endif
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop