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
        //Forget session values
        session()->forget('selectionList');

        return view('selections.indexSelectionLists', [
            'project' => session('project'),
            'selectionLists' => session('project')->selectionLists,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Set session values
        session(['selectionList' => SelectionList::findOrFail($id)]);

        return view('selections.showSelectionList', [
            'project' => session('project'),
            'selectionList' => session('selectionList'),
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
