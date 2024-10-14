<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonial= Testimonial::orderBy('id','desc')->get(); 
       return view('admin.testimonial.index',compact('testimonial'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'testimonial' => 'required|string',
            'rate' => 'required|integer|between:1,5',
        ]);
    
        DB::transaction(function () use ($request, $validated) {
            if ($request->hasFile('logo')) {
                $avatarPath = $request->file('logo')->store('testimonial', 'public');
                $validated['logo'] = $avatarPath;
            }
    
            Testimonial::create($validated);
        });
    
        return redirect()->route('admin.testimonial.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonial.edit',compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'role' => 'required|string|max:255',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Set nullable karena tidak selalu diperbarui
        'testimonial' => 'required|string',
        'rate' => 'required|integer|between:1,5',
    ]);

    DB::transaction(function () use ($request, $validated, $testimonial) { // Pass $testimonial to closure
        if ($request->hasFile('logo')) {
            $avatarPath = $request->file('logo')->store('testimonial', 'public');
            $validated['logo'] = $avatarPath;
        }

        $testimonial->update($validated); // Update testimonial record
    });

    return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial updated successfully');
}

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonial.index')->with('success', 'project berhasil dihapus');
    }
}
