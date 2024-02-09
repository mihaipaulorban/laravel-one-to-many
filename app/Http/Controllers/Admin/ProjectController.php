<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    // Mostra tutti i progetti
    public function index()
    {
        $projects = Project::all();

        return view('admin', ['projects' => $projects]);
    }

    // Mostra la vista per creare un nuovo progetto
    public function create()
    {
        // Recupera tutti i tipi
        $types = Type::all();
        return view('create', compact('types'));
    }

    // Salva un nuovo progetto
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'type_id' => 'nullable|exists:types,id',
        ]);

        $project = Project::create($validatedData);

        session()->flash('success', 'Progetto creato con successo!');

        // Reindirizza alla lista progetti
        return redirect()->route('admin.projects.index')->with('created', 'Progetto creato con successo!');
    }

    // Mostra la vista per modificare un progetto
    public function edit(Project $project)
    {
        $types = Type::all();

        return view('edit', compact('project', 'types'));
    }

    // Aggiorna un progetto esistente
    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'type_id' => 'nullable|exists:types,id',
        ]);

        $project->update($validatedData);

        session()->flash('success', 'Progetto aggiornato con successo!');

        // Reindirizza alla lista progetti
        return redirect()->route('admin.projects.index');
    }

    // Elimina un progetto
    public function destroy(Project $project)
    {
        $project->delete();

        session()->flash('success', 'Progetto eliminato con successo!');

        // Reindirizza alla lista progetti
        return redirect()->route('projects.index');
    }
}
