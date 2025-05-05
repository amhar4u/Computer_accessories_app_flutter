<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Products')]
#[Layout('components.layouts.admin')]
class Products extends Component
{
    public function render()
    {
        return view('livewire.admin.products');
    }
}
