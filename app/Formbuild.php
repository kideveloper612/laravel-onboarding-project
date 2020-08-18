<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formbuild extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'form','section', 'phone'
    ];
}
