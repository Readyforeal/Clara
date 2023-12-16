<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Project;
use App\Models\Selection;
use App\Models\SelectionList;
use Illuminate\Http\Request;

class ItemController extends Controller
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
        return view('items.createItem', [
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
            'item_number' => '',
            'supplier' => '',
            'link' => '',
            'image' => '',
            'dimensions' => '',
            'color' => '',
            'notes' => ''
        ]);

        //Create the item
        $item = auth()->user()->currentTeam->items()->create([
            'name' => $data['name'],
            'item_number' => $data['item_number'],
            'supplier' => $data['supplier'],
            'link' => $data['link'],
            'image' => isset($data['image']) ? $data['image'] : '',
            'dimensions' => $data['dimensions'],
            'color' => $data['color'],
            'notes' => $data['notes'],
        ]);

        //Get the selection and attach
        $selection = Selection::findOrFail(session('selectionId'));
        $selection->items()->attach($item->id);

        //Return to selection view
        return to_route('selection.show', [
            'id' => $selection->id,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //Set session values
        session(['itemId' => $id]);

        return view('items.editItem', [
            'project' => Project::findOrFail(session('projectId')),
            'item' => Item::findOrFail($id),
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
            'item_number' => '',
            'supplier' => '',
            'link' => '',
            'image' => '',
            'dimensions' => '',
            'color' => '',
            'notes' => ''
        ]);

        //Get the item we're updating and update the data
        Item::findOrFail($id)->update($data);

        //Get selection and return to selection view
        return redirect()->route('selection.show', [
            'id' => session('selectionId'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Item::findOrFail($id)->delete();

        return redirect()->route('selection.show', [
            'id' => session('selectionId'),
        ]);
    }
}
