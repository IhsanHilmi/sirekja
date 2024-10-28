<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RoleBasedDashboard extends Component
{
    
    public function render()
    {
        $loggedUser = Auth::user();
        return view('livewire.role-based-dashboard', [
            'loggedUser' => $loggedUser
        ]);
    }
}
