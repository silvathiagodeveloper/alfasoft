@extends('adminlte::page')

@section('title', "Contato {$contact->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('contacts.index') }}">Contatos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('contacts.show', $contact->id) }}">{{ $contact->name }}</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('contacts.edit', [$contact->id]) }}">Editar</a></li>
    </ol>
    <h1>Contato - {{ $contact->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form id="frmMain" action="{{ route('contacts.update', $contact->id) }}" class="form" method="POST">
                @csrf
                @method('PUT')
                @include('contacts._partials.form')
            </form>
        </div>
    </div>
@stop