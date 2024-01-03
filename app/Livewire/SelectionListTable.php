<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
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
        $project = Project::where('id', session('roadmap.project.projectId'))->first();
        return view('livewire.selection-list-table', [
            'project' => $project,
            'selections' => Selection::where('selection_list_id', $this->selectionListId)->search('name', $this->search)->get(),
            'categories' => $project->categories()->search('name', $this->search)->get(),
            'locations' => $project->locations()->search('name', $this->search)->get(),
        ]);
    }

    protected function queryString()
    {
        return [
            'search' => [],
            'viewBy' => [],
        ];
    }
}
