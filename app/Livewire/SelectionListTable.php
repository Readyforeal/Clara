<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Selection;
use App\Models\Project;
use Illuminate\Support\Arr;

class SelectionListTable extends Component
{
    use WithPagination;

    public $search = '';

    public $viewBy = 'all';

    public $selectionListId;

    public $selected = [];
    public $selectedAll = false;
    public $selectedCategories = [];

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

    public function selectAll(array $allSelected) {
        if($this->selectedAll) {
            $this->selected = [];
            $this->selectedAll = false;
        } else {
            $this->selected = $allSelected;
            $this->selectedAll = true;
        }
    }

    public function selectAllByCategory($categoryId, array $allSelected) {
        $categoryId = (int) $categoryId;

        // Initialize the category if it doesn't exist
        if (!isset($this->selectedCategories[$categoryId])) {
            $this->selectedCategories[$categoryId] = false;
        }

        // Toggle the category selection status
        $this->selectedCategories[$categoryId] = !$this->selectedCategories[$categoryId];

        // If category is selected, add its items to selectedItems; otherwise, remove them
        if($this->selectedCategories[$categoryId]) {
            $this->selected = array_merge($this->selected, $allSelected);
        } else {
            $this->selected = array_values(array_diff($this->selected, $allSelected));
        }
    }

    public function setView($view) {
        $this->reset('search');
        $this->viewBy = $view;
    }

    public function deleteSelected() {
        Selection::query()
            ->whereIn('id', $this->selected)
            ->delete();
        $this->selected = [];
    }

    // public function updatedSelectAll($value) {
    //     $newArray = array_map('strval', json_decode($value));
    //     $newArray = array_values($newArray);
    //     $this->selectAll = $newArray;
    //     $this->selected = $this->selectAll;
    // }

    // public function updatedSelectedAll($value) {
    //     if($value == false) {
    //         $this->selectAll = [];
    //         $this->selected = [];
    //     }
    // }
}
