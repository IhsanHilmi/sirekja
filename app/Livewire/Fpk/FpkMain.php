<?php

namespace App\Livewire\Fpk;

use App\Models\ApprovalLine;
use App\Models\ApprovalProcess;
use App\Models\ApprovalStep;
use App\Models\Fpk;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class FpkMain extends Component
{
    use WithPagination;

    public $als = [], $allUser = [];
    public $detailModal = false, $deleteModal = false, $approvalProcessModal = false, $approvalStatusModal = false, $approveModal = false;
    public $sa_depthead = "", $sa_hr_unit = "", $sa_direksi_1 = "", $sa_direksi_2 = "", $sa_direksi_3 = "", $sa_presdir = "", $sa_corp_hr = "", $sa_superadmin = "";
    public $cursorId = null, $kodeFPK = null, $current_order = 0, $canApprove = false;
    public $approval_line_id = null, $dept_head_id = "",  $bisnis_unit_id = "",$hr_unit_id = "", $direksi_1_id = "", $direksi_2_id = "", $direksi_3_id = "", $presdir_id = "", $corp_hr_id = "", $superadmin_id = "";
    public $isUsingApprovalLine = false;
    public $tgl_effect = "", $detail_revisi = "", $detail_attachment = "", $detail_golongan = "", $detail_gender = "",  $detail_usia = "", $detail_thn_pengalaman = "", $detail_pendidikan = "", $detail_jurusan = "", $detail_lokasi_kerja = "", $detail_alasan = "", $detail_spesifikasi = "", $detail_deskripsi = "", $detail_hard_skills = "", $detail_soft_skills = "", $detail_catatan = ""; 

    public function mount(){
        // $this->fpks = Fpk::with('details','approvalProcess','jabatan')->get();
        $this->allUser = User::with('employee')->get(['id','name','role']);
    }

    public function render()
    {   
        $current_user_id = Auth::user()->id;
        $fpk_without_approval = [];
        $fpks = Fpk::with('details','approvalProcess','jabatan','issuedBy')->whereHas('approvalProcess.approvalSteps', function ($query) use ($current_user_id) {
            $query->where('user_id', $current_user_id);            
        })->orWhere('hr_unit_id', $current_user_id)->paginate(10);
        if(Auth::user()->role === 'Superadmin'){
            $fpk_without_approval = Fpk::with('details','approvalProcess','jabatan','issuedBy')->doesntHave('approvalProcess')->paginate(10);
        }
        return view('livewire.fpk.fpk-main',['fpks' => $fpks, 'fpks_no_al' => $fpk_without_approval]);
    }
    
    // Redirect ke form Tambah / Edit FPK
    public function redirectToFPKSubmission($cursorId = null) {
        
        if(isset($cursorId)){
            return redirect()->route('FPK Submission', ['cursorId' => intval($cursorId)]);    
        }
        return redirect()->route('FPK Submission');
    }

    // Redirect ke print
    public function redirectToFPKPrint($cursorId = null) {
        
    }

    // Fungsi pencegah error karena value Null
    protected function assignNullIfEmptyString($field) {
        if(trim($field) === ""){
            return null;
        }
            return $field;
    }
    
    // Fungsi reset data variabel yang terpakai secara manual
    public function setDefault(){
        $this->approval_line_id = "";
        $this->dept_head_id = "";
        $this->direksi_1_id = "";
        $this->direksi_2_id = "";
        $this->direksi_3_id = "";
        $this->presdir_id = "";
        $this->corp_hr_id = "";
        $this->superadmin_id = "";
        
    }

    public function setUsers() {
        $al = ApprovalLine::with('bisnisUnit','users')->find($this->approval_line_id);
        if(isset($al)){    
            $this->dept_head_id = optional($al->users()->wherePivot('approves_as','Dept. Head')->first())->id ?? "";
            $this->direksi_1_id = optional($al->users()->wherePivot('approves_as','Direksi 1')->first())->id ?? "";
            $this->direksi_2_id = optional($al->users()->wherePivot('approves_as','Direksi 2')->first())->id ?? "";
            $this->direksi_3_id = optional($al->users()->wherePivot('approves_as','Direksi 3')->first())->id ?? "";
            $this->presdir_id = optional($al->users()->wherePivot('approves_as','Presdir')->first())->id ?? "";
            $this->corp_hr_id = optional($al->users()->wherePivot('approves_as','Corp. HR')->first())->id ?? "";
            $this->superadmin_id = optional($al->users()->wherePivot('approves_as','Superadmin')->first())->id ?? "";   
        }
        $this->isUsingApprovalLine = true;
    }

    // Membuka modal Detail FPK
    public function openDetails($id) {
        $fpk = Fpk::with('details')->where('id',$id)->first();
        $this->kodeFPK = $fpk->kodeFPK;
        $this->tgl_effect = $fpk->tanggal_efektif;
        $this->detail_revisi = $fpk->details->revisi;
        $this->detail_golongan = $fpk->details->golongan;
        $this->detail_gender = $fpk->details->gender;
        $this->detail_usia = $fpk->details->usia;
        $this->detail_thn_pengalaman = $fpk->details->thn_pengalaman;
        $this->detail_pendidikan = $fpk->details->pendidikan;
        $this->detail_jurusan = $fpk->details->jurusan;
        $this->detail_lokasi_kerja = $fpk->details->lokasi_kerja;
        $this->detail_alasan = $fpk->details->alasan;
        $this->detail_spesifikasi = $fpk->details->spesifikasi;
        $this->detail_deskripsi = $fpk->details->deskripsi;
        $this->detail_hard_skills = $fpk->details->hard_skills;
        $this->detail_soft_skills = $fpk->details->soft_skills;
        $this->detail_catatan = $fpk->details->catatan;
        
        $this->detailModal = true;
    }

    // Membuka modal Set/Edit Approval Line
    public function openApprovalProcessModal($id) {
        $this->cursorId = $id;
        $fpk = Fpk::with('details','approvalProcess','jabatan','issuedBy')->find($id);
        $this->hr_unit_id = $fpk->issuedBy->id;
        $bisnis_unit_id = $fpk->jabatan->departemen->bisnisUnit->id;
        $steps = optional($fpk->approvalProcess)->approvalSteps ?? [];
        foreach ($steps as $step) {
            if(isset($step->user)){
                switch($step->approves_as){
                    case 'Superadmin':
                         $this->superadmin_id = optional($step->user)->id ?? "";
                        break;
                    case 'Presdir':
                         $this->presdir_id =  optional($step->user)->id ?? "";
                        break;
                    case 'Corp. HR':
                         $this->corp_hr_id =  optional($step->user)->id ?? "";
                        break;
                    case 'Direksi 1':
                         $this->direksi_1_id =  optional($step->user)->id ?? "";
                        break;
                    case 'Direksi 2':
                         $this->direksi_2_id =  optional($step->user)->id ?? "";
                        break;
                    case 'Direksi 3':
                         $this->direksi_3_id =  optional($step->user)->id ?? "";
                        break;
                    case 'Dept. Head':
                         $this->dept_head_id =  optional($step->user)->id ?? "";
                        break;
                    default:break;
                }
            }
        }
        $this->als = ApprovalLine::with('users')->where('bisnis_unit_id',$bisnis_unit_id)->get();
        $this->allUser = User::with('employee')->get();
        $this->approvalProcessModal = true;
    }

    // Membuka modal Delete
    public function openDeleteModal($id) {
        $this->cursorId = $id;
        $this->kodeFPK = Fpk::find($id)->kodeFPK;
        $this->deleteModal = true;
    }

    // Membuka modal Approval Status
    public function openApprovalStatusModal($id) {
        $this->cursorId = $id;
        $fpk = Fpk::with('approvalProcess')->find($this->cursorId);
        $this->kodeFPK = $fpk->kodeFPK;
        $steps = $fpk->approvalProcess->approvalSteps;
        foreach ($steps as $step) {
            if(isset($step->user)){
                switch($step->approves_as){
                    case 'Superadmin':
                         $this->sa_superadmin = $step->user->name . " | " . $step->approval_stat . " | " . $step->finished_time;
                        break;
                    case 'Presdir':
                         $this->sa_presdir = $step->user->name . " | " . $step->approval_stat . " | " . $step->finished_time;
                        break;
                    case 'Corp. HR':
                         $this->sa_corp_hr = $step->user->name . " | " . $step->approval_stat . " | " . $step->finished_time;
                        break;
                    case 'Direksi 1':
                         $this->sa_direksi_1 = $step->user->name . " | " . $step->approval_stat . " | " . $step->finished_time;
                        break;
                    case 'Direksi 2':
                         $this->sa_direksi_2 = $step->user->name . " | " . $step->approval_stat . " | " . $step->finished_time;
                        break;
                    case 'Direksi 3':
                         $this->sa_direksi_3 = $step->user->name . " | " . $step->approval_stat . " | " . $step->finished_time;
                        break;
                    case 'Dept. Head':
                         $this->sa_depthead = $step->user->name . " | " . $step->approval_stat . " | " . $step->finished_time;
                        break;
                    default:break;
                }
            }
            
        }
        $this->approvalStatusModal = true;
    }

    // membuka modal Give Approval
    public function openApproveModal($id){
        $this->cursorId = $id;
        $fpk = Fpk::with('approvalProcess.approvalSteps')->find($id);
        $this->kodeFPK = $fpk->kodeFPK;
        $current_order = $fpk->approvalProcess->current_order;
        $step_order = ApprovalStep::whereHas('approvalProcess', function ($query) use ($id){
            $query->where('fpk_id', $id);
        })->where('user_id', Auth::user()->id)->value('order');
        $this->canApprove = ($step_order == $current_order);
        $this->approveModal = true;
    }

    // Proses setelah button Delete di Delete Modal
    public function deleteData() {
        $fpk = Fpk::find($this->cursorId);
        $fpk->delete();
        $this->deleteModal = false;
    }

    // Proses setelah button save di Set/Edit Approval Line Modal
    public function saveApprovalProcessData(){
        $fpk = Fpk::with('details','approvalProcess','issuedBy')->find($this->cursorId);
        if(isset($fpk->approvalProcess)){
            $ap = ApprovalProcess::find($fpk->approvalProcess->id);
            $steps = ApprovalStep::all()->where('approval_process_id',$ap->id);
            $ap->approval_line_id = $this->assignNullIfEmptyString($this->approval_line_id);
            
            foreach ($steps as $step) {
                switch($step->approves_as){
                    case 'Superadmin':
                        $step->user_id = $this->assignNullIfEmptyString($this->superadmin_id);
                        break;
                    case 'Presdir':
                        $step->user_id = $this->assignNullIfEmptyString($this->presdir_id);
                        break;
                    case 'Corp. HR':
                        $step->user_id = $this->assignNullIfEmptyString($this->corp_hr_id);
                        break;
                    case 'Direksi 1':
                        $step->user_id = $this->assignNullIfEmptyString($this->direksi_1_id);
                        break;
                    case 'Direksi 2':
                        $step->user_id = $this->assignNullIfEmptyString($this->direksi_2_id);
                        break;
                    case 'Direksi 3':
                        $step->user_id = $this->assignNullIfEmptyString($this->direksi_3_id);
                        break;
                    case 'Dept. Head':
                        $step->user_id = $this->assignNullIfEmptyString($this->dept_head_id);
                        break;
                    default:break;
                }
                $step->approval_stat = 'No action yet';
                $step->finished_time = null;
                $step->save();
            }
            $ap->approval_status = 'Pending/On Going';
            $ap->finished_time = null;
            $ap->save();

        }else{
            $ap = ApprovalProcess::create([
                'approval_line_id' => $this->assignNullIfEmptyString($this->approval_line_id),
                'fpk_id' => $this->cursorId,
            ]);
            $approval_steps = [
                ['approval_process_id' => $ap->id, 'user_id' => $this->assignNullIfEmptyString($this->dept_head_id), 'approves_as' => 'Dept. Head', 'order' => 1],
                ['approval_process_id' => $ap->id, 'user_id' => $this->assignNullIfEmptyString($this->direksi_1_id),'approves_as' => 'Direksi 1', 'order' =>2],
                ['approval_process_id' => $ap->id, 'user_id' => $this->assignNullIfEmptyString($this->direksi_2_id),'approves_as' => 'Direksi 2', 'order' =>3],
                ['approval_process_id' => $ap->id, 'user_id' => $this->assignNullIfEmptyString($this->direksi_3_id),'approves_as' => 'Direksi 3', 'order' =>4],
                ['approval_process_id' => $ap->id, 'user_id' => $this->assignNullIfEmptyString($this->presdir_id),'approves_as' => 'Presdir', 'order' => 5],
                ['approval_process_id' => $ap->id, 'user_id' => $this->assignNullIfEmptyString($this->corp_hr_id),'approves_as' => 'Corp. HR', 'order' => 6],
                ['approval_process_id' => $ap->id, 'user_id' => $this->assignNullIfEmptyString($this->superadmin_id),'approves_as' => 'Superadmin', 'order' => 7]
            ];
            foreach ($approval_steps as $step) {
                ApprovalStep::create($step);
            }
        }
        $this->cursorId = null;
        $this->isUsingApprovalLine = false;
        $this->bisnis_unit_id = "";
        $this->setDefault();
        $this->approvalProcessModal = false;
    }

    // Proses setelah button Approve dan Reject di modal Give Approval
    public function approveFPK($response){
        $aps = ApprovalProcess::with('approvalSteps')->where('fpk_id', $this->cursorId)->first();
        $approver = Auth::user()->id;
        $step = ApprovalStep::where('approval_process_id', $aps->id)->where('user_id', $approver)->first();
        $step->finished_time = now();
        switch ($response) {
            case 'Approve':
                $step->approval_stat = 'Approved';
                $aps->current_order++;
                if($aps->current_order == 8){
                    $aps->finished_time = now();
                    $aps->approval_status = 'Approved';
                }
                else{
                    $aps->approval_status = "Pending/On Going"; 
                }
                break;
            case 'Reject':
                $step->approval_stat = 'Rejected';
                $aps->approval_status = 'Rejected';
                $aps->current_order = $step->order;
                    for($counter = $step->order + 1;$counter < 8;$counter++){
                        $further_step = ApprovalStep::where('approval_process_id', $aps->id)->where('order', $counter)->first();
                        $further_step->approval_stat = "No action yet";
                        $further_step->finished_time = null;
                        $further_step->save();
                    }
                break;
            default:
                break;
        }
        $step->save();
        $aps->save();
        $this->approveModal = false;
        $this->cursorId = null;
    }

    public function printFPK($id) {
        return redirect()->route('Print FPK', ['id' => $id]);
    }
}
