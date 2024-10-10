<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdministratorRequest;
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
        return view('administrators.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdministratorRequest $request)
    {
        //dd($request->all());

        if ($request->hasFile('photo')) {
            $photo = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images'), $photo);
        }

        $user = new User;
        $user = new User;
        $user->document = $request->document;
        $user->fullname = $request->fullname;
        $user->gender = $request->gender;
        $user->birthdate = $request->birthdate;
        $user->photo = $photo;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        if ($user->save()) {
            return redirect('users')->with('message', 'The user: ' . $user->fullname . 'was successfully added');
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
    public function update(Request $request, User $user)
    {
        if ($request->hasFile('photo')) {
            if ($request->hasFile('photo')) {
                $photo = time() . '.' . $request->photo->extension();
                $request->photo->move(public_path('images'), $photo);
            }
        } else {
            $photo = $request->originphoto;
        }

        $user->status = $request->status;
        $user->fullname = $request->fullname;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->photo = $photo;
        $user->phone = $request->phone;
        $user->email = $request->email;

        if ($user->save()) {
            return redirect('administrators')->with('message', 'The user: ' . $user->fullname . 'was successfully updated!');
        }
    }
}
