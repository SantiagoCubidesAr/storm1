<?php

// namespace App\Http\Controllers;

// use App\Models\User;
// use Illuminate\Http\Request;

// class UserController extends Controller
// {
//     public function index()
//     {
//         $users = User::all();
//         return view('dashboard')->with('users', $users);
//     }

//     // public function show(User $user)
//     // {
//     //     return view('students.show')->with('user', $user);
//     // }
//     public function show($id)
//     {
//         $user = User::findOrFail($id);
//         return view('administrators.show')->with('user', $user);
//     }

//     // public function edit(User $user)
//     // {
//     //     return view('students.edit')->with('user', $user);
//     // }
//     public function edit($id)
//     {
//         $user = User::findOrFail($id);
//         return view('administrators.edit')->with('user', $user);
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, User $user)
//     {
//         if ($request->hasFile('photo')) {
//             if($request->hasFile('photo')) {
//                 $photo =time() . '.'.$request->photo->extension();
//                 $request->photo->move(public_path('images'), $photo);
//             }
//         } else {
//             $photo = $request->originphoto;
//         }

//             $user->status = $request->status;
//             $user->fullname = $request->fullname;
//             $user->gender = $request->gender;
//             $user->address = $request->address;
//             $user->photo = $photo;
//             $user->phone = $request->phone;
//             $user->email = $request->email;

//         if ($user->save()) {
//             return redirect('administrators')->with('message', 'The user: '. $user->fullname. 'was successfully updated!');
//         }
//     }
// }

?>
