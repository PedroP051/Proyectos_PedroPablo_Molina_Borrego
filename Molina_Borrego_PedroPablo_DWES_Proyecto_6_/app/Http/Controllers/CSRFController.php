<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CSRFController extends Controller
{
    public function index()
    {
        return csrf_token();
    }
}