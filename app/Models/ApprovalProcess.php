<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalProcess extends Model
{
    protected $fillable = ['approval_line_id', 'fpk_id', 'current_order', 'approval_status', 'finished_time'];
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
