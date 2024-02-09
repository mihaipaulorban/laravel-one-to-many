<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;

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
        return view('create');
    }


    // Metodo Store
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',

        ]);

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
        return view('edit', compact('project'));
    }


    // Metodo Update
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

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
