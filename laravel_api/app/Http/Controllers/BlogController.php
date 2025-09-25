<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('blog.index', [
          'blogs' => Blog::latest()->paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'banner_image' => 'required|image'
        ]);

        $formFields['user_id'] = auth()->guard()->id();

        if ($request->hasFile('banner_image')) {
            $formFields['banner_image'] = $request->file('banner_image')->store('blogs', 'public');
        }

        Blog::create($formFields);

        return to_route('blog.index')
            ->with('success', 'Blog post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view("blog.show", [
            "blog" => $blog
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view("blog.edit", [
            "blog" => $blog
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $data = $request->validate([
            "title" => "required|string",
            "description" => "required|string"
        ]);

        if($request->hasFile("banner_image")){
            if($blog->banner_image){
                Storage::disk("public")->delete($blog->banner_image);
            }

            $data["banner_image"] = $request->file("banner_image")->store("blogs", "public");
        }

        $blog->update($data);

        return to_route("blog.show", $blog)->with("success", "Blog updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if($blog->banner_image){
            Storage::disk("public")->delete($blog->banner_image);
        }

        $blog->delete();

        return to_route("blog.index")->with("success", "Blog Deleted Successfully");
    }
}
