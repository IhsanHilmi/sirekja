<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FpkDetail extends Model
{
    use HasFactory;

    public function fromFPK() {
        return $this->belongsTo(Fpk::class);
    }
}
