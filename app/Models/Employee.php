<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['employee_name','jabatan_id','golongan','status','tanggal_bergabung','jabatan_id'];

    public function jabatan() {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }
    public function user() {
        return $this->hasOne(User::class);
    }
}
