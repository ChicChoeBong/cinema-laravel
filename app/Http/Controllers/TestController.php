<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $ten_san_pham = 'Iphone 14 Promax do controller';

        return view('vue_01', compact('ten_san_pham'));
    }

    public function jquery()
    {
        dd(phpinfo());

       return view('AdminRocker.page.test');
    }
}
