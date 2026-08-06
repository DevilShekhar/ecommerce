<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogFaq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('admin.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'title'             => 'required|string|max:255',
            'description'       => 'required',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'meta_title'        => 'nullable|string|max:255',
            'meta_keyword'      => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string',
            'question.*'        => 'nullable|string',
            'answer.*'          => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            $blog = new Blog();
            $blog->name = $request->name;
            $blog->title = $request->title;
            $blog->slug = Str::slug($request->title);
            $blog->description = $request->description;
            $blog->meta_title = $request->meta_title;
            $blog->meta_keyword = $request->meta_keyword;
            $blog->meta_description = $request->meta_description;
            $blog->created_by = Auth::id();

            // Upload Image to Storage
            if ($request->hasFile('image')) {

                $path = $request->file('image')->store('blogs', 'public');

                $blog->image = $path;
            }

            $blog->save();

            // Save FAQs
            if ($request->filled('question')) {

                foreach ($request->question as $key => $question) {

                    if (!empty($question)) {

                        BlogFaq::create([
                            'blog_id'    => $blog->id,
                            'question'   => $question,
                            'answer'     => $request->answer[$key] ?? '',
                            'created_by' => Auth::id(),
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()
                ->route('blogs.index')
                ->with('success', 'Blog created successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        $blog->load(['faqs', 'creator']);

        return view('admin.blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $blog->load('faqs');

        return view('admin.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'title'             => 'required|string|max:255',
            'description'       => 'required',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'meta_title'        => 'nullable|string|max:255',
            'meta_keyword'      => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string',
            'question.*'        => 'nullable|string',
            'answer.*'          => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            $blog->name = $request->name;
            $blog->title = $request->title;
            $blog->slug = Str::slug($request->title);
            $blog->description = $request->description;
            $blog->meta_title = $request->meta_title;
            $blog->meta_keyword = $request->meta_keyword;
            $blog->meta_description = $request->meta_description;
            $blog->updated_by = Auth::id();

            // Upload New Image
            if ($request->hasFile('image')) {

                // Delete Old Image
                if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                    Storage::disk('public')->delete($blog->image);
                }

                // Store New Image
                $path = $request->file('image')->store('blogs', 'public');

                $blog->image = $path;
            }

            $blog->save();

            // Delete Old FAQs
            BlogFaq::query()->where('blog_id', $blog->id)->delete();

            // Save New FAQs
            if ($request->filled('question')) {

                foreach ($request->question as $key => $question) {

                    if (!empty($question)) {

                        BlogFaq::create([
                            'blog_id'    => $blog->id,
                            'question'   => $question,
                            'answer'     => $request->answer[$key] ?? '',
                            'created_by' => Auth::id(),
                            'updated_by' => Auth::id(),
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()
                ->route('blogs.index')
                ->with('success', 'Blog updated successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
{
    DB::beginTransaction();

    try {

        $blog->status = 1; // Deactive
        $blog->updated_by = Auth::id();
        $blog->save();

        DB::commit();

        return redirect()
            ->route('blogs.index')
            ->with('success', 'Blog deactivated successfully.');

    } catch (\Exception $e) {

        DB::rollBack();

        return back()->with('error', $e->getMessage());
    }
}
}
