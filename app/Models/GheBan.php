<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class GheBan extends Model
{
    use HasFactory;

    protected $table = 'ghe_bans';

    protected $attributes = [
        'co_the_ban' => 1,
    ];

    protected $fillable = [
        'ten_ghe',
        'id_lich',
        'co_the_ban',
        'ma_giao_dich',
        'id_khach_hang',
        'trang_thai',
        'id_bill_ngan_hang'
    ];
}
