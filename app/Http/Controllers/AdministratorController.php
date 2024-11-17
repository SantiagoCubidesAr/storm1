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
        $administrators = User::whereHas('roles', function ($query) {
            $query->where('name', 'Administrador');
        })->get();
    
        return view('dashboard', compact('administrators'));
    }

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
        $user = User::with('administrator', 'roles', 'status', 'genders')->findOrFail($id);
        return view('administrators.show')->with('administrator', $user->administrator);
    }

    public function edit($id)
    {
        $roles = Role::all();
        $status = Status::all();
        $genders = Gender::all();
        $user = User::findOrFail($id);
        return view('administrators.edit')->with('administrator', $user->administrator)->with('roles', $roles)->with('genders', $genders)->with('status', $status);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdministratorRequest $request, $id)
    {
        $administrator = User::findOrFail($id);
        if ($request->hasFile('photo')) {
            if ($request->hasFile('photo')) {
                $photo = time() . '.' . $request->photo->extension();
                $request->photo->move(public_path('images'), $photo);
            }
        } else {
            $photo = $request->originphoto;
        }

        $administrator->update([
            'fullname' => $request->fullname,
            'id_status' => $request->id_status,
            'id_gender' => $request->id_gender,
            'address' => $request->address,
            'photo' => $photo,
            'phone' => $request->phone,
            'email' => $request->email
        ]);
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
