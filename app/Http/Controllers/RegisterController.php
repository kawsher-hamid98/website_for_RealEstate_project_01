<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Redirect;
use App\Register;
use Auth;

class RegisterController extends Controller
{
      public function store() {

    	$data = Input::except(array('_token'));

    	$rule = array(

    		'name' => 'required',
    		'email' => 'required|email',
    		'password' => 'required|min:6|max:12',
    		'cpassword' => 'required|same:password'
    	);

    	$message = array(

    		'cpassword.required' => 'password Confirmation must required',
    		'cpassword.min' => 'password must be atleast 6 characters long',
    		'cpassword.max' => 'password must be atmost 12 character long',
    		'cpassword.same' => 'Password does not match',
    	);

    	$validator = Validator::make($data, $rule, $message);

    	if($validator -> fails()) {
    		return Redirect::to('register')->withErrors($validator);
    	} else {
    		Register::form_store(Input::except(array('_token', 'cpassword')));
    		return Redirect::to('register') -> with('success', 'Successfully registered');
    	}

    }


    public function login() {

    	$data = Input::except(array('_token'));

    	$rule = array(

    		'email' => 'required|email',
    		'password' => 'required'
    	);

    	$validator = Validator::make($data, $rule);

    	if($validator -> fails()) {
    		return Redirect::to('register')->withErrors($validator);
    	} else {
    		$userdata = array(
    			'email' => Input::get('email'),
    			'password' => Input::get('password')
    		);
    		
    		if(Auth::attempt($userdata)) {
    			return Redirect::to('');
    		} else {
    			return Redirect::to('login');
    		}
    }
}

}
