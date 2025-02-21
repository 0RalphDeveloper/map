<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Login extends Authenticatable
{
    use HasFactory;

    protected $fillable= 
    [
        'username',
        'email',
        'password',
        'role',

    ];
    
}
