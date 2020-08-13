<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{

    protected $table = 'visits';

    protected $fillable = [
        'rlp_id', 'vlp_id'
    ];


    public function users()
    {
        return $this->belongsTo('App\User','visits_vlp_id_foreign');
    }
}
