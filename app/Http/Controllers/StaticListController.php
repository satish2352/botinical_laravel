<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticListController extends Controller
{
    public function index() {
        return view('list');
    }

    public function mango() {
        return view('mango');
    }

    public function banana() {
        return view('banana');
    }

    public function chickoo() {
        return view('chickoo');
    }

    public function apple() {
        return view('apple');
    }
}
