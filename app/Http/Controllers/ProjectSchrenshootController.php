<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProjectSchrenshoot;
use Illuminate\Support\Facades\DB;

class ProjectSchrenshootController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        // dd($project); 
        return view('admin.project_schrenshoot.create', compact('project'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Project $project)
    {
        $validated = $request->validate([
            'schrenshoot' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
          
        ]);
    
        DB::beginTransaction();
        try {
            // Memastikan nama file untuk cover_image
            if ($request->hasFile('schrenshoot')) {
                $path = $request->file('schrenshoot')->store('project_schrenshoot', 'public');
                $validated['schrenshoot'] = $path;
                // Menyimpan path ke validated
            }
            $validated['project_id'] = $project->id;
            // Simpan data ke dalam database
            $newScrenshoot = ProjectSchrenshoot::create($validated);
            
            DB::commit();
            return redirect()->back()->with('success', 'Project screnshoot added successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'System error: ' . $e->getMessage()) ;
    }
}

    /**
     * Display the specified resource.
     */
    public function show(ProjectSchrenshoot $projectSchrenshoot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectSchrenshoot $projectSchrenshoot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectSchrenshoot $projectSchrenshoot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectSchrenshoot $projectSchrenshoot)
    {
          $projectSchrenshoot->delete();
        return redirect()->route('admin.tools.index')->with('success', 'tool berhasil dihapus');
    }
}
