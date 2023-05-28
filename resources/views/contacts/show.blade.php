@extends('adminlte::page')

@section('title', "Contato - {$contact->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('contacts.index') }}">Contatos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('contacts.show', $contact->id) }}">{{ $contact->name }}</a></li>
    </ol>
    <h1>Contato - <b>{{ $contact->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @include('includes.alerts')
            <ul>
                <li>
                    <strong>Nome:</strong> {{ $contact->name }}
                </li>
                <li>
                    <strong>Contato:</strong> {{ $contact->contact }}
                </li>
                <li>
                    <strong>Email:</strong> {{ $contact->email }}
                </li>
            </ul>
            <a href="{{ route('contacts.edit',$contact->id) }}" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Editar</a>
            <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style=" display:inline!important;">
                @csrf
                @method('DELETE')
                <button type="submit" id="btnDelete" class="btn btn-danger"><i class="fas fa-trash"></i> Apagar</button>
            </form>
        </div>
    </div>
@stop