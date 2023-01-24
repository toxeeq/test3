<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;

class HomeController extends Controller
{

    public function home()
    {

        return view('home.index', ['new' => BlogPost::all()]);
    }
}
