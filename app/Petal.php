<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petal extends Model
{
    public function flower()
    {
        return $this->belongsTo('App\Flower');
    }
}
