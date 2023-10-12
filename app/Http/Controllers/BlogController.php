<?php

namespace App\Http\Controllers;

use Auth;
use Inertia\Inertia;
use App\Models\Submission;
use Illuminate\Http\Request;

use App\Http\Controllers\BlogController;


class BlogController extends Controller
{
      public function show()
    {
        return Inertia::render('Submission');    
    }
 
    public function home()
    {
        // kastuy pinagala jay role
        $role = Auth::user()->role;
        if($role == 0){
            return Inertia::render('Admin');
        } else if($role == 1){
            return Inertia::render('Student');
        }  else if($role == 2){
            return Inertia::render('Faculty');
        }  
    }

    public function bookmark()
    {
        return Inertia::render('Bookmark');    
    }
    
    public function references()
    {
        return Inertia::render('References');    
    }
    
    public function library()
    {
        return Inertia::render('Library');
    }
   

    public function submission()
    {   
        $submissions = Submission::all();

        return Inertia::render('Submission', [
            'submissions' => $submissions
        ]);
    }

    public function create()
    {
        return Inertia::render('Create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
     
        Submission::create($validatedData);

        return redirect()->route('submission')->with('success', 'Submission created successfully!');
    }


    public function edit(Submission $submission)
    {
        return Inertia::render('Edit', [
            'submission' => $submission
        ]);
    }


    public function update(Request $request, Submission $submission)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $submission->update($request->only(['title', 'content']));

        return redirect()->route('submission')->with('message', 'Submission Updated Successfully');
    }

 
    public function destroy(Submission $submission)
    {
        $submission->delete();

        return redirect()->route('submission')->with('message', 'Submission Delete Successfully');
    }
}
