<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(){
         return view('/main/login');
    }
    public function main(){
        return view('welcome');
    }

}