<?php

namespace App\Livewire\Fpk;

use App\Models\ApprovalLine;
use App\Models\ApprovalProcess;
use App\Models\BisnisUnit;
use App\Models\Departemen;
use App\Models\Fpk;
use App\Models\FpkDetail;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class SubmissionForm extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $cursorId;
    public $currentFile = null;
    public $deleteModal = false;
    public $bisnis_unit_id = "", $departemen_id = "", $jabatan_id = "";
    public $kodeFPK, $hr_unit_id = "", $hr_unit_name = "", $jenis_fpk = "New Hire",  $golongan = "", $in_file = null, $file_path = null, $tgl_effect = "", $usia = 0, $gender = "Both", $work_exp = 0, $last_edu = "SMA/SMK/MA", $jurusan = "", $lokasi_kerja = "", $alasan = "", $job_spec = "", $job_desc, $soft_skills = "", $hard_skills = "", $catatan = "";
    public $bu = [], $d = [], $j = [], $f = [], $user_al = [];

    protected $rules = [
        'jabatan_id' => ['required', 'exists:jabatans,id'],
        'hr_unit_id' => ['required','exists:users,id'],
        'jenis_fpk' => ['required', "in:New Hire,Resign"],
        'tgl_effect' => ['required', 'date'],
        'in_file' => ['nullable', 'file', 'max:10240'],
        'golongan' => ['required', "regex:'0[1-6]|24|25'"],
        'gender' => ['required', "in:L,P,Both"],
        'usia' => ['required', 'numeric','gt:16','lt:100'],
        'work_exp' => ['required', 'numeric'],
        'last_edu' => ['required', "in:SMA/SMK/MA,DIII,S1,S2"],
        'jurusan' => ['nullable','string'],
        'lokasi_kerja' => ['required','string'],
        'alasan' => ['nullable','string'],
        'job_spec' => ['required','string'],
        'job_desc' => ['required','string'],
        'hard_skills' => ['required', 'string'],
        'soft_skills' => ['required', 'string'],
        'catatan' => ['nullable','string']
    ];

    public function mount($cursorId = null)
    {
        
        $this->bu = BisnisUnit::select('id','nama_bisnis_unit')->get();
        // $this->user_al = ApprovalLine::with('users')->whereHas('users',function ($query) {
        //     $query->where('user_id', $this->hr_unit_id)->where('approves_as','HR Unit');
        // })->get();

        $this->cursorId = $cursorId;
        if($cursorId == null){
            $nextId = DB::table('fpks')
            ->select(DB::raw('AUTO_INCREMENT'))
            ->from('information_schema.tables')
            ->where('table_name', 'fpks')
            ->where('table_schema', DB::getDatabaseName())
            ->first()
            ->AUTO_INCREMENT;
            $this->kodeFPK = 'FPK-'.sprintf('%02d',$nextId);
            $this->hr_unit_id = Auth::user()->id;
            $this->hr_unit_name = Auth::user()->name;
        }
        else{
            $fpk = Fpk::with('details', 'approvalProcess', 'jabatan','issuedBy')->find($cursorId);
            $this->kodeFPK = $fpk->kodeFPK;
            $this->hr_unit_id = $fpk->hr_unit_id;
            $this->hr_unit_name = $fpk->issuedBy->name;
            $this->bisnis_unit_id = $fpk->jabatan->departemen->bisnisUnit->id;
            $this->d = Departemen::where('bisnis_unit_id',$this->bisnis_unit_id)->get();
            $this->departemen_id = $fpk->jabatan->departemen->id;
            $this->j = Jabatan::where('departemen_id',$this->departemen_id)->get();
            $this->jabatan_id = $fpk->jabatan_id;
            $this->jenis_fpk = $fpk->jenis_FPK;
            $this->tgl_effect = $fpk->tanggal_efektif;
            $this->currentFile = $fpk->attachment;
            $this->golongan = $fpk->details->golongan;
            $this->gender = $fpk->details->gender;
            $this->usia = $fpk->details->usia;
            $this->work_exp = $fpk->details->thn_pengalaman;
            $this->last_edu = $fpk->details->pendidikan;
            $this->jurusan = $fpk->details->jurusan;
            $this->lokasi_kerja = $fpk->details->lokasi_kerja;
            $this->alasan = $fpk->details->alasan;
            $this->job_spec = $fpk->details->spesifikasi;
            $this->job_desc = $fpk->details->deskripsi;
            $this->hard_skills = $fpk->details->hard_skills;
            $this->soft_skills = $fpk->details->soft_skills;
            $this->catatan = $fpk->details->catatan;
        }
    }

    public function mountDepartemens(){
        $this->d = Departemen::where('bisnis_unit_id',$this->bisnis_unit_id)->get();
        $this->departemen_id = "";
        $this->jabatan_id = "";
    }

    public function mountJabatans(){
        $this->j = Jabatan::where('departemen_id',$this->departemen_id)->get();
        $this->jabatan_id = "";
    }

    public function render()
    {   
        
        return view('livewire.fpk.submission-form');
    }

    public function submitFPK()
    {
        
        $this->validate();

        if($this->in_file){
            $newFileName = $this->kodeFPK . '_attachment_' . $this->in_file->getClientOriginalName();
            $this->file_path = $this->in_file->storeAs('FPKs',$newFileName,'public');
        }
        else{
            $this->file_path = $this->currentFile;
        }

        if(isset($this->cursorId)){
            $fpk = Fpk::with('details')->find($this->cursorId);
            $fpk->kodeFPK = $this->kodeFPK;
            $fpk->jabatan_id = $this->jabatan_id;
            $fpk->jenis_FPK = $this->jenis_fpk;
            $fpk->tanggal_efektif = $this->tgl_effect;
            $fpk->attachment = $this->file_path;
            $fpk_details = $fpk->details;
            $fpk_details->golongan = $this->golongan;
            $fpk_details->gender = $this->gender;
            $fpk_details->usia = $this->usia;
            $fpk_details->thn_pengalaman = $this->work_exp;
            $fpk_details->pendidikan = $this->last_edu;
            $fpk_details->jurusan = $this->jurusan;
            $fpk_details->lokasi_kerja = $this->lokasi_kerja;
            $fpk_details->alasan = $this->alasan;
            $fpk_details->spesifikasi = $this->job_spec;
            $fpk_details->deskripsi = $this->job_desc;
            $fpk_details->hard_skills = $this->hard_skills;
            $fpk_details->soft_skills = $this->soft_skills;
            $fpk_details->catatan = $this->catatan;
            $fpk_details->save();

            $ap = ApprovalProcess::where('fpk_id',$fpk->id)->get()->first();
            $ap->delete();
            
        }
        else{
            $this->validate([
                'kodeFPK' => ['required', 'unique:fpks,kodeFPK', 'string']
            ]);
            $fpk = Fpk::create([
                'kodeFPK' => $this->kodeFPK,
                'jabatan_id' => $this->jabatan_id,
                'jenis_FPK' => $this->jenis_fpk,
                'tanggal_efektif' => $this->tgl_effect,
                'hr_unit_id' => $this->hr_unit_id,
                'attachment' => $this->file_path
            ]);
            $fpk->details()->create([
                'golongan' => $this->golongan,
                'gender' => $this->gender,
                'usia' => $this->usia,
                'thn_pengalaman' => $this->work_exp,
                'pendidikan' => $this->last_edu,
                'jurusan' => $this->jurusan,
                'lokasi_kerja' => $this->lokasi_kerja,
                'alasan' => $this->alasan,
                'spesifikasi' => $this->job_spec,
                'deskripsi' => $this->job_desc,
                'hard_skills' => $this->hard_skills,
                'soft_skills' => $this->soft_skills,
                'catatan' => $this->catatan
            ]);
        }
        return redirect()->route('FPK Main');
    }

}
