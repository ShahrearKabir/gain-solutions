<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Logic extends Model
{
    public function segment(){
        return $this->belongsTo('App\Model\Segment');
    }
}
