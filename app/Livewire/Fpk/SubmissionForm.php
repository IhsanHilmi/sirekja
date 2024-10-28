<?php

namespace App\Livewire\Fpk;

use App\Models\Jabatan as ModelJabatan;
use Livewire\Component;

class SubmissionForm extends Component
{
    public $description = null;
    public $cursorId;
    public $kodeFPK = "", $jabatan_id = null;
    public $j = [];

    public function mount($cursorId = null)
    {
        $this->j = ModelJabatan::all();
        $this->cursorId = $cursorId;
    }

    public function render()
    {
        return view('livewire.fpk.submission-form');
    }

    public function submitFPK()
    {

        return redirect()->route('FPK Main');
    }
}
