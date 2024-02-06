<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class Usercontroller extends Controller
{
    public function index(){
        $users= User::all();
        return view('user.index',compact('users'));
    }
    public function create()
    {

        return view('user.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'name'=>'required',
        'email' => 'required|unique:users,email,',
        'role' => 'required',
        'password'=>'required',
        ]);


        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request-> input('role');
        $user->password= Crypt::encrypt($request->password);
        $user->save();
        return redirect()->route('user.index')->with('success', 'New item successfully added.');
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }
    public function show(User $user){
        return view('user.detail',compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name'=>'required',
            'email' => 'required',
            'role' => 'required',
            'password'=>'required',
        ]);
        if ($request->has('is_admin')) {
            // If checkbox is checked, set the role to 'admin'
            $role = "0";
        } else {
            // If checkbox is not checked, set the role based on the selected role from the dropdown
            $role = $request->input('role');
        }

        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $role;
        $user->password= Crypt::encrypt($request->password);
        $user->save();
        return redirect()->route('user.index')->with('success', 'User successfully updated.');

    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('danger', 'User deleted successfully');
    }
}
