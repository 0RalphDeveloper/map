<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Create extends Model
{
    use HasFactory;

    protected $fillable = [
        "username",
        "email",
        "password",
        "role",
    ];
}
