<?php

namespace App\Livewire\Company;

use App\Models\BisnisUnit as ModelsBisnisUnit;
use App\Models\Departemen as ModelsDepartemen;
use App\Models\Jabatan as ModelsJabatan;
use Livewire\Component;
use Livewire\WithPagination;

class Jabatan extends Component
{
    use WithPagination;

    public $deleteModal = false;
    public $formModal = false;
    public $cursorId = null;
    public $nama_jabatan = null;
    public $bisnis_unit_id = "";
    public $departemen_id = "";
    public $bu = [], $d = [];

    protected $rules = [
        'nama_jabatan' => ['required','string'],
        'departemen_id' => ['required','exists:departemens,id']
    ];
    
    public function mount(){
        $this->bu = ModelsBisnisUnit::select('id','nama_bisnis_unit')->get();
    }

    public function mountDepartemens(){
        $this->d = ModelsDepartemen::where('bisnis_unit_id',$this->bisnis_unit_id)->get();
        $this->departemen_id = "";
    }

    public function render()
    {
        return view('livewire.company.jabatan', ['allJabatan' => ModelsJabatan::with('departemen')->paginate(5)]);
    }

    public function openDeleteModal($id) {
        $this->cursorId = $id;
        $this->nama_jabatan = ModelsJabatan::find($id)->nama_jabatan;
        $this->deleteModal = true;
    }

    public function openFormModalForAdd() {
        $this->cursorId = null;
        $this->nama_jabatan = null;
        $this->bisnis_unit_id = "";
        $this->departemen_id = "";
        $this->formModal = true;
    }

    public function openFormModalForEdit(ModelsJabatan $JModel) {
        $this->nama_jabatan = $JModel->nama_jabatan;
        $this->bisnis_unit_id = $JModel->departemen->bisnisUnit->id;
        $this->departemen_id = $JModel->departemen_id;
        $this->d = ModelsDepartemen::where('bisnis_unit_id',$this->bisnis_unit_id)->get();
        $this->cursorId = $JModel->id;
        $this->formModal = true;
    }
    
    public function deleteData() {
        $d = ModelsJabatan::find($this->cursorId);
        $d->delete();
        $this->deleteModal = false;
    }

    
    
    public function saveData() {
        $this->validate();
        if(isset($this->cursorId)){
            $d = ModelsJabatan::find($this->cursorId);
            $d->nama_jabatan = $this->nama_jabatan;
            $d->departemen_id = $this->departemen_id;
            $d->save();
        }
        else{
            ModelsJabatan::create([
                'nama_jabatan' => $this->nama_jabatan,
                'departemen_id' => $this->departemen_id
            ]);
        }
        $this->formModal = false;
        $this->cursorId = null;
        $this->bisnis_unit_id = "";
        $this->departemen_id = "";
        $this->nama_jabatan = null;
    }
}
