<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Selection;
use App\Models\SelectionList;
use Illuminate\Http\Request;

class SelectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('selections.createSelection', [
            'project' => Project::findOrFail(session('roadmap.project.projectId')),
            'selectionList' => SelectionList::findOrFail(session('roadmap.project.selectionList.selectionListId')),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //Validate form data
        $data = $request->validate([
            'name' => 'required',
            'description' => '',
            'quantity' => '',
        ]);

        //Get the selection list and create the selection
        $selectionList = SelectionList::findOrFail(session('roadmap.project.selectionList.selectionListId'));
        
        $selection = $selectionList->selections()->create([
            'name' => ucwords(strtolower($data['name'])),
            'description' => $data['description'],
            'quantity' => $data['quantity'],
        ]);

        //Return to selection list view
        return to_route('selectionLists.show', [
            'id' => $selectionList->id,
        ])->with('message', ['type' => 'success', 'body' => 'Selection successfully created']);;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //Forget scoped IDs
        session()->forget(['roadmap.project.selectionList.selection.item']);

        $selection = Selection::findOrFail($id);
        
        //Set session values
        session([
            'roadmap.project.selectionList.selection' => [
                'selectionId' => $selection->id,
                'selectionName' => $selection->name
            ]
        ]);

        return view('selections.showSelection', [
            'project' => Project::findOrFail(session('roadmap.project.projectId')),
            'selection' => $selection,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        return view('selections.editSelection', [
            'project' => Project::findOrFail(session('roadmap.project.projectId')),
            'selection' => Selection::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        //Validate fotm data
        $data = $request->validate([
            'name' => 'required',
            'description' => '',
            'quantity' => ''
        ]);

        //Get the selection we're updating and update the data
        Selection::findOrFail($id)->update([
            'name' => ucwords(strtolower($data['name'])),
            'description' => $data['description'],
            'quantity' => $data['quantity'],
        ]);

        return redirect()->route('selections.show', [
            'id' => $id,
        ])->with('message', ['type' => 'success', 'body' => 'Selection successfully updated']);;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //DEV NOTE:
        //Selection is located via location_selection pivot
        //  We will keep the location_selection record until permanent deletion
        //Selection has items via item_selection pivot
        //  We will keep the items in our database if we ever need them again unless otherwise specified, in which case we should prompt for item deletion
        $selection = Selection::findOrFail($id);
        
        //Delete any associated approvals
        foreach($selection->approvals as $approval) {
            $approval->delete();
        }

        $selection->delete();

        return redirect()->route('selectionLists.show', [
            'id' => session('roadmap.project.selectionList.selectionListId'),
        ])->with('message', ['type' => 'success', 'body' => 'Selection successfully deleted']);;
    }
}
