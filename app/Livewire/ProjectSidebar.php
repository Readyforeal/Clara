<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;

class ProjectSidebar extends Component
{
    public $project;

    public function mount() {
        $this->project = Project::findOrFail(session()->get('projectId'));
    }

    public function render()
    {
        return view('livewire.project-sidebar');
    }
}
