<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }
    public function index()
    {
    	$users = User::get();
    	return view('user.index', compact('users'));
    }
    public function edit($id)
    {
    	$user = User::find($id);
        //$roleList = ['super_admin' => 'Super Admin', 'ticket_admin' => 'Ticket Admin', 'user' => 'User'];
        $roleList = ['admin' => 'Admin', 'supervisor' => 'Supervisor', 'user' => 'User'];
    	$activeList = [1 => 'Yes', 0 => 'No'];
    	return view('user.edit', compact('user', 'roleList', 'activeList'));
    }
    public function update(Request $request, $id)
    {
    	$user = User::find($id);
        if ($user->id == 1) {
            flash()->error('No permission to update');
            return redirect('user');
        } else {
            $user->name = $request->name;
            $user->role = $request->role;
            $user->active = $request->active;
            $user->phone_number = $request->phone_number;
            $user->address = $request->address;
            $user->updated_by = Auth::id();
            $user->save();
            flash()->success('Successfully Updated');
            return redirect('user');
        }
    }
}
