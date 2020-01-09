<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bird extends Model
{
    protected $fillable = [
        'tracker_id', 'name', 'is-female'
    ];
}
