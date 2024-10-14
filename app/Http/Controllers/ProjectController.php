<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderBy('id','desc')->get(); 
        return view('admin.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|in:Web Development,App Development,Graphic Designer,Digital Marketing',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'about' => 'required|string|max:1000',
        ]);
    
        DB::beginTransaction();
        try {
            // Memastikan nama file untuk cover_image
            if ($request->hasFile('cover')) {
                $path = $request->file('cover')->store('project', 'public'); 
                $validated['cover'] = $path; // Menyimpan path ke validated
            }
            $validated['slug'] = Str::slug($request->name);
            // Simpan data ke dalam database
            $newProject = Project::create($validated);
            
            DB::commit();
            return redirect()->route('admin.project.index')->with('success', 'Project created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'System error: ' . $e->getMessage());
        }
}

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
       
        return view('admin.project.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'cover' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'about' => 'required|string|max:1000',
        ]);
    
        DB::beginTransaction();
        try {
            // Memastikan nama file untuk cover_image
            if ($request->hasFile('cover')) {
                $path = $request->file('cover')->store('project', 'public'); // Perbaiki 'publuc' menjadi 'public'
                $validated['cover'] = $path; // Menyimpan path ke validated
            }
    
            $validated['slug'] = Str::slug($request->name);
            // Simpan data ke dalam database
          $project->update($validated);
            
            DB::commit();
            return redirect()->route('admin.project.index')->with('success', 'Project created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'System error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.project.index')->with('success', 'project berhasil dihapus');
    }
}
