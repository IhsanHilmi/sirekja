<?php

namespace App\Livewire;

use App\Models\ApprovalLine as ModelsApprovalLine;
use App\Models\BisnisUnit as ModelsBisnisUnit;
use App\Models\Employee as ModelsEmployee;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class ApprovalLine extends Component
{
    use WithPagination;

    public $deleteModal = false;
    public $formModal = false;
    public $cursorId = null;
    public $user_employee = null;
    public $bisnis_unit_id = "", $hr_unit = "", $direksi1 = "", $direksi2 = "", $direksi3 = "", $presdir = "", $corporateHR = "", $superadmin = "";
    
    public $e = [];
    public $al = [];
    public $bu = [];

    protected $rules = [
        'user_employee' => ['required', 'exists:employees,id'],
        'bisnis_unit_id' => ['required', 'exists:bisnis_units,id'],
        'hr_unit' => ['required', 'exists:employees,id'],
        'direksi1' => ['required', 'exists:employees,id'],
        'direksi2' => ['required', 'exists:employees,id']
    ];

    public function mount(){
        $this->bu = ModelsBisnisUnit::all();
        $this->e = ModelsEmployee::select('id','employee_name')->get();
    }

    public function render()
    {
        return view('livewire.approval-line', ['allApprovalLine'=>ModelsApprovalLine::with(['bisnisUnit','hrUnit','direksi1','direksi2','direksi3','Presdir','corporateHR','Superadmin'])->paginate(25)]);
    }

    public function openFormModalForAdd() {
        $this->cursorId = null;
        $this->user_employee = null;
        $this->bisnis_unit_id = null;
        $this->hr_unit = null;
        $this->direksi1 = null;
        $this->direksi2 = null;
        $this->bisnis_unit_id = null;
        $this->direksi3 = "";
        $this->presdir = "";
        $this->corporateHR = "";
        $this->superadmin = "";
        $this->formModal = true;
    }

    public function openFormModalForEdit(ModelsApprovalLine $ALModel) {
        $this->bisnis_unit_id = $ALModel->bisnis_unit_id;
        $this->hr_unit = $ALModel->hr_unit;
        $this->direksi1 = $ALModel->direksi_1;
        $this->direksi2 = $ALModel->direksi_2;
        $this->direksi3 = $ALModel->direksi_3 ? ModelsEmployee::find($ALModel->direksi_3)->employee_name : "";
        $this->presdir = $ALModel->presdir ? ModelsEmployee::find($ALModel->presdir)->employee_name : "";
        $this->corporateHR = $ALModel->corporate_hr ? ModelsEmployee::find($ALModel->corporate_hr)->employee_name : "";
        $this->superadmin = $ALModel->superadmin ? ModelsEmployee::find($ALModel->superadmin)->employee_name : "";
        $this->cursorId = $ALModel->id;
        $this->formModal = true;
    }

    public function openDeleteModal($id) {
        $this->cursorId = $id;
        $this->deleteModal = true;
    }

    public function deleteData() {
        $d = ModelsApprovalLine::find($this->cursorId);
        $d->delete();
        $this->deleteModal = false;
    }

    public function saveData() {
        $this->validate();

        $this->validate([
            'direksi3' =>  ['nullable', Rule::exists('employees', 'employee_name')->where(function ($query) {
                $query->whereRaw('BINARY employee_name = ?', $this->direksi3);
            })],
            'presdir' =>  ['required', Rule::exists('employees', 'employee_name')->where(function ($query) {
                $query->whereRaw('BINARY employee_name = ?', $this->presdir);
            })],
            'corporateHR' =>  ['required', Rule::exists('employees', 'employee_name')->where(function ($query) {
                $query->whereRaw('BINARY employee_name = ?', $this->corporateHR);
            })],
            'superadmin' =>  ['required', Rule::exists('employees', 'employee_name')->where(function ($query) {
                $query->whereRaw('BINARY employee_name = ?', $this->superadmin);
            })],
        ]);

        if(isset($this->cursorId)){
            $al = ModelsApprovalLine::find($this->cursorId);
            $al->user_employee = $this->user_employee;
            $al->bisnis_unit_id = $this->bisnis_unit_id;
            $al->hr_unit = $this->hr_unit;
            $al->direksi_1 = $this->direksi1;
            $al->direksi_2 = $this->direksi2;
            $al->direksi_3 = ModelsEmployee::where('employee_name',$this->direksi3)->value('id');
            $al->presdir = ModelsEmployee::where('employee_name',$this->presdir)->value('id');
            $al->corporate_hr = ModelsEmployee::where('employee_name',$this->corporateHR)->value('id');
            $al->superadmin = ModelsEmployee::where('employee_name',$this->superadmin)->value('id');
            $al->save();
        }
        else{
            ModelsApprovalLine::create([
                'user_employee' => $this->user_employee,
                'bisnis_unit_id' => $this->bisnis_unit_id,
                'hr_unit' => $this->hr_unit,
                'direksi_1' => $this->direksi1,
                'direksi_2' => $this->direksi2,
                'direksi_3' => ModelsEmployee::where('employee_name',$this->direksi3)->value('id'),
                'presdir' => ModelsEmployee::where('employee_name',$this->presdir)->value('id'),
                'corporate_hr' => ModelsEmployee::where('employee_name',$this->corporateHR)->value('id'),
                'superadmin' => ModelsEmployee::where('employee_name',$this->superadmin)->value('id')
            ]);
        }
        $this->cursorId = null;
        $this->user_employee = null;
        $this->bisnis_unit_id = null;
        $this->hr_unit = null;
        $this->direksi1 = null;
        $this->direksi2 = null;
        $this->bisnis_unit_id = null;
        $this->direksi3 = "";
        $this->presdir = "";
        $this->corporateHR = "";
        $this->superadmin = "";
        $this->formModal = false;

    }


}
