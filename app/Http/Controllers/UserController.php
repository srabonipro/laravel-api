<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = User::create($request->all());
        if ($user) {
            return response()->json('User Created Successfully!!');
        } else {
            return response()->json('Something Went Wrong!!');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $result = $user->update();

        if ($result) {
            return response()->json('User Updated Successfully!!');
        } else {
            return response()->json('Something Went Wrong!!');
        }
    }

    public function destroy($id)
    {
        $user = User::find($id)->delete();
        if ($user) {
            return response()->json('User Deleted Successfully!!');
        } else {
            return response()->json('Something Went Wrong!!');
        }
    }
}
