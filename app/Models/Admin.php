<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin';
    protected $primaryKey = 'Username';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['Username', 'password'];
}
