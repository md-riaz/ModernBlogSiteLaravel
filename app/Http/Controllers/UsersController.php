<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('users.all', compact('users'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        echo "show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('users.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(User $user)
    {
        if (Hash::check(request()->password, $user->password)) {
            $user->update(\request()->validate([
                'name' => 'required',
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id]
            ]));

            $notification = [
                'message' => 'Changes saved',
                'alert-type' => 'success'
            ];
            return redirect()->route('users.index')->with($notification);
        }
        $notification = [
            'message' => 'Password does not match from database',
            'alert-type' => 'error'
        ];
      return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        echo "You cannot delete a user right now";
    }

    public function passChange(User $user)
    {  if (request()->current_password == request()->password){
        $notification = [
            'message' => 'New password can not be your old password',
            'alert-type' => 'error'
        ];
        return back()->with($notification);
    }
        if (Hash::check(request()->current_password, $user->password)) {
         request()->validate([
             'password' => 'required|confirmed|min:6'
         ]);
        }
    }
}