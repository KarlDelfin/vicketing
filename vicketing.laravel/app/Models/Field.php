<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    public $primary_key = 'fieldId';
    public $timestamps = false;
    public $fillable = ['fieldName'];
}
