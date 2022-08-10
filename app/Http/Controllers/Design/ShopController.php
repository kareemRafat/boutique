<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index()
    {
        return view('design.welcome');
    }

    public function shop()
    {
        return view('design.shop');
    }

    public function show($id)
    {
        return view('design.detail');
    }
}
