<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Gender;
use App\Models\Role;
use App\Models\Status;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::whereHas('roles', function ($query) {
            $query->where('name', 'Estudiante');
        })->get();
        return view('students.index')->with('students', $students);
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
        return view('students.create')->with('roles', $roles)->with('genders', $genders)->with('status', $status);
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

        $student = new User;
        $student->fullname = $request->fullname;
        $student->id_status = $request->id_status;
        $student->id_gender = $request->id_gender;
        $student->address = $request->address;
        $student->photo = $photo;
        $student->phone = $request->phone;
        $student->email = $request->email;
        $student->password = bcrypt($request->password);

        if ($student->save()) {
            $role = Role::find($request->role_id);
            $student->roles()->attach($role->id);
            $student_id = new Student();
            $student_id->user_id = $student->id;
            $student_id->save();
            return redirect('students')->with('message', 'The user: ' . $student->fullname . 'was successfully added');
        }

    }

    public function show($id)
    {
        $student = User::findOrFail($id);
        return view('students.show')->with('student', $student);
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
        $student = User::findOrFail($id);
        return view('students.edit')->with('student', $student)->with('roles', $roles)->with('genders', $genders)->with('status', $status);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, $id)
    {
        $student = User::findOrFail($id);
        if ($request->hasFile('photo')) {
            if ($request->hasFile('photo')) {
                $photo = time() . '.' . $request->photo->extension();
                $request->photo->move(public_path('images'), $photo);
            }
        } else {
            $photo = $request->originphoto;
        }

        $student->update([
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
        return redirect('students')->with('message', 'The user: ' . $student->fullname . 'was successfully updated!');
    }

    public function destroy($id)
    {
        $student = User::findOrFail($id);
        if($student->delete()) {
            return redirect('students')->with('message', 'The user:'. $student->fullname . 'was successfully deleted!');
        }
    }

    public function search(Request $request){
        $students = User::names($request->q)->paginate(20);
        return view('students.search')->with('students', $students);
    }
}
