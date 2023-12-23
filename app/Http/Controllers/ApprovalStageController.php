<?php

namespace App\Http\Controllers;

use App\Models\ApprovalStage;
use Illuminate\Http\Request;
use App\Models\Project;

class ApprovalStageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Forget scoped session values
        session()->forget(['roadmap.project.approvalStage', 'roadmap.project.selectionList']);
        //Set the feature
        session(['feature' => 'approvals']);

        $project = Project::findOrFail(session('roadmap.project.projectId'));

        return view('approvals.indexApprovalStages', [
            'project' => $project,
            'approvalStages' => $project->approvalStages,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('approvals.createApprovalStage', [
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
            'description' => '',
        ]);

        //Get the project and create the approval stage
        $project = Project::findOrFail(session('projectId'));

        $approvalStage = $project->approvalStages()->create([
            'name' => ucwords(strtolower($data['name'])),
            'description' => $data['description'],
        ]);

        //Go to the approval stage
        return redirect()->route('approvalStages.show', [
            'id' => $approvalStage->id,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Forget scoped IDs

        $approvalStage = ApprovalStage::findOrFail($id);

        //Set session values
        session([
            'roadmap.project.approvalStage' => [
                'approvalStageId' => $approvalStage->id,
                'approvalStageName' => $approvalStage->name
            ],
        ]);

        return view('approvals.showApprovalStage', [
            'project' => session('roadmap.project.projectId'),
            'approvalStage' => $approvalStage,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('approvals.editApprovalStage', [
            'project' => Project::findOrFail(session('roadmap.project.projectId')),
            'approvalStage' => ApprovalStage::findOrFail($id),
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

        //Get the approval stage we're updating and update the data
        ApprovalStage::findOrFail($id)->update([
            'name' => ucwords(strtolower($data['name'])),
            'description' => $data['description'],
        ]);

        //Show approval stage
        return redirect()->route('approvalStages.show', [
            'id' => $id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //DEV NOTE:
        //Find out what associations need to be deleted as well.
        $approvalStage = ApprovalStage::findOrFail($id);
        $approvalStage->delete();

        return redirect()->route('approvalStages.index');
    }
}
