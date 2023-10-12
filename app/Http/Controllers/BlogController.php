<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\BlogController;
use Auth;


class BlogController extends Controller
{
    public function show()
    {
        return Inertia::render('Blog');    
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
    public function library(){
        return Inertia::render('Library');
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function blog()
    {   
        $blogs = Blog::all();

        return Inertia::render('Blog', [
            'blogs' => $blogs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Create a new blog entry
        Blog::create($validatedData);

        return redirect()->route('blog')->with('success', 'Blog created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return Inertia::render('Edit', [
            'blog' => $blog
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $blog->update($request->only(['title', 'content']));

        return redirect()->route('blog')->with('message', 'Blog Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('blog')->with('message', 'Blog Delete Successfully');
    }
}