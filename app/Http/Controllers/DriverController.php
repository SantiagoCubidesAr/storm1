<?php

namespace App\Http\Controllers;

use App\Http\Requests\DriverRequest;
use App\Models\Driver;
use App\Models\Gender;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = User::whereHas('roles', function ($query) {
            $query->where('name', 'Conductor');
        })->get();
        return view('drivers.index')->with('drivers', $drivers);
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
        return view('drivers.create')->with('roles', $roles)->with('genders', $genders)->with('status', $status);
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

        $driver = new User;
        $driver->fullname = $request->fullname;
        $driver->id_status = $request->id_status;
        $driver->id_gender = $request->id_gender;
        $driver->address = $request->address;
        $driver->photo = $photo;
        $driver->phone = $request->phone;
        $driver->email = $request->email;
        $driver->password = bcrypt($request->password);

        if ($driver->save()) {
            $role = Role::find($request->role_id);
            $driver->roles()->attach($role->id);
            $driver_id = new Driver();
            $driver_id->user_id = $driver->id;
            $driver_id->save();
            return redirect('drivers')->with('message', 'The user: ' . $driver->fullname . 'was successfully added');
        }

    }

    public function show($id)
    {
        $driver = User::findOrFail($id);
        return view('drivers.show')->with('driver', $driver);
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
        $driver = User::findOrFail($id);
        return view('drives.edit')->with('driver', $driver)->with('roles', $roles)->with('genders', $genders)->with('status', $status);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DriverRequest $request, $id)
    {
        $driver = User::findOrFail($id);
        if ($request->hasFile('photo')) {
            if ($request->hasFile('photo')) {
                $photo = time() . '.' . $request->photo->extension();
                $request->photo->move(public_path('images'), $photo);
            }
        } else {
            $photo = $request->originphoto;
        }

        $driver->update([
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
        return redirect('drivers')->with('message', 'The user: ' . $driver->fullname . 'was successfully updated!');
    }

    public function destroy($id)
    {
        $driver = User::findOrFail($id);
        if($driver->delete()) {
            return redirect('drivers')->with('message', 'The user:'. $driver->fullname . 'was successfully deleted!');
        }
    }

    public function search(Request $request){
        $drivers = User::names($request->q)->paginate(20);
        return view('drivers.search')->with('drivers', $drivers);
    }
}
