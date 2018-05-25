<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sub extends Model
{
    protected $table = "sub";
    public $timestamps = false;

    function user()
    {
        return $this->belongsTo(User::class, 'userid', 'id');
    }
}
