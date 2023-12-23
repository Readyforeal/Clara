<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\ApprovalStage;
use App\Models\Selection;
use Illuminate\Http\Request;

class ApprovalController extends Controller
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
    public function store(Request $request)
    {
        //
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

    public function createApprovalForSelection(Request $request)
    {
        //Validate form data
        $data = $request->validate([
            'selection_id' => '',
            'approval_stage_id' => '',
        ]);

        //Get necessary models
        $selection = Selection::findOrFail($data['selection_id']);
        $approvalStage = ApprovalStage::findOrFail($data['approval_stage_id']);
        
        try {
            //Create the approval
            $approval = new Approval();
            $approval->approvalStage()->associate($approvalStage);
            $selection->approvals()->save($approval);
    
            //Redirect with success
            return redirect()->route('selections.show', [
                'id' => $selection->id,
            ])->with('message', ['type' => 'success', 'body' => 'Approval created successfully']);

        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return redirect()->route('selections.show', [
                    'id' => $selection->id,
                ])->with('message', ['type' => 'error', 'body' => 'Selection is already open for approval']);
            } else {
                // Other database exception handling
            }
        }
    }

    public function deleteSelectionApproval(string $id)
    {
        $approval = Approval::findOrFail($id);
        $selection = Selection::findOrFail($approval->approvable_id);
        $approval->delete();

        return redirect()->route('selections.show', [
            'id' => $selection->id,
        ])->with('message', ['type' => 'success', 'body' => 'Approval deleted']);
    }

    public function updateApprovalStatus(Request $request)
    {
        $data = $request->validate([
            'approval_id' => 'required',
            'status' => 'required',
        ]);

        //Get the approval
        $approval = Approval::findOrFail($data['approval_id']);
        
        //Set the approval status
        $approval->status = $data['status'];
        $approval->save();

        //Return to model route
        $approvable = $approval->approvable;
        if($approvable instanceof Selection) {
            return redirect()->route('selections.show', [
                'id' => $approval->approvable_id,
            ])->with('message', ['type' => 'success', 'body' => 'Approval status successfully updated']);
        }
    }
}
