<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\SelectionList;

class SelectionListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Forget scoped IDs
        session()->forget(['roadmap.project.selectionList', 'roadmap.project.approvalStage']);
        session(['feature' => 'selections']);

        $project = Project::findOrFail(session('roadmap.project.projectId'));

        return view('selections.indexSelectionLists', [
            'project' => $project,
            'selectionLists' => $project->selectionLists
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('selections.createSelectionList', [
            'project' => Project::findOrFail(session('roadmap.project.projectId')),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validate form data
        $data = $request->validate([
            'name' => 'required',
            'description' => '',
        ]);

        //Get the project and create the selection list
        $project = Project::findOrFail(session('roadmap.project.projectId'));

        $selectionList = $project->selectionLists()->create([
            'name' => ucwords(strtolower($data['name'])),
            'description' => $data['description'],
        ]);

        //Go to the selection list
        return redirect()->route('selectionLists.show', [
            'id' => $selectionList->id,
        ])->with('message', ['type' => 'success', 'body' => 'Selection list successfully created']);;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Forget scoped IDs
        session()->forget(['project.selectionList.selection']);

        $selectionList = SelectionList::findorFail($id);

        //Set session values
        session([
            'roadmap.project.selectionList' => [
                'selectionListId' => $selectionList->id,
                'selectionListName' => $selectionList->name
            ],
        ]);

        return view('selections.showSelectionList', [
            'project' => $selectionList->project,
            'selectionList' => $selectionList,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('selections.editSelectionList', [
            'project' => Project::findOrFail(session('roadmap.project.projectId')),
            'selectionList' => SelectionList::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Validate form data
        $data = $request->validate([
            'name' => 'required',
            'description' => '',
        ]);

        //Get the selection list we're updating and update the data
        SelectionList::findOrFail($id)->update([
            'name' => ucwords(strtolower($data['name'])),
            'description' => $data['description'],
        ]);

        return redirect()->route('selectionLists.show', [
            'id' => $id,
        ])->with('message', ['type' => 'success', 'body' => 'Selection list successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //DEV NOTE:
        //Selection list selections get deleted. See behavior mentioned in the Selection Controller regarding selection deletion
        $selectionList = SelectionList::findOrFail($id);
        $selectionList->selections()->delete();
        $selectionList->delete();

        return redirect()->route('selectionLists.index')->with('message', ['type' => 'success', 'body' => 'Selection list successfully deleted']);
    }
}
