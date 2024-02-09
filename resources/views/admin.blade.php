@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        {{-- Titolo --}}
        <h2>Progetti</h2>

           {{-- Pulsante crea nuovo progetto --}}
           <a href="{{ route('admin.projects.create') }}" class="hoverable btn btn-success my-4">
             Crea Nuovo Progetto
           </a>


        {{-- Tabella --}}
        <table class="table table-borderless table-hover">

            {{-- Intestazione --}}
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrizione</th>
                    <th>Tipo</th>
                    <th>Modifica</th>
                    <th>Elimina</th>
                </tr>
            </thead>

            {{-- Corpo --}}
            <tbody>
                @foreach ($projects as $project)
                    {{-- Righe --}}
                    <tr>

                        {{-- Colonne --}}
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->description }}</td>

                        {{-- Colonna tipo progetto --}}
                        @if ($project->type_id == 1)
                            <td>
                                <span class="badge text-bg-success">
                                    {{ $project->type->name ?? 'Nessun tipo' }}
                                </span>
                            </td>
                        @elseif($project->type_id == 2)
                            <td>
                                <span class="badge text-bg-warning">
                                    {{ $project->type->name ?? 'Nessun tipo' }}
                                </span>
                            </td>
                        @elseif($project->type_id == 3)
                            <td>
                                <span class="badge text-bg-info">
                                    {{ $project->type->name ?? 'Nessun tipo' }}
                                </span>
                            </td>
                        @else
                            <td>{{ $project->type->name ?? 'Nessun tipo' }}</td>
                        @endif

                        {{-- Colonna modifica --}}
                        <td>
                            <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-primary hoverable">
                                Modifica
                            </a>
                        </td>

                        {{-- Colonna elimina --}}
                        <td>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger hoverable" type="submit"
                                    onclick="return confirm('Sei sicuro di voler eliminare questo progetto?')">
                                    Elimina
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>

        </table>

        {{-- Messaggi di feedback --}}
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

    </div>
@endsection
