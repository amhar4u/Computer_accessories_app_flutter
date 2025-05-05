<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait LogoutTrait
{
    /**
     * Handle user logout
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function performLogout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        
        return redirect()->route('login');
    }
}