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
        $selection = Selection::findOrFail(session('roadmap.project.selectionList.selection.selectionId'));
        $selection->items()->attach($item->id);

        //Return to selection view
        return redirect()->route('selections.show', [
            'id' => $selection->id,
        ])->with('message', ['type' => 'success', 'body' => 'Item successfully created']);
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
        $item = Item::findOrFail($id);

        //Set session values
        session(['roadmap.project.selectionList.selection.item' => [
                'itemId' => $item->id,
                'itemName' => $item->name,
            ]
        ]);

        return view('items.editItem', [
            'project' => Project::findOrFail(session('roadmap.project.projectId')),
            'item' => Item::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //DEV NOTE:
        //When updating the selection, we should prompt whether or not to overwrite the existing item, or save as new item.
        
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
        Item::findOrFail($id)->update([
            'name' => ucwords(strtolower($data['name'])),
            'item_number' => strtoupper($data['item_number']),
            'supplier' => $data['supplier'],
            'link' => $data['link'],
            'image' => isset($data['image']) ? $data['image'] : '',
            'dimensions' => $data['dimensions'],
            'color' => ucwords(strtolower($data['color'])),
            'notes' => $data['notes'],
        ]);

        //Get selection and return to selection view
        return redirect()->route('selections.show', [
            'id' => session('roadmap.project.selectionList.selection.selectionId'),
        ])->with('message', ['type' => 'success', 'body' => 'Item successfully updated']);;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Item::findOrFail($id)->delete();

        return redirect()->route('selections.show', [
            'id' => session('roadmap.project.selectionList.selection.selectionId'),
        ])->with('message', ['type' => 'success', 'body' => 'Item successfully deleted']);;
    }
}
