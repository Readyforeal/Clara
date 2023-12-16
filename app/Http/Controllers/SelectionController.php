<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Selection;
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
        $data = $request->validate([

            //Selection
            'name' => 'required',
            'description' => '',
            'quantity' => '',
            
            //Item
            // 'item_name' => 'required',
            // 'item_number' => '',
            // 'supplier' => '',
            // 'link' => '',
            // 'image' => '',
            // 'length' => '',
            // 'length_unit' => '',
            // 'width' => '',
            // 'width_unit' => '',
            // 'height' => '',
            // 'height_unit' => '',
            // 'color' => '',
            // 'notes' => ''
        ]);

        $selectionList = SelectionList::findOrFail(session('selectionListId'));
        
        $selection = $selectionList->selections()->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'quantity' => $data['quantity'],
        ]);

        // $item = auth()->user()->currentTeam->items()->create([
        //     'name' => $data['item_name'],
        //     'item_number' => $data['item_number'],
        //     'supplier' => $data['supplier'],
        //     'link' => $data['link'],
        //     'image' => isset($data['image']) ? $data['image'] : '',
        //     'dimensions' => $data['length'] . (isset($data['length_unit']) ? $data['length_unit'] : '') . ' ' . $data['width'] . (isset($data['width_unit']) ? $data['width_unit'] : '') . ' ' . $data['height'] . (isset($data['height_unit']) ? $data['height_unit'] : ''),
        //     'color' => $data['color'],
        //     'notes' => $data['notes'],
        // ]);

        // $selection->items()->attach($item->id);

        return to_route('selectionList.show', [
            'id' => $selectionList->id,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
