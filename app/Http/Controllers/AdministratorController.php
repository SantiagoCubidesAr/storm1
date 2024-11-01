<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdministratorRequest;
use App\Models\Administrator;
use App\Models\Gender;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    //
    public function index()
    {
        $administrators = Administrator::with('user')->get();
        return view('dashboard')->with('administrators', $administrators);
    }

    // public function show(User $user)
    // {
    //     return view('students.show')->with('user', $user);
    // }

    public function create()
    {
        $roles = Role::all();
        $status = Status::all();
        $genders = Gender::all();
        return view('administrators.create')->with('roles', $roles)->with('genders', $genders)->with('status', $status);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());

        if ($request->hasFile('photo')) {
            $photo = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images'), $photo);
        }

        $administrator = new User;
        $administrator->fullname = $request->fullname;
        $administrator->id_status = $request->id_status;
        $administrator->id_gender = $request->id_gender;
        $administrator->address = $request->address;
        $administrator->photo = $photo;
        $administrator->phone = $request->phone;
        $administrator->email = $request->email;
        $administrator->password = bcrypt($request->password);

        if ($administrator->save()) {
            $role = Role::find($request->role_id);
            $administrator->roles()->attach($role->id);
            $administrator_id = new Administrator();
            $administrator_id->user_id = $administrator->id;
            $administrator_id->save();
            return redirect('administrators')->with('message', 'The user: ' . $administrator->fullname . 'was successfully added');
        }
    }

    public function show($id)
    {
        $administrator = Administrator::findOrFail($id);
        return view('administrators.show')->with('administrator', $administrator);
    }

    // public function edit(User $user)
    // {
    //     return view('students.edit')->with('user', $user);
    // }
    public function edit($id)
    {
        $roles = Role::all();
        $status = Status::all();
        $genders = Gender::all();
        $administrator = Administrator::findOrFail($id);
        return view('administrators.edit')->with('administrator', $administrator)->with('roles', $roles)->with('genders', $genders)->with('status', $status);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdministratorRequest $request, $id)
    {
        $administrator = Administrator::findOrFail($id);
        if ($request->hasFile('photo')) {
            if ($request->hasFile('photo')) {
                $photo = time() . '.' . $request->photo->extension();
                $request->photo->move(public_path('images'), $photo);
            }
        } else {
            $photo = $request->originphoto;
        }

        $administrator->user->update([
            'fullname' => $request->fullname,
            'id_status' => $request->id_status,
            'id_gender' => $request->id_gender,
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
        return redirect('dashboard')->with('message', 'The user: ' . $administrator->fullname . 'was successfully updated!');
    }

    public function destroy($id)
    {
        $administrator = User::findOrFail($id);
        if ($administrator->delete()) {
            return redirect('dashboard')->with('message', 'The user:' . $administrator->fullname . 'was successfully deleted!');
        }
    }

    public function search(Request $request)
    {
        $administrator = User::names($request->q)->paginate(20);
        return view('administrators.search')->with('administrators', $administrator);
    }
}
