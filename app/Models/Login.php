<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Login extends Authenticatable implements CanResetPassword
{
    use HasFactory, CanResetPasswordTrait;

    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
    ];
}

