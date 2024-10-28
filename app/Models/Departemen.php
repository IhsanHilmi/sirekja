<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;

    protected $fillable = ['nama_departemen','bisnis_unit_id'];

    public function bisnisUnit() {
        return $this->belongsTo(BisnisUnit::class, 'bisnis_unit_id');
    }

    public function jabatans(){
        return $this->hasMany(Jabatan::class, 'departemen_id');
    }
}
