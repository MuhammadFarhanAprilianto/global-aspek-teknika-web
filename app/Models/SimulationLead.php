<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulationLead extends Model
{
    use HasFactory;

    protected $fillable = [
        'pic_name',
        'company_name',
        'job_title',
        'email',
        'phone',
        'domain',
        'simulation_date',
        'notes',
        'simulation_params',
        'status',
    ];

    protected $casts = [
        'simulation_params' => 'array',
        'simulation_date' => 'date',
    ];
}
