<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckIdPhimRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            '_id'    =>  'required|exists:phims,_id',
        ];
    }

    public function messages()
    {
        return [
            '_id.*'  => 'Phim phải tồn tại trong hệ thống!',
        ];
    }
}
