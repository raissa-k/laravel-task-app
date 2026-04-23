@extends('layouts.app')

@section('title', 'Editar task')

@section('content')
    <h1>Editar task #{{ $task->id }}</h1>

    <form method="POST" action="{{ route('tasks.update', $task) }}">
        @csrf
        @method('PUT')
        @include('tasks._form', ['submitLabel' => 'Salvar alterações'])
    </form>
@endsection
