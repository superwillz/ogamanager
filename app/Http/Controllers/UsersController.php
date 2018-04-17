<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::orderBy('id', 'ASC')->get();

        return view('users.all', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $created_user = User::create(['name' => $request->name, 'email' => $request->email, 'password' => bcrypt($request->password), 'type' => $request->type]);

        if($created_user) {
            $request->session()->flash('success', 'New User has been added successfully');
            return redirect()->route('add_user');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user) {
            $deleted = User::destroy($user->id);
            if($deleted) {
                request()->session()->flash('success', 'You deleted <strong>' . $user->name . '\'s</strong> account');
            } else {
                request()->session()->flash('error', 'Failed to delete <strong>' . $user->name . '\'s</strong> account');
            }
        } else {
            request()->session()->flash('error', 'Couldn\'t delete user\'s account');
        }

        return redirect()->route('view_users');
    }

    public function switchUserRole($id, $role) {
        $user = User::find($id);
        if($user) {
            $switched = User::where('id', $user->id)->update(['type' => $role]);
            if($switched) {
                request()->session()->flash('success', 'You changed <strong>' . $user->name . '\'s</strong> role to <strong>' . $role . '</strong>');
            } else {
                request()->session()->flash('error', 'Failed to change <strong>' . $user->name . '\'s</strong> role to <strong>' . $role . '</strong>');
            }
        } else {
            request()->session()->flash('error', 'Couldn\'t change user\'s role to ' . $role);
        }

        return redirect()->route('view_users');

    }

    public function editUser($id) {
        $user = User::find($id);

        return view('users.add', compact('user'));
    }

    public function storeEditUser($id, Request $request) {
        $edited_user = User::where('id', $id)->update(['name' => $request->name, 'email' => $request->email]);
        if($edited_user) {
            request()->session()->flash('success', 'You edited <strong>' . $request->name . '\'s</strong> details successfully');
        } else {
            request()->session()->flash('error', 'Couldn\'t edit <strong>' . $request->name . '\'s</strong> details');
        }

        return redirect()->route('view_users');
    }
}
