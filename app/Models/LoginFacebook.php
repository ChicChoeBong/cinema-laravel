<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginFacebook extends Model
{
    use HasFactory;
    protected $table = 'login_fbs';

    protected $fillable = [
        'id_user',
        'name',
        'email',
    ];
}
