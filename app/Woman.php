<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Woman extends Model
{
    protected $fillable = ['name', 'city', 'website', 'image'];
}
