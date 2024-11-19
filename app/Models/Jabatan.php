<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_jabatan','departemen_id'];

    public function departemen() {
        return $this->belongsTo(Departemen::class, 'departemen_id');
    }

    public function employees() {
        return $this->hasMany(Employee::class, 'jabatan_id');
    }

    public function fpks()  {
        return $this->hasMany(Fpk::class, 'jabatan_id');
    }
}
