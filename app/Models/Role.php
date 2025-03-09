<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    const ALL_ROLE = [
        self::ROLE_ADMIN,
        self::ROLE_USER
    ];

    protected $fillable = [
        'role'
    ];
}
