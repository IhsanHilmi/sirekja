<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ApprovalLineUser extends Pivot
{
    protected $table = 'approval_line_user';
}
