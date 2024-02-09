@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Modifica Progetto</h2>
        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')
            {{-- Campi del form --}}
            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $project->title }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $project->description }}</textarea>
            </div>
            {{-- Selezione del tipo --}}
            <div class="mb-3">
                <label for="type_id" class="form-label">Tipo di Progetto</label>
                <select class="form-control" id="type_id" name="type_id">
                    <option value="">Seleziona un tipo</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ (isset($project) && $project->type_id == $type->id) ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Aggiorna</button>
        </form>
    </div>
@endsection
