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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('selections.createSelection', [
            'project' => Project::findOrFail(session('projectId')),
            'selectionList' => SelectionList::findOrFail(session('selectionListId')),
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
            'quantity' => '',
        ]);

        //Get the selection list and create the selection
        $selectionList = SelectionList::findOrFail(session('selectionListId'));
        
        $selection = $selectionList->selections()->create([
            'name' => ucwords(strtolower($data['name'])),
            'description' => $data['description'],
            'quantity' => $data['quantity'],
        ]);

        //Return to selection list view
        return to_route('selectionList.show', [
            'id' => $selectionList->id,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Forget scoped IDs
        session()->forget(['itemId']);
        
        //Set session values
        session(['selectionId' => $id]);

        return view('selections.showSelection', [
            'project' => Project::findOrFail(session('projectId')),
            'selection' => Selection::findOrFail(session('selectionId')),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('selections.editSelection', [
            'project' => Project::findOrFail(session('projectId')),
            'selection' => Selection::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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

        return redirect()->route('selection.show', [
            'id' => $id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //DEV NOTE:
        //Selection is located via location_selection pivot
        //  We will keep the location_selection record until permanent deletion
        //Selection has items via item_selection pivot
        //  We will keep the items in our database if we ever need them again unless otherwise specified, in which case we should prompt for item deletion
        Selection::findOrFail($id)->delete();

        return redirect()->route('selectionList.show', [
            'id' => session('selectionListId'),
        ]);
    }
}
