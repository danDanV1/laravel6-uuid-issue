<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Support\GeneratesUuid;

class Post extends Model
{
    use GeneratesUuid;

    protected $casts = ['id' => 'uuid'];

    public function uuidColumn(): string
    {
        return 'id';
    }


    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
