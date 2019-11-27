<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Support\GeneratesUuid;

class Post extends Model
{
    use GeneratesUuid;

    protected $casts = ['id' => 'uuid', 'user_id' => 'uuid'];

    public $incrementing = false;

    public function uuidColumns(): array
    {
        return ['id', 'user_id'];
    }


    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
