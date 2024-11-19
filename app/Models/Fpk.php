<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fpk extends Model
{
    use HasFactory;

    protected $fillable = ['kodeFPK','jabatan_id','jenis_FPK','tanggal_efektif', 'hr_unit_id' ,'attachment'];

    public function issuedBy() {
        return $this->belongsTo(User::class);
    }

    public function jabatan() {
        return $this->belongsTo(Jabatan::class);
    }
    public function details() {
        return $this->hasOne(FpkDetail::class);
    }

    public function approvalProcess() {
        return $this->hasOne(ApprovalProcess::class);
    }

}
