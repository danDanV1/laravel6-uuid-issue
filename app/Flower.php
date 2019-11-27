<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flower extends Model
{
    public function petals()
    {
        return $this->hasMany('App\Petal');
    }
}
