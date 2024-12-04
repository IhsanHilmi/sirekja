<?php

namespace App\Livewire;

use App\Models\ApprovalLine as ModelsApprovalLine;
use App\Models\ApprovalLineUser;
use App\Models\BisnisUnit as ModelsBisnisUnit;
use App\Models\Employee as ModelsEmployee;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class ApprovalLine extends Component
{
    use WithPagination;

    public $deleteModal = false;
    public $formModal = false;
    public $cursorId = null;
    public $approval_line_desc = "";
    public $dept_head_id = "",  $bisnis_unit_id = "", $direksi_1_id = "", $direksi_2_id = "", $direksi_3_id = "", $presdir_id = "", $corp_hr_id = "", $superadmin_id = "";
    
    public $e = [];
    public $al = [];
    public $bu = [];


    protected $rules = [
        'bisnis_unit_id' => ['required', 'exists:bisnis_units,id'],
        'dept_head_id' => ['required', 'exists:users,id'],
        'direksi_1_id' => ['required', 'exists:users,id'],
        'direksi_2_id' => ['nullable', 'exists:users,id'],
        'direksi_3_id' => ['nullable', 'exists:users,id'],
        'presdir_id' => ['required', 'exists:users,id'],
        'corp_hr_id' => ['required', 'exists:users,id'],
        'superadmin_id' => ['required', 'exists:users,id']
    ];

    
    public function mount(){
        $this->bu = ModelsBisnisUnit::all();

    //     $this->e = ModelsEmployee::select('id','employee_name')->get();
    }

    public function render()
    {
        $allApprovalLine = ModelsApprovalLine::with('users')->paginate(25);
        $allUser = User::with('employee')->get();
        return view('livewire.approval-line', ['allApprovalLine'=> $allApprovalLine, 'allUser' => $allUser]);
    }

    protected function assignNullIfEmptyString($field) {
        if(trim($field) === ""){
            return null;
        }
            return $field;
    }
    
    public function openFormModalForAdd() {
        $this->cursorId = null;
        $this->bisnis_unit_id = "";
        $this->formModal = true;

    }

    public function openFormModalForEdit(ModelsApprovalLine $ALModel) {
        $this->bisnis_unit_id = $ALModel->bisnis_unit_id;
        $this->approval_line_desc = $ALModel->approval_line_desc;
        $this->dept_head_id = optional($ALModel->users()->wherePivot('approves_as','Dept. Head')->first())->id ?? "";
        $this->direksi_1_id = optional($ALModel->users()->wherePivot('approves_as','Direksi 1')->first())->id ?? "";
        $this->direksi_2_id = optional($ALModel->users()->wherePivot('approves_as','Direksi 2')->first())->id ?? "";
        $this->direksi_3_id = optional($ALModel->users()->wherePivot('approves_as','Direksi 3')->first())->id ?? "";
        $this->presdir_id = optional($ALModel->users()->wherePivot('approves_as','Presdir')->first())->id ?? "";
        $this->corp_hr_id = optional($ALModel->users()->wherePivot('approves_as','Corp. HR')->first())->id ?? "";
        $this->superadmin_id = optional($ALModel->users()->wherePivot('approves_as','Superadmin')->first())->id ?? "";
        $this->cursorId = $ALModel->id;
        $this->formModal = true;
    }

    public function openDeleteModal($id) {
        $this->cursorId = $id;
        $this->deleteModal = true;
    }

    public function deleteData() {
        $al = ModelsApprovalLine::find($this->cursorId);
        $al->delete();
        $this->deleteModal = false;
    }

    public function saveData() {
        $this->validate();
        $this->dept_head_id = $this->assignNullIfEmptyString($this->dept_head_id);
        $this->direksi_1_id = $this->assignNullIfEmptyString($this->direksi_1_id);
        $this->direksi_2_id = $this->assignNullIfEmptyString($this->direksi_2_id);
        $this->direksi_3_id = $this->assignNullIfEmptyString($this->direksi_3_id);
        $this->presdir_id = $this->assignNullIfEmptyString($this->presdir_id);
        $this->corp_hr_id = $this->assignNullIfEmptyString($this->corp_hr_id);
        $this->superadmin_id = $this->assignNullIfEmptyString($this->superadmin_id);

        if(isset($this->cursorId)){
            $al = ModelsApprovalLine::find($this->cursorId);
            $alus = ApprovalLineUser::all()->where('approval_line_id',$this->cursorId);
            
            $al->bisnis_unit_id = $this->bisnis_unit_id;
            $al->approval_line_desc = $this->approval_line_desc;
            foreach ($alus as $alu) {
                switch($alu->approves_as){
                    case 'Superadmin':
                        $alu->user_id = $this->superadmin_id;
                        break;
                    case 'Presdir':
                        $alu->user_id = $this->presdir_id;
                        break;
                    case 'Corp. HR':
                        $alu->user_id = $this->corp_hr_id;
                        break;
                    case 'Direksi 1':
                        $alu->user_id = $this->direksi_1_id;
                        break;
                    case 'Direksi 2':
                        $alu->user_id = $this->direksi_2_id;
                        break;
                    case 'Direksi 3':
                        $alu->user_id = $this->direksi_3_id;
                        break;
                    case 'Dept. Head':
                        $alu->user_id = $this->dept_head_id;
                        break;
                    default:break;
                }
                $alu->save();  
            }
            $al->save();
        }
        else{
            $al = ModelsApprovalLine::create([
                'bisnis_unit_id' => $this->bisnis_unit_id,
                'approval_line_desc' => $this->approval_line_desc
            ]);
            $alus = [
                ['approval_line_id' => $al->id, 'user_id' => $this->dept_head_id, 'approves_as' => 'Dept. Head', 'order' => 1],
                ['approval_line_id' => $al->id, 'user_id' => $this->direksi_1_id,'approves_as' => 'Direksi 1', 'order' =>2],
                ['approval_line_id' => $al->id, 'user_id' => $this->direksi_2_id,'approves_as' => 'Direksi 2', 'order' =>3],
                ['approval_line_id' => $al->id, 'user_id' => $this->direksi_3_id,'approves_as' => 'Direksi 3', 'order' =>4],
                ['approval_line_id' => $al->id, 'user_id' => $this->presdir_id,'approves_as' => 'Presdir', 'order' => 5],
                ['approval_line_id' => $al->id, 'user_id' => $this->corp_hr_id,'approves_as' => 'Corp. HR', 'order' => 6],
                ['approval_line_id' => $al->id, 'user_id' => $this->superadmin_id,'approves_as' => 'Superadmin', 'order' => 7]
            ];
            foreach ($alus as $alu) {
                ApprovalLineUser::create($alu);
            }
        }
        
        $this->cursorId = null;
        $this->approval_line_desc = "";
        $this->bisnis_unit_id = "";
        $this->dept_head_id = "";
        $this->direksi_1_id = "";
        $this->direksi_2_id = "";
        $this->direksi_3_id = "";
        $this->presdir_id = "";
        $this->corp_hr_id = "";
        $this->superadmin_id = "";
        $this->formModal = false;
    }


}
