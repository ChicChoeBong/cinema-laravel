<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLichRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_phong'                  =>  'required|exists:phongs,id',
            'id_phim'                   =>  'required|exists:phims,id',
            'thoi_gian_chieu_chinh'     =>  'required|numeric|min:0',
            'thoi_gian_quang_cao'       =>  'required|numeric|min:0',
            // 'ngay_chieu'              =>  'required|date',
            // 'gio_bat_dau'               =>  'required|time',
            // 'gio_ket_thuc'              =>  'required|time',
        ];
    }
}
