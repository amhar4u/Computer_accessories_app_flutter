<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Traits\WithAuthentication;

#[Title('Admin Dashboard')]
#[Layout('components.layouts.admin')]
class AdminDashboard extends Component
{
    use WithAuthentication;
    public function render()
    {
        return view('livewire.admin.admin-dashboard');
    }
}
