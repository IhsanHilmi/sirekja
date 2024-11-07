<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalLine extends Model
{
    use HasFactory;

    protected $fillable = ['bisnis_unit_id', 'approval_line_desc'];

    public function approvalProcesses() {
        return $this->hasMany(ApprovalProcess::class);
    }

    public function bisnisUnit() {
        return $this->belongsTo(BisnisUnit::class);
    }

    public function users(){
        return $this->belongsToMany(User::class, 'approval_line_user')->withPivot('order','approves_as');
    }

}
