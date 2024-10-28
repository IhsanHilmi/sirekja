<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalLine extends Model
{
    use HasFactory;

    protected $fillable = ['user_employee', 'bisnis_unit_id', 'hr_unit', 'direksi_1', 'direksi_2', 'direksi_3', 'presdir', 'corporate_hr', 'superadmin'];

    public function bisnisUnit(){
        return $this->belongsTo(BisnisUnit::class, 'bisnis_unit_id');
    }

    public function hrUnit(){
        return $this->belongsTo(Employee::class, 'hr_unit');
    }

    public function direksi1(){
        return $this->belongsTo(Employee::class, 'direksi_1');
    }

    public function direksi2(){
        return $this->belongsTo(Employee::class, 'direksi_2');
    }

    public function direksi3(){
        return $this->belongsTo(Employee::class, 'direksi_3');
    }

    public function Presdir(){
        return $this->belongsTo(Employee::class, 'presdir');
    }

    public function corporateHR(){
        return $this->belongsTo(Employee::class, 'corporate_hr');
    }

    public function Superadmin(){
        return $this->belongsTo(Employee::class, 'superadmin');
    }
}
