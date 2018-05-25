<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermanentJob extends Model
{
    protected $table = "job_per";
    public $timestamps = false;

    function user()
    {
        return $this->belongsTo(User::class, 'userid', 'id');
    }
}
