<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CambiarPasswordRequest;
use App\User;
use Validator;
use Hash;
use Auth;

class UserController extends Controller
{
	/**
	 * Create new controller instance and defines middleware
	 */
	function __construct()
	{
		$this->middleware('auth');
		$this->middleware('role:admin', ['only' => [
			'register',
			'getUsers'
			]]);

	}
	/**
	 * Change user password form
	 * @return view
	 */
	public function changePassword()
	{
		return view('auth.passwords.change-password');
	}
	/**
	 * Change user password
	 * @param  Request new password
	 * @return void
	 */
	public function postChangePassword(CambiarPasswordRequest $request)
	{
		if(!Hash::check($request->input('old_password'), Auth::user()->password))
		{	
			return redirect('/change-password')->with('global-error', 'La contraseña actual es incorrecta');
		}
		$user = User::FindOrFail(Auth::user()->id);
		$user->password =bcrypt($request->input('new_password'));
		$user->save();
		return redirect('home')->with('global', 'La contraseña ha sido actualizada');
	}
	/**
	 * Add user form
	 * @return view
	 */
	public function register()
	{
		return view('auth.register');
	}

	public function getUsers()
	{
		$users = User::all();
		return view('users.users', compact('users'));
	}
}
