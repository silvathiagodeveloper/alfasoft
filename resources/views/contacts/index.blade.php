@extends('adminlte::page')

@section('title', 'Contatos')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('contacts.index') }}">Contatos</a></li>
    </ol>
    <h1>Contatos 
        @if (Auth::check()) 
            <a href="{{ route('contacts.create') }}" class="btn btn-dark"><i class="fas fa-plus-square"></i> Adicionar</a>
        @endif
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Contato</th>
                        <th>Email</th>
                        @if (Auth::check()) 
                            <th>Ações</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                    <tr>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->contact }}</td>
                        <td>{{ $contact->email }}</td>
                        @if (Auth::check()) 
                            <td style="width: 390px;">
                                <a href="{{ route('contacts.show',$contact->id) }}" class="btn btn-info"><i class="fas fa-eye"></i> Ver</a>
                                <a href="{{ route('contacts.edit',$contact->id) }}" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Editar</a>
                                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style=" display:inline!important;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" id="btnDelete" class="btn btn-danger"><i class="fas fa-trash"></i> Apagar</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
    @include('includes.alerts')
@stop