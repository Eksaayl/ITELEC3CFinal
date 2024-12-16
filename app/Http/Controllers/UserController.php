<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // protected $users = [
    //     [
    //         "id" => 1,
    //         "name" => "Alice Johnson",
    //         "age" => 28,
    //         "title" => "The Art of Software Engineering",
    //         "description" => "A comprehensive guide to modern software engineering practices.",
    //         "date_published" => "2020-05-15"
    //     ],
    //     // Add other users here...
    // ];

    // Fetch all users from session or default array
    public function index()
    {
        // $users = session()->get('users', $this->users);
        $users = User::all();
        return view('manage-post', compact('users'));
    }

    // Show the form to create a new user
    public function create()
    {
        return view('users-create');
    }

    // // Store the new user in the session
    // public function store(Request $request)
    // {
    //     // $users = session()->get('users', $this->users);
    //     $users = User::all();
    //     $newUser = [
    //         'id' => count($users) + 1,
    //         'name' => $request->input('name'),
    //         'age' => $request->input('age'),
    //         'title' => $request->input('title'),
    //         'description' => $request->input('description'),
    //         'date_published' => $request->input('date_published'),
    //     ];
        
    //     array_push($users, $newUser);
    //     session()->put('users', $users);

    //     return redirect()->route('dashboard')->with('success', 'User created successfully!');
    // }

    // Show the form to edit an existing user
    public function edit($id)
    {
        // $users = session()->get('users', $this->users);
        $users = User::all();
        $user = collect($users)->firstWhere('id', $id);

        if (!$user) {
            abort(404, 'User not found');
        }

        return view('users-edit', ['user' => $user]);
    }

    // Update an existing user
    public function update(Request $request, $id)
    {
        // $users = session()->get('users', $this->users);
        $users = User::all();
        $userIndex = collect($users)->search(function ($user) use ($id) {
            return $user['id'] == $id;
        });

        if ($userIndex === false) {
            abort(404, 'User not found');
        }

        $users[$userIndex] = [
            'id' => $id,
            'name' => $request->input('name'),
            'age' => $request->input('age'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'date_published' => $request->input('date_published')
        ];

        session()->put('users', $users);

        return redirect()->route('dashboard')->with('success', 'User updated successfully!');
    }

    // Show a specific user
    public function show($id)
    {
        // $users = session()->get('users', $this->users);
        $users = User::all();
        $user = collect($users)->firstWhere('id', $id);

        if (!$user) {
            abort(404, 'User not found');
        }

        return view('users-show', ['user' => $user]);
    }
}
