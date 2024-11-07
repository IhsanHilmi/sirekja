<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FpkDetail extends Model
{
    use HasFactory;

    protected $fillable = ['FPK_id','golongan','gender','usia','thn_pengalaman','pendidikan','jurusan','lokasi_kerja','alasan','spesifikasi','deskripsi','hard_skills','soft_skills','catatan','revisi'];

    public function fromFPK() {
        return $this->belongsTo(Fpk::class);
    }
}
