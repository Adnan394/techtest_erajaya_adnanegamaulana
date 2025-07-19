<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePeriod extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'company_id',
        'division_id',
        'level_id',
        'gender_id',
        'period'
    ];
}
