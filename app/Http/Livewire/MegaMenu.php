<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MegaMenu extends Component
{
    public $activeClass;

    public function showContent($id)
    {
        $this->activeClass="active";
    }

    public function closeContent()
    {
        $this->activeClass="";
    }

    public function render()
    {
        return view('livewire.mega-menu');
    }
}
