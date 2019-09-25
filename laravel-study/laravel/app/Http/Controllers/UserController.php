<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use Hash;
use Redirect;
use App\User;
use App\Http\Requests;

class UserController extends Controller
{
	protected $layout = 'layouts.main';

	// zhu ce ye
	public function getRegister()
	{
		return view('user.register');
	}

	// zhu ce
	public function postCreate(Request $request)
	{
		$validator = Validator::make($request->all(),[
			'username' => 'required|alpha|min:2',
			'email' => 'required|email|unique:user',
			'password' => 'required|alpha_num|between:6,12|confirmed',
			'password_confirmation' => 'required|alpha_num|between:6,12|',
		]);
		if($validator->passes())
		{
			$user = new User;
			$user->username = $request->username;
			$user->email = $request->email;
			$user->password = Hash::make($request->password);
			$user->save();
			return Redirect::to('user/login')->with('msg', 'Have fun!');
		}else{
			return Redirect::to('user/register')->with('msg', 'Faild')->withErrors($validator)->withInput();
		}
	}

	// deng lu ye
	public function getLogin()
	{
		return view('user.login');
	}

	// deng lu
	public function postLogin(Request $request)
	{
		if(Auth::attempt(array('email'=>$request->email, 'password'=>$request->password)))
		{
			return Redirect::to('user/dashboard')->with('msg', 'You have logined');
		}else{
			return Redirect::to('user/login')->with('msg', 'Faild!')->withInput();
		}
	}

	public function getDashboard()
	{
		if(Auth::check())
		{
			return view('user.dashboard');
		}else{
			return Redirect::to('user/login');
		}
	}

	public function getLogout()
	{
		if(Auth::check())
		{
			Auth::logout();
		}
		return Redirect::to('user/login')->with('msg', 'You are logouted!');
	}
}