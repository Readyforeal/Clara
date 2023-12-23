<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        //Forget session values
        session()->forget(['roadmap']);

        return view('projects.indexProjects', [
            'projects' => auth()->user()->currentTeam->projects()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.createProject');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validate form data
        $data = $request->validate([
            'name' => 'required',
            'street' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'description' => ''
        ]);

        //Get the current team and create the project
        $project = auth()->user()->currentTeam->projects()->create([
            'name' => ucwords(strtolower($data['name'])),
            'street' => ucwords(strtolower($data['street'])),
            'city' => ucwords(strtolower($data['city'])),
            'state' => ucwords(strtolower($data['state'])),
            'zip' => ucwords(strtolower($data['zip'])),
            'description' => $data['description'],
        ]);

        //Go to project home
        return redirect()->route('project.show', [
            'id' =>$project->id,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        //Forget session values
        session()->forget(['roadmap', 'feature']);

        $project = Project::findOrFail($id);

        //Set session values
        session(['roadmap' => ['project' => ['projectId' => $project->id, 'projectName' => $project->name]]]);

        //Return the view
        return view('projects.showProject', [
            'project' => $project,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('projects.editProject', [
            'project' => Project::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'street' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'description' => ''
        ]);

        Project::findOrFail($id)->update($data);

        return redirect()->route('project.show', [
            'id' => $id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        foreach($project->selectionLists() as $selectionList) {
            $selectionList->selections()->delete;
            $selectionList->delete();
        }
        $project->selectionLists()->delete();
        $project->delete();

        return redirect()->route('project.index');
    }
}
