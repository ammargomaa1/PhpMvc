<?php
namespace App\Controllers;

use Illuminate\View\View;

class HomeController
{
    public  function index()
    {
        return view('home',['username'=>'Ammar', 'age'=>24]);
    }
}