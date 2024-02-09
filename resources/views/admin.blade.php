@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Progetti</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrizione</th>
                    @if (session('created'))
                        <div class="alert alert-success">
                            {{ session('created') }}
                        </div>
                    @endif

                    @if (session('updated'))
                        <div class="alert alert-info">
                            {{ session('updated') }}
                        </div>
                    @endif

                    @if (session('deleted'))
                        <div class="alert alert-warning">
                            {{ session('deleted') }}
                        </div>
                    @endif


            {{-- Pulsante "Crea" --}}
            <a href="{{ route('admin.projects.create') }}" class="btn btn-success mb-3">Crea Nuovo Progetto</a>
            
            {{-- Tabella --}}
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->description }}</td>
                        <td>
                            {{-- Pulsante "Modifica" --}}
                            <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-primary">Modifica</a>
                        </td>
                        <td>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Sei sicuro di voler eliminare questo progetto?')">Elimina</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
