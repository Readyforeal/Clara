<?php

namespace App\Livewire;

use Livewire\Component;

class ProjectSidebarLink extends Component
{
    public $link = '';
    public $icon = '';
    public $label = '';
    public $highlighted = false;
    
    public function render()
    {
        return view('livewire.project-sidebar-link', [
            'link' => $this->link,
            'icon' => $this->icon,
            'label' => $this->label,
            'highlighted' => $this->highlighted,
        ]);
    }
}
