<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdministratorRequest;
use App\Models\Gender;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return view('dashboard')->with('users', $users);
    }

    // public function show(User $user)
    // {
    //     return view('students.show')->with('user', $user);
    // }

    public function create()
    {
        $roles = Role::all();
        $genders = Gender::all();
        return view('administrators.create')->with('roles', $roles)->with('genders', $genders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $role = Role::find($request->name);

        if ($request->hasFile('photo')) {
            $photo = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images'), $photo);
        }

        $user = new User;
        $user->fullname = $request->fullname;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->photo = $photo;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->roles()->attach($role);
        $user->password = bcrypt($request->password);

        if ($user->save()) {
            return redirect('administrators')->with('message', 'The user: ' . $user->fullname . 'was successfully added');
        }
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('administrators.show')->with('user', $user);
    }

    // public function edit(User $user)
    // {
    //     return view('students.edit')->with('user', $user);
    // }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('administrators.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdministratorRequest $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->hasFile('photo')) {
            if ($request->hasFile('photo')) {
                $photo = time() . '.' . $request->photo->extension();
                $request->photo->move(public_path('images'), $photo);
            }
        } else {
            $photo = $request->originphoto;
        }

        $user->update([
            'status' => $request->status,
            'fullname' => $request->fullname,
            'gender' => $request->gender,
            'address' => $request->address,
            'photo' => $photo,
            'phone' => $request->phone,
            'email' => $request->email
        ]);
        // $user->status = $request->status;
        // $user->fullname = $request->fullname;
        // $user->gender = $request->gender;
        // $user->address = $request->address;
        // $user->photo = $photo;
        // $user->phone = $request->phone;
        // $user->email = $request->email;
        // $user->password = $user->password;

        // if ($user->save()) {
        //     return redirect('dashboard')->with('message', 'The user: ' . $user->fullname . 'was successfully updated!');
        // }
        return redirect('dashboard')->with('message', 'The user: ' . $user->fullname . 'was successfully updated!');

    }
}
