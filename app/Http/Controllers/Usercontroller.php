<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class Usercontroller extends Controller
{
    public function index(){
        $users= User::all();
        return view('user.index',compact('users'));
    }
    public function create()
    {

        return view('User.create');
    }

    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request-> input('role');
        $user->password= $request->password;
        $user->save();
        return redirect()->route('user.index')->with('success', 'New item successfully added.');
    }

    public function edit(User $user)
    {
        return view('User.edit', compact('user'));
    }
    public function show(User $user){
        return view('User.detail',compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request-> input('role');
        $user->password= $request->password;
        $user->update();
        return redirect()->route('user.index')->with('success', 'User successfully updated.');

    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully');
    }
}
