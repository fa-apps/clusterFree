<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'reported_by_id', 'reported_for_id', 'tested_at'
    ];

    
    protected $casts = [
        'tested_at' => 'date',
    ];
}
