<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class XoaLichRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            '_id'    =>  'required|exists:lich_chieus,_id',
        ];
    }

    public function messages()
    {
        return [
            '_id.*'    =>  'Lịch chiếu phim không tồn tại!',
        ];
    }
}
