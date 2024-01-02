<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Selection;
use App\Models\Project;

class SelectionListTable extends Component
{
    use WithPagination;

    public $search = '';
    public $viewBy = 'all';

    public $selectionListId;

    public function mount($selectionListId) {
        $this->selectionListId = $selectionListId;
    }

    public function render()
    {
        return view('livewire.selection-list-table', [
            'selections' => Selection::where('selection_list_id', session('roadmap.project.selectionList.selectionListId'))->search('name', $this->search)->paginate(),
            'project' => Project::where('id', session('roadmap.project.projectId'))->first(),
        ]);
    }
}
