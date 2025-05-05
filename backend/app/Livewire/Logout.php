<?php

namespace App\Livewire;

use Livewire\Component;
use App\Traits\LogoutTrait;

class Logout extends Component
{
    use LogoutTrait;
    
    public $text = 'Logout';
    public $icon = 'bx bx-log-out';
    
    public function logout()
    {
        return $this->performLogout();
    }

    public function render()
    {
        return <<<'HTML'
        <a href="#" wire:click.prevent="logout" style="text-decoration: none; color: inherit;" class="nav-link d-flex align-items-center">
            <i class="{{ $icon }} me-2"></i> {{ $text }}
        </a>
        HTML;
    }
}
