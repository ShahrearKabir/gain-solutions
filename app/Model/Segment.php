<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Segment extends Model
{
    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public function logic(){
        return $this->hasMany('App\Model\Logic');
    }
}
