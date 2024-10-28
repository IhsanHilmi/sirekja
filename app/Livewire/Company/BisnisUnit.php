<?php

namespace App\Livewire\Company;

use App\Models\BisnisUnit as ModelsBisnisUnit;
use Livewire\Component;
use Livewire\WithPagination;

class BisnisUnit extends Component
{
    use WithPagination;

    public $deleteModal = false;
    public $formModal = false;
    public $cursorId = null;
    public $nama_bisnis_unit = null;

    protected $rules = [
        'nama_bisnis_unit' => ['required','string']
    ];

    public function render()
    {
        return view('livewire.company.bisnis-unit', ['allBisnisUnit' => ModelsBisnisUnit::paginate(5)]);
    }

    public function openDeleteModal($id) {
        $this->cursorId = $id;
        $this->nama_bisnis_unit = ModelsBisnisUnit::find($id)->nama_bisnis_unit;
        $this->deleteModal = true;
    }

    public function openFormModalForAdd() {
        $this->cursorId = null;
        $this->nama_bisnis_unit = null;
        $this->formModal = true;
    }

    public function openFormModalForEdit(ModelsBisnisUnit $BUModel) {
        $this->nama_bisnis_unit = $BUModel->nama_bisnis_unit;
        $this->cursorId = $BUModel->id;
        $this->formModal = true;
    }
    
    public function deleteData() {
        $bu = ModelsBisnisUnit::find($this->cursorId);
        $bu->delete();
        $this->deleteModal = false;
    }
    
    public function saveData() {
        $this->validate();
        
        if(isset($this->cursorId)){
            $bu = ModelsBisnisUnit::find($this->cursorId);
            $bu->nama_bisnis_unit = $this->nama_bisnis_unit;
            $bu->save();
        }
        else{
            ModelsBisnisUnit::create([
                'nama_bisnis_unit' => $this->nama_bisnis_unit
            ]);
        }
        $this->formModal = false;
        $this->cursorId = null;
        $this->nama_bisnis_unit = null;
    }
}
