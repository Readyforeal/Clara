<?php

namespace App\Livewire;

use App\Models\Approval;
use App\Models\ApprovalStage;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Selection;
use App\Models\Project;
use Illuminate\Support\Arr;

class SelectionListTable extends Component
{
    use WithPagination;

    public $selectionListId;
    public int $approvalStageId;

    //Query
    public $search = '';
    public $viewBy = 'all';

    //Visibility
    public $showBulkActions = false;
    public $showStagingModal = false;
    public $showDeleteModal = false;

    //Select rows
    public $selected = [];
    // public $selectedAll = false;
    // public $selectedCategories = [];

    public function mount($selectionListId) {
        $this->selectionListId = $selectionListId;
    }

    public function render() {
        $project = Project::where('id', session('roadmap.project.projectId'))->first();
        return view('livewire.selection-list-table', [
            'project' => $project,
            'selections' => Selection::where('selection_list_id', $this->selectionListId)->search('name', $this->search)->get(),
            'categories' => $project->categories()->search('name', $this->search)->get(),
            'locations' => $project->locations()->search('name', $this->search)->get(),
        ]);
    }

    protected function queryString() {
        return [
            'search' => [],
            'viewBy' => [],
        ];
    }

    public function getSelectionApprovalStatusColor($selectionId) {
        $selection = Selection::findOrFail($selectionId);
        $latestApproval = $selection->approvals()->latest()->first();

        if($latestApproval != null) {
            if($latestApproval->status == 'Pending') {
                return 'bg-yellow-100';
            }elseif($latestApproval->status == 'Approved') {
                return 'bg-green-100';
            }elseif($latestApproval->status == 'Denied') {
                return 'bg-red-100';
            }
        }
    }

    public function getSelectionNeeded($selectionId) {
        $selection = Selection::findOrFail($selectionId);

        if($selection->items->count() == 0) {
            return true;
        } else {
            return false;
        }
    }

    // Select All

    // public function selectAll(array $allSelected) {
    //     if($this->selectedAll) {
    //         $this->selected = [];
    //         $this->selectedAll = false;
    //     } else {
    //         $this->selected = $allSelected;
    //         $this->selectedAll = true;
    //     }
    // }

    // Select all by category

    // public function selectAllByCategory($categoryId, array $allSelected) {
    //     $categoryId = (int) $categoryId;

    //     // Initialize the category if it doesn't exist
    //     if (!isset($this->selectedCategories[$categoryId])) {
    //         $this->selectedCategories[$categoryId] = false;
    //     }

    //     // Toggle the category selection status
    //     $this->selectedCategories[$categoryId] = !$this->selectedCategories[$categoryId];

    //     // If category is selected, add its items to selectedItems; otherwise, remove them
    //     if($this->selectedCategories[$categoryId]) {
    //         $this->selected = array_merge($this->selected, $allSelected);
    //     } else {
    //         $this->selected = array_values(array_diff($this->selected, $allSelected));
    //     }
    // }

    public function setView($view) {
        $this->selected = [];
        // $this->selectedAll = false;
        $this->reset('search');
        $this->viewBy = $view;
    }

    // DEV NOTE: Will need to pass class / object type later on
    public function stageSelected() {
        $approvalStage = ApprovalStage::findOrFail($this->approvalStageId);
        foreach($this->selected as $selectionId) {
            try {
                //Create the approval
                $approval = new Approval();
                $approval->approvalStage()->associate($approvalStage);

                //Get the selection
                $selection = Selection::findOrFail($selectionId);
                $selection->approvals()->save($approval);
        
                //Reset
                $this->selected = [];
                $this->showBulkActions = false;
                $this->showStagingModal = false;

                session()->flash('message', ['type' => 'success', 'body' => 'Approvals created successfully']);
    
            } catch (\Illuminate\Database\QueryException $e) {
                $this->showStagingModal = false;
            }
        }
    }

    public function deleteSelected() {
        Selection::query()
            ->whereIn('id', $this->selected)
            ->delete();
        $this->selected = [];
        $this->showBulkActions = false;
        $this->showDeleteModal = false;

        session()->flash('message', ['type' => 'success', 'body' => 'Selections deleted successfully']);
    }
}
