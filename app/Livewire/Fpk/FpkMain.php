<?php

namespace App\Livewire\Fpk;

use Livewire\Component;

class FpkMain extends Component
{


    public function redirectToFPKSubmission($cursorId = null) {
        return redirect()->route('FPK Submission');
    }

    public function render()
    {
        return view('livewire.fpk.fpk-main');
    }
}
