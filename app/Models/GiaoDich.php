<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class GiaoDich extends Model
{
    use HasFactory;

    protected $table = 'giao_dichs';

    protected $fillable = [
        'Reference',
        'Description',
        'Amount',
    ];
}
