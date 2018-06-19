<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{

    protected $fillable = [
        'id', 'queue', 'payload', 'available_at', 'created_at',
    ];

}
