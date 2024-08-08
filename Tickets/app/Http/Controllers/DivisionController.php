<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $division = Division::orderBy('created_at', 'DESC')->get();

        return view('divisions.index', compact('division'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('divisions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Division::create($request->all());

        return redirect()->route('admin/divisions')->with('success', 'Division added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $division = Division::findOrFail($id);

        return view('divisions.show', compact('division'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $division = Division::findOrFail($id);

        return view('divisions.edit', compact('division'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $division = Division::findOrFail($id);

        $division->update($request->all());

        return redirect()->route('admin/divisions')->with('success', 'Division updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $division = Division::findOrFail($id);

        $division->delete();

        return redirect()->route('admin/divisions')->with('success', 'Division deleted successfully');
    }
}
