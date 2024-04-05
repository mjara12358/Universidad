<?php

namespace App\Livewire;

use Livewire\Component;

class CreateRolModal extends Component
{
    public $show = false;

    public function render()
    {
        return view('livewire.create-rol-modal');
    }
}
