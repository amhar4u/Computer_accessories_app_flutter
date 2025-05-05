<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;


#[Title('Admin Dashboard')]
#[Layout('components.layouts.admin')]
class AdminDashboard extends Component
{

    public function render()
    {
        return view('livewire.admin.admin-dashboard');
    }
}
