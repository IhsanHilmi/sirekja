<?php

namespace App\Livewire\Employee;

use App\Actions\Fortify\CreateNewUser;
use App\Models\BisnisUnit as ModelsBisnisUnit;
use App\Models\Departemen as ModelsDepartemen;
use App\Models\Jabatan as ModelsJabatan;
use App\Models\Employee as ModelsEmployee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeMain extends Component
{
    use WithPagination;
    
    public $deleteModal = false;
    public $formModal = false;
    public $cursorId = null;
    public $employee_name = "", $golongan = "", $status = "", $tanggal_bergabung = null, $email = "", $acc_role = "";
    public $bisnis_unit_id = "";
    public $departemen_id = "";
    public $jabatan_id = "";
    public $user_id = "";
    public $bu = [], $d = [], $j = [];

    protected $rules = [
        'employee_name' => ['required', 'string'],
        'jabatan_id' => ['required', 'exists:jabatans,id'],
        'golongan' => ['required',"regex:'0[1-6]|24|25'"],
        'status' => ['required', 'in:Kontrak,Bulan'],
        'tanggal_bergabung' => ['required','date'],
        'email' => ['required', 'unique:users'],
        'acc_role' => ['required', 'in:Superadmin,HR,Employee']
    ];
    
    public function mount(){
        $this->bu = ModelsBisnisUnit::select('id','nama_bisnis_unit')->get();
    }

    public function mountDepartemens(){
        $this->d = ModelsDepartemen::where('bisnis_unit_id',$this->bisnis_unit_id)->get();
        $this->departemen_id = "";
        $this->jabatan_id = "";
    }

    public function mountJabatans(){
        $this->j = ModelsJabatan::where('departemen_id',$this->departemen_id)->get();
        $this->jabatan_id = "";
    }

    public function redirectToEmployeeTransfer(){
        return redirect()->route('employee transfer');
    }

    public function render()
    {
        return view('livewire.employee.employee-main', ['allEmployee' => ModelsEmployee::with('jabatan')->paginate(25)]);
    }

    public function openFormModalForAdd() {
        $this->cursorId = null;
        $this->user_id = null;
        $this->employee_name = null;
        $this->golongan = null;
        $this->status = null;
        $this->tanggal_bergabung = null;
        $this->bisnis_unit_id = "";
        $this->departemen_id = "";
        $this->jabatan_id = "";
        $this->email = "";
        $this->acc_role = "";
        $this->formModal = true;
    }

    public function openFormModalForEdit(ModelsEmployee $EModel) {
        $this->cursorId = $EModel->id;
        $this->user_id = $EModel->user->id;
        $this->employee_name = $EModel->employee_name;
        $this->golongan = $EModel->golongan;
        $this->status = $EModel->status;
        $this->tanggal_bergabung = $EModel->tanggal_bergabung;
        $this->bisnis_unit_id = $EModel->jabatan->departemen->bisnisUnit->id;
        $this->d = ModelsDepartemen::where('bisnis_unit_id',$this->bisnis_unit_id)->get();
        $this->departemen_id = $EModel->jabatan->departemen->id;
        $this->j = ModelsJabatan::where('departemen_id',$this->departemen_id)->get();
        $this->jabatan_id = $EModel->jabatan->id;
        $this->email = $EModel->user->email;
        $this->acc_role = $EModel->user->role;
        $this->formModal = true;
    }

    public function openDeleteModal($id) {
        $this->cursorId = $id;
        $this->employee_name = ModelsEmployee::find($id)->employee_name;
        $this->deleteModal = true;
    }

    public function deleteData() {
        $d = ModelsEmployee::find($this->cursorId);
        $d->delete();
        $this->deleteModal = false;
    }

    public function saveData() {
        $this->validate();
        if(isset($this->cursorId)){
            $e = ModelsEmployee::find($this->cursorId);
            $u = User::find($e->id);
            $e->employee_name = $this->employee_name;
            $e->jabatan_id = $this->jabatan_id;
            $e->golongan = $this->golongan;
            $e->status = $this->status;
            $e->tanggal_bergabung = $this->tanggal_bergabung;
            $u->name = $this->employee_name;
            $u->role = $this->acc_role;
            $u->email = $this->email;
            $e->save();
            $u->save();
        }
        else{
            $e = ModelsEmployee::create([
                'employee_name' => $this->employee_name,
                'jabatan_id' => $this->jabatan_id,
                'golongan' => $this->golongan,
                'status' => $this->status,
                'tanggal_bergabung' => $this->tanggal_bergabung
            ]);

            User::create([
                'name' => $this->employee_name,
                'email' => $this->email,
                'password' => Hash::make($this->employee_name),
                'role' => $this->acc_role,
                'employee_id' => $e->id
            ]);
        }
        $this->formModal = false;
        $this->bisnis_unit_id = "";
        $this->departemen_id = "";
        $this->jabatan_id = "";
        $this->cursorId = null;
        $this->employee_name = null;
        $this->golongan = null;
        $this->status = null;
        $this->tanggal_bergabung = null;
    }
}
