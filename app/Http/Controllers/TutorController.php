<?php

namespace App\Http\Controllers;

use App\Http\Requests\TutorRequest;
use App\Models\Gender;
use App\Models\Role;
use App\Models\Status;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Http\Request;

class TutorController extends Controller
{
    public function index()
    {
        $tutors = User::whereHas('roles', function ($query) {
            $query->where('name', 'Tutor');
        })->get();
        return view('tutors.index')->with('tutors', $tutors);
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
        return view('tutors.create')->with('roles', $roles)->with('genders', $genders)->with('status', $status);
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

        $tutor = new User;
        $tutor->fullname = $request->fullname;
        $tutor->id_status = $request->id_status;
        $tutor->id_gender = $request->id_gender;
        $tutor->address = $request->address;
        $tutor->photo = $photo;
        $tutor->phone = $request->phone;
        $tutor->email = $request->email;
        $tutor->password = bcrypt($request->password);

        if ($tutor->save()) {
            $role = Role::find($request->role_id);
            $tutor->roles()->attach($role->id);
            $tutor_id = new Tutor();
            $tutor_id->user_id = $tutor->id;
            $tutor_id->save();
            return redirect('tutors')->with('message', 'The user: ' . $tutor->fullname . 'was successfully added');
        }
    }

    public function show($id)
    {
        $tutor = User::findOrFail($id);
        return view('tutors.show')->with('tutor', $tutor);
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
        $tutor = User::findOrFail($id);
        return view('tutors.edit')->with('user', $tutor)->with('roles', $roles)->with('genders', $genders)->with('status', $status);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TutorRequest $request, $id)
    {
        $tutor = User::findOrFail($id);
        if ($request->hasFile('photo')) {
            if ($request->hasFile('photo')) {
                $photo = time() . '.' . $request->photo->extension();
                $request->photo->move(public_path('images'), $photo);
            }
        } else {
            $photo = $request->originphoto;
        }

        $tutor->update([
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
        return redirect('tutors')->with('message', 'The user: ' . $tutor->fullname . 'was successfully updated!');
    }

    public function destroy($id)
    {
        $tutor = User::findOrFail($id);
        if ($tutor->delete()) {
            return redirect('tutors')->with('message', 'The user:' . $tutor->fullname . 'was successfully deleted!');
        }
    }

    public function search(Request $request)
    {
        $query = $request->q;
        $tutors = User::query()->tutor()->names($request->q)->paginate(20);


        return view('tutors.search', compact('tutors'));
    }
}
