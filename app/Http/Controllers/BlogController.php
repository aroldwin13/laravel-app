<?php

namespace App\Http\Controllers;

use Auth;
use Inertia\Inertia;
use App\Models\Submission;
use Illuminate\Http\Request;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BlogController;

>>>>>>> 05823a46 (friday finish Product)

class BlogController extends Controller
{
      public function show()
    {
        return Inertia::render('Submission');    
<<<<<<< HEAD
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
=======
>>>>>>> 05823a46 (friday finish Product)
    }
  
    
    
    public function bookmark()
    {
        return Inertia::render('Bookmark');    
    }
    
    public function references()
    {
        return Inertia::render('References');    
    }
    
<<<<<<< HEAD
    public function library()
    {
        return Inertia::render('Library');
    }
   
=======
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
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
>>>>>>> 05823a46 (friday finish Product)
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

<<<<<<< HEAD
     
        Submission::create($validatedData);

        return redirect()->route('submission')->with('success', 'Submission created successfully!');
    }

=======
        // Create a new blog entry
        Submission::create($validatedData);

        return redirect()->route('submission')->with('success', 'submission created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
>>>>>>> 05823a46 (friday finish Product)
    public function edit(Submission $submission)
    {
        return Inertia::render('Edit', [
            'submission' => $submission
        ]);
    }

<<<<<<< HEAD
=======
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
>>>>>>> 05823a46 (friday finish Product)
    public function update(Request $request, Submission $submission)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $submission->update($request->only(['title', 'content']));

<<<<<<< HEAD
        // Flash a success message for the next request
        Session::flash('message', 'Submission Updated Successfully');

        return redirect()->route('submission');
    }

//     public function destroy(Submission $submission)
//     {
//         Session::flash('message', 'Submission Deleted Successfully');

//         return redirect()->route('submission');
//     }
}
=======
        return redirect()->route('submission')->with('message', 'Submission Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Submission $submission)
    {
        $submission->delete();

        return redirect()->route('submission')->with('message', 'Submission Delete Successfully');
    }
}
>>>>>>> 05823a46 (friday finish Product)
