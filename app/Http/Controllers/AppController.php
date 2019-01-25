<?php

namespace App\Http\Controllers;

class AppController extends Controller
{
    protected $index = 'app.index';

    public function index() {
        return view($this->index);
    }
}
