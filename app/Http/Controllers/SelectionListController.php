<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\SelectionList;

class SelectionListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Forget scoped IDs
        session()->forget(['selectionListId', 'selectionId']);

        $project = Project::findOrFail(session('projectId'));

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
            'project' => Project::findOrFail(session('projectId')),
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
        ]);

        //Get the project and create the selection list
        $project = Project::findOrFail(session('projectId'));

        $selectionList = $project->selectionLists()->create([
            'name' => ucwords(strtolower($data['name'])),
        ]);

        //Go to the selection list
        return redirect()->route('selectionList.show', [
            'id' => $selectionList->id,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Forget scoped IDs
        session()->forget(['selectionId']);

        //Set session values
        session(['selectionListId' => $id]);

        return view('selections.showSelectionList', [
            'project' => Project::findOrFail(session('projectId')),
            'selectionList' => SelectionList::findOrFail(session('selectionListId')),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('selections.editSelectionList', [
            'project' => Project::findOrFail(session('projectId')),
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
        ]);

        //Get the selection list we're updating and update the data
        SelectionList::findOrFail($id)->update([
            'name' => ucwords(strtolower($data['name'])),
        ]);

        return redirect()->route('selectionList.show', [
            'id' => $id,
        ]);
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

        return redirect()->route('selectionList.index');
    }
}
