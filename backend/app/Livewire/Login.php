<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Login extends Component
{
    #[Title('Login')]
    #[Layout('components.layouts.app')]
    
    public function render()
    {
        return view('livewire.login');
    }
}