<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalStep extends Model
{
    protected $fillable = ['approval_process_id', 'user_id', 'approves_as', 'approval_stat', 'order', 'finished_time'];
    use HasFactory;

    public function approvalProcess() {
        return $this->belongsTo(ApprovalProcess::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    
}
