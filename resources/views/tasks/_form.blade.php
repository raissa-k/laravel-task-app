@if ($errors->any())
    <div class="alert alert--danger">
        <p><strong>Corrija os erros:</strong></p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div>
    <label for="title">Título</label><br>
    <input
        id="title"
        type="text"
        name="title"
        value="{{ old('title', $task->title ?? '') }}"
        required
        maxlength="255"
    >
</div>

<div>
    <label for="description">Descrição</label><br>
    <textarea id="description" name="description" rows="4" cols="60">{{ old('description', $task->description ?? '') }}</textarea>
</div>

<div>
    <label>
        <input type="hidden" name="is_done" value="0">
        <input type="checkbox" name="is_done" value="1" @checked(old('is_done', $task->is_done ?? false))>
        Concluída
    </label>
</div>

<button type="submit">{{ $submitLabel ?? 'Salvar' }}</button>
