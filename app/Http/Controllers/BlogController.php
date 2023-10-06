<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\BlogController;

class BlogController extends Controller
{
    public function show()
    {
        return Inertia::render('Blog');    
    }
    public function home()
    {
        return Inertia::render('Home');    
    }
}
