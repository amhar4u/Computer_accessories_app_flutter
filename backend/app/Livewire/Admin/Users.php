<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Users')]
#[Layout('components.layouts.admin')]
class Users extends Component
{
    public function render()
    {
        $user = User::all();
        return view('livewire.admin.users',[
            'users' => $user,
        ]);
    }
}
