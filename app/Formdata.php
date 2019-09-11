<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formdata extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'formContent',
    ];
}
