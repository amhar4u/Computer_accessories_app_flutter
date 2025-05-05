<?php

namespace App\Livewire;

use App\Traits\WithAuthentication;
use Exception;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Title('Login')]
#[Layout('components.layouts.app')]
class Login extends Component
{
    use WithAuthentication;
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8'
    ];

    public function checkRole()
    {
        $this->validate(['email' => 'required|email']);

        $user = User::where('email', $this->email)->first();

        if (!$user) {
            $this->addError('email', 'No account found with this email.');
            return false;
        }

        if ($user->role !== 'admin') {
            $this->addError('email', 'You do not have admin privileges.');
            return false;
        }

        return true;
    }

    public function updated($field)
    {
        if ($field === 'email') {
            $this->checkRole();
        }
    }

    public function login()
    {
        if (!$this->checkRole()) {
            return;
        }

        $this->validate();

        try {
            if (Auth::attempt([
                'email' => $this->email,
                'password' => $this->password
            ], $this->remember)) {
                if (Auth::user()->role === 'admin') {
                    session()->regenerate();
                    return $this->redirect(route('admin.dashboard'), navigate: true);
                }
                
                Auth::logout();
                $this->addError('email', 'You do not have admin privileges.');
            }

            $this->addError('password', 'Invalid credentials.');

        } catch (Exception $e) {
            logger()->error('Admin Login Error: ' . $e->getMessage());
            $this->addError('email', 'An error occurred during login.');
        }
    }

    public function logout()
    {
        $this->Logout();
    }

    public function render()
    {
        return view('livewire.login');
    }
}