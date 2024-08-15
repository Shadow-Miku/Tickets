<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AllUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $currentUserId = auth()->user()->id; // Authenticated User ID
        $division = \App\Models\Division::all();
        return view('users.index', compact('users','currentUserId','division'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $division = \App\Models\Division::all(); // Obtén todas las divisiones
        return view('users.create', compact('division'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
            'type' => 'required|integer',
            'url' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'divisionid' => 'required|integer'
        ]);

        $imagePath = null;
        if ($request->hasFile('url')) {
            $imagePath = $request->file('url')->store('users', 'public');
        }

        \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type,
            'url' => $imagePath,
            'divisionid' => $request->divisionid
        ]);

        return redirect()->route('admin/users')->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $divisions = \App\Models\Division::all();

        return view('users.edit', compact('user','divisions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|confirmed',
            'type' => 'required|integer',
            'url' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'divisionid' => 'required|integer'
        ]);

        //User data update
        $user->name = $request->name;
        $user->email = $request->email;

        // Update the password if it's changed
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Update user type and division
        $user->type = $request->type;
        $user->divisionid = $request->divisionid;

        // User image handling
        if ($request->hasFile('url')) {
            // Delete current image
            if ($user->url) {
                \Storage::disk('public')->delete($user->url);
            }

            // Store the new image
            $imagePath = $request->file('url')->store('users', 'public');
            $user->url = $imagePath;
        }

        // Save changes
        $user->save();

        return redirect()->route('admin/users')->with('success', 'User updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin/users')->with('success', 'User deleted successfully.');
    }
}

