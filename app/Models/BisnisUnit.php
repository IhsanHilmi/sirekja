<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BisnisUnit extends Model
{
    use HasFactory;

    protected $fillable = ['nama_bisnis_unit'];

    public function departemens() {
        return $this->hasMany(Departemen::class, 'bisnis_unit_id');
    }
}
