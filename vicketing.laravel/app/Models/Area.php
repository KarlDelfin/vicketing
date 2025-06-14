<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public $primary_key = 'areaId';
    public $timestamps = false;
    public $fillable = ['areaName'];
}
