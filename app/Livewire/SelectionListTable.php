<?php

namespace App\Livewire;

use Livewire\Component;

class SelectionListTable extends Component
{
    public $search = '';
    public $viewBy = 'all';

    public $selections;

    public function mount($selections) {
        $this->selections = $selections;

    }

    public function render()
    {
        return view('livewire.selection-list-table');
    }
}
