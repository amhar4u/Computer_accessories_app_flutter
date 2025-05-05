<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request){
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
