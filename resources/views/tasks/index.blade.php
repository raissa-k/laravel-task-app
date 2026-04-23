@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
    <h1>Tasks</h1>

    <p><a href="{{ route('tasks.create') }}">Criar task</a></p>

    @if ($tasks->isEmpty())
        <p>Nenhuma task cadastrada.</p>
    @else
        <table border="1" cellpadding="6" cellspacing="0">
            <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Status</th>
                <th>Criada em</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->is_done ? 'Concluída' : 'Pendente' }}</td>
                    <td>{{ $task->created_at }}</td>
                    <td>
                        <span class="actions">
                            <a href="{{ route('tasks.edit', $task) }}">Editar</a>

                            <form method="POST" action="{{ route('tasks.destroy', $task) }}"
                                  onsubmit="return confirm('Remover esta task?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Excluir</button>
                            </form>
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
