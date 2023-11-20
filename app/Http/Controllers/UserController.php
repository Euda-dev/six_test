<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function list_users()
    {
        $users = User::all();


        return view('user.list_users', compact('users'));
    }

    public function filter_users(Request $request)
    {
        $validatedData = $request->validate([
            'status_filter' => 'required'
        ]);

        if ($validatedData['status_filter'] === "active") {
            $users = User::where('status', 'active')->get();
        } elseif ($validatedData['status_filter'] === "inactive") {
            $users = User::where('status', 'inactive')->get();
        } else {
            $users = User::all();
        }

        return view('user.list_users', compact('users'));
    }


    public function add_users_get()
    {

        return view('user.add_users');
    }

    public function add_users_post(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        // Criar o produto
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);


        return Redirect::route('list_users');
    }

    public function edit_users_get($id)
    {

        $user = User::find($id);

        return view('user.edit_users', compact('user'));
    }

    public function edit_users_post(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
        ]);

        $user = User::find($id);

        if ($user) {
            $dataToUpdate = [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
            ];

            if (!empty($validatedData['password'])) {
                $dataToUpdate['password'] = Hash::make($validatedData['password']);
            }

            $user->update($dataToUpdate);
        }

        return Redirect::route('list_users');
    }

    public function disabled_user($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->update([
                'status' => 'inactive',
            ]);
        }

        return Redirect::route('list_users');
    }

    public function active_user($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->update([
                'status' => 'active',
            ]);
        }

        return Redirect::route('list_users');
    }
}
