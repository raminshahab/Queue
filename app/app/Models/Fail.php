<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fail extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'failed_jobs';

    protected $fillable = [
        'id', 'connection', 'queue', 'failed_at',
    ];

}
