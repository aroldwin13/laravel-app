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
    public function editor(){
        return Inertia::render('Editor');
    }
    public function assessment()
    {
        return Inertia::render('Assessment');    
    }

    public function generate()
    {
        return Inertia::render('Generate');    
    }

    public function account()
    {
        return Inertia::render('Account');    
    }
 
    public function home()
    {
        // kastuy pinagala jay role
        
        $role = Auth::user()->role;
        if($role == 'admin'){
            return Inertia::render('Admin', [
                'role' => $role
            ]);
        } else if($role == 'student'){
            return Inertia::render('Student', [
                'role' => $role
            ]);
        }  else if($role == 'faculty'){
            return Inertia::render('Faculty', [
                'role' => $role
            ]);
        }   
            else if($role == 'librarian'){
                return Inertia::render('Librarian', [
                    'role' => $role
                ]);
        }   else if($role == 'coordinator'){
            return Inertia::render('Coordinator', [
                'role' => $role
            ]);
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
            'shortabs' => 'required|string',
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
            'shortabs' => 'required|string',
        ]);

        $submission->update($request->only(['title', 'shortabs']));

        return redirect()->route('submission')->with('message', 'Submission Updated Successfully');
    }

 
    public function destroy(Submission $submission)
    {
        $submission->delete();

        return redirect()->route('submission')->with('message', 'Submission Delete Successfully');
    }
}
