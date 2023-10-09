<?php

namespace App\Livewire;

use Livewire\Component;

class ClassCreateComponent extends Component
{
    public $classes;

    public function mount($classes)
    {
        $this->classes = $classes;
    }

    public function render()
    {
        return view('livewire.class-create-component');
    }
}
