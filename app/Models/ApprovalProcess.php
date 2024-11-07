<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalProcess extends Model
{
    use HasFactory;

    public function fpk() {
        return $this->belongsTo(Fpk::class);
    }

    public function approvalLine() {
        return $this->belongsTo(ApprovalLine::class);
    }

    public function approvalSteps() {
        return $this->hasMany(ApprovalStep::class);
    }
}
