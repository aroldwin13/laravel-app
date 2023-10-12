<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\FacultyController;
use Auth;


class FacultyController extends Controller
{
    public function faculty_Home()
    {
        // kastuy pinagala jay role
        $role = Auth::user()->role;
        if($role == 2){
            return Inertia::render('Faculty/Faculty');
         
        } 
    }
    public function faculty_Bookmark()
    {
        return Inertia::render('Faculty/Bookmark');    
    }
    public function faculty_References()
    {
        return Inertia::render('Faculty/References');    
    }
 

}