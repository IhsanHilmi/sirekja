<?php

namespace App\Livewire\Company;

use App\Models\BisnisUnit as ModelsBisnisUnit;
use App\Models\Departemen as ModelsDepartemen;
use Livewire\Component;
use Livewire\WithPagination;

class Departemen extends Component
{
    use WithPagination;

    public $deleteModal = false;
    public $formModal = false;
    public $cursorId = null;
    public $nama_departemen = null;
    public $bisnis_unit_id = "";
    public $bu = [];

    protected $rules = [
        'nama_departemen' => ['required','string'],
        'bisnis_unit_id' => ['required','exists:bisnis_units,id']
    ];
    
    public function mount(){
        $this->bu = ModelsBisnisUnit::select('id','nama_bisnis_unit')->get();
    }

    public function render()
    {
        return view('livewire.company.departemen', ['allDepartemen' => ModelsDepartemen::with('bisnisUnit')->paginate(5)]);
    }

    public function openDeleteModal($id) {
        $this->cursorId = $id;
        $this->nama_departemen = ModelsDepartemen::find($id)->nama_departemen;
        $this->deleteModal = true;
    }

    public function openFormModalForAdd() {
        $this->cursorId = null;
        $this->nama_departemen = null;
        $this->bisnis_unit_id = "";
        $this->formModal = true;
    }

    public function openFormModalForEdit(ModelsDepartemen $DModel) {
        $this->nama_departemen = $DModel->nama_departemen;
        $this->bisnis_unit_id = $DModel->bisnis_unit_id;
        $this->cursorId = $DModel->id;
        $this->formModal = true;
    }
    
    public function deleteData() {
        $d = ModelsDepartemen::find($this->cursorId);
        $d->delete();
        $this->deleteModal = false;
    }

    
    
    public function saveData() {
        $this->validate();
        if(isset($this->cursorId)){
            $d = ModelsDepartemen::find($this->cursorId);
            $d->nama_departemen = $this->nama_departemen;
            $d->bisnis_unit_id = $this->bisnis_unit_id;
            $d->save();
        }
        else{
            ModelsDepartemen::create([
                'nama_departemen' => $this->nama_departemen,
                'bisnis_unit_id' => $this->bisnis_unit_id
            ]);
        }
        $this->formModal = false;
        $this->cursorId = null;
        $this->bisnis_unit_id = "";
        $this->nama_departemen = null;
    }
}
