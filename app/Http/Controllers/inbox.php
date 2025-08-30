<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class inbox extends Controller
{
      public function index() {
        return view('inbox');
    }
    public function mail() {
        return view('mail');
    }
}
