@extends('adminlte::page')

@section('title', 'Cadastrar Novo Contato')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('contacts.index') }}">Contatos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('contacts.create') }}">Novo</a></li>
    </ol>
    <h1>Cadastrar Novo Contato</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form id="frmMain" action="{{ route('contacts.store') }}" class="form" method="POST">
                @csrf
                @include('contacts._partials.form')
            </form>
        </div>
    </div>
@stop