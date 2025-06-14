<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $primary_key = 'userId';
    public $timestamps = false;
    public $fillable = ['roleId', 'fieldId', 'areaId', 'firstName', 'lastName', 'email', 'phone', 'birthDate', 'gender', 'image', 'password', 'status'];
}
