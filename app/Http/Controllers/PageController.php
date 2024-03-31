<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\FlareClient\View;

class PageController extends Controller
{
    function main (){
        return view('main');
    }

    function about ()
    {
        return view('about');
    }

    function services ()
    {
        return view('services');
    }

    function projects ()
    {
        return view('project');
    }

    function contacts () 
    {
        return view('contacts');
    }
}
