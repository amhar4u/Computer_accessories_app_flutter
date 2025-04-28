<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait WithAuthentication
{
    public function logout()
    {
        try {
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();
            
            return $this->redirect(route('login'), navigate: true);
        } catch (\Exception $e) {
            logger()->error('Logout Error: ' . $e->getMessage());
            session()->flash('error', 'An error occurred during logout.');
        }
    }
}