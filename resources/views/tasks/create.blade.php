@extends('layouts.app')

@section('title', 'Criar task')

@section('content')
    <h1>Criar task</h1>

    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        @include('tasks._form', ['submitLabel' => 'Salvar'])
    </form>
@endsection
