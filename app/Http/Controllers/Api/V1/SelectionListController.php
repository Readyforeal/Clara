<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\SelectionList;
use App\Http\Requests\StoreSelectionListRequest;
use App\Http\Requests\UpdateSelectionListRequest;

class SelectionListController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSelectionListRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SelectionList $selectionList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SelectionList $selectionList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSelectionListRequest $request, SelectionList $selectionList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SelectionList $selectionList)
    {
        //
    }
}
