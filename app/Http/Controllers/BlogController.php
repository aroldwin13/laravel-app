<?php

namespace App\Http\Controllers;

use Auth;
use Inertia\Inertia;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;



class BlogController extends Controller
{
    public function show()
    {
        return Inertia::render('Submission');
    }
    public function editor()
    {
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

    public function home()
    {
        // kastuy pinagala jay role

        $role = Auth::user()->role;
        if ($role == '1') {
            return Inertia::render('Home', [
                'role' => $role
            ]);
        } else if ($role == '2') {
            return Inertia::render('Home', [
                'role' => $role
            ]);
        } else if ($role == '4') {
            return Inertia::render('Home', [
                'role' => $role
            ]);
        } else if ($role == '5') {
            return Inertia::render('Home', [
                'role' => $role
            ]);
        } else if ($role == '3') {
            return Inertia::render('Home', [
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
    public function user()
    {
        $submissions = Submission::all();

        return Inertia::render('Submission', ['submissions' => $submissions]);
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

        $thesis = Submission::create($validatedData)->id();

        return $thesis;

        return redirect()->route('Submission')->with('success', 'Submission created successfully!');
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
        return redirect()->route('submission')->with('message', 'Submission Deleted Successfully');
    }


    public function updateUser(Request $request, $id)
    {

        // Find the user by ID
        $user = User::findOrFail($id);
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);

        // Update the user with the validated data
        $user->update();

        // Optionally, you can return a response indicating success or failure
        return response()->json(['success' => true]);
    }
    
    public function deleteUser($id)
    {
        $user = User::find($id);
        
        $user->delete();
        return redirect()->route('account')->with('message', 'User deleted successfully');
    }

    public function account(){
        $users = User::all();
        return Inertia::render('Account',['users' => $users]);
    }

    public function deactivateAcc($id)
    {
        $user = User::find($id);
        $user->status = 0;
        $user->save();
        return $user;
    }
    public function activateAcc($id)
    {
        $user = User::find($id);
        $user->status = 1;
        $user->save();
        return $user;
    }

}
