<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fpk extends Model
{
    use HasFactory;

    protected $fillable = ['kodeFPK','jabatan_id','jenis_FPK','tanggal_efektif'];

    public function details() {
        return $this->hasOne(FpkDetail::class);
    }

    public function approvalProcess() {
        return $this->hasOne(ApprovalProcess::class);
    }

}
