<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'page_url',
        'route_name',
        'user_agent',
        'device',
        'browser',
        'platform',
        'referer',
        'created_at',
        'updated_at',
    ];
}
