@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Aggiungi Progetto</h2>
        <form action="{{ route('admin.projects.store') }}" method="POST">
            @csrf
            {{-- Campi del form --}}
            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-success">Crea</button>
        </form>
    </div>
@endsection