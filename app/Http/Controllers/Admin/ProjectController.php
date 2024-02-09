<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view('admin', ['projects' => $projects]);
    }

    // Metodo Create
    public function create()
    {
        //Ottiene tutti i tipi
        $types = Type::all();
        return view('create', compact('types'));
    }


    // Metodo Store
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'type_id' => 'nullable|exists:types,id',

        ]);

        $project = Project::create($validatedData);
        $project = new Project();
        $project->title = $request->title;
        $project->description = $request->description;

        $project->save();

        // Allert per la creazione con successo
        session()->flash('success', 'Progetto creato con successo!');

        return redirect()->route('admin.projects.index')->with('created', 'Progetto creato con successo!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    // Metodo Edit
    public function edit(Project $project)
    {
        // Ottiene tutti i tipi
        $types = Type::all();
        return view('edit', compact('project', 'types'));
    }


    // Metodo Update
    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'type_id' => 'nullable|exists:types,id',
        ]);

        $project->update($validatedData);
        $project->title = $request->title;
        $project->description = $request->description;

        $project->save();

        // Imposta un messaggio flash per l'aggiornamento con successo
        return redirect()->route('admin.projects.index')->with('updated', 'Progetto aggiornato con successo.');
    }
    // Rotta per eliminare un progetto
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        // Messaggio per l'eliminazione
        session()->flash('deleted', 'Progetto eliminato con successo.');

        return redirect()->route('projects.index');
    }
}
