<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use App\Models\ProjectOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index() {
        $projects = Project::orderBy('id','desc')->take(6)->get(); 
        $testimonial = Testimonial::orderBy('id','desc')->get(); 
        return view('front.index',compact('projects','testimonial'));
    }

    public function details(Project $project) {
        return view('front.details',compact('project'));
    }

    public function book() {
        return view('front.book');
    }

    public function services() {
        return view('front.services');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
              'email' => 'required|string|max:255',
            'budget' => 'required|integer',
            'category' => 'required|string',
            'brief' => 'required|string|max:6600',
        ]);
    
        DB::beginTransaction();
        try {
            // Simpan data ke dalam database
            $newProject = ProjectOrder::create($validated);
            
            DB::commit();
            return redirect()->route('front.index')->with('success', 'Project created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'System error: ' . $e->getMessage());
        }
    }

    public function testimonial () {
        $testimonial = Testimonial::orderBy('id','desc')->get(); 
        return view('front.index',compact('testimonial'));
    }
}
