<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $tool = Tool::orderBy('id','desc')->get();
       return view('admin.tool.index',compact('tool'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tool = Tool::all(); // Ambil semua data tools
        return view('admin.tool.create', compact('tool')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tagline' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        DB::beginTransaction();
        try {
            // Memastikan nama file untuk cover_image
            if ($request->hasFile('logo')) {
                $path = $request->file('logo')->store('tool', 'public'); // Perbaiki 'publuc' menjadi 'public'
                $validated['logo'] = $path; // Menyimpan path ke validated
            }
            $validated['slug'] = Str::slug($request->name);
            // Simpan data ke dalam database
            $tool = Tool::create($validated);
            DB::commit();
            return redirect()->route('admin.tools.index')->with('success', 'tool created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'System error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tool $tool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tool $tool)
    {
        return view('admin.tool.edit', compact('tool'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tool $tool)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tagline' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        DB::beginTransaction();
        try {
            // Memastikan nama file untuk cover_image
            if ($request->hasFile('logo')) {
                $path = $request->file('logo')->store('tool', 'public'); 
                // dd($path);
                $validated['logo'] = $path; // Menyimpan path ke validated
            }
            $validated['slug'] = Str::slug($request->name);
            // Simpan data ke dalam database
            $tool->update($validated);
            DB::commit();
            return redirect()->route('admin.tools.index')->with('success', 'tool created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'System error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tool $tool)
    {
        $tool->delete();
        return redirect()->route('admin.tools.index')->with('success', 'tool berhasil dihapus');
    }
}
