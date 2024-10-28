<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fpk extends Model
{
    use HasFactory;

    public function details() {
        return $this->hasOne(FpkDetail::class);
    }
}