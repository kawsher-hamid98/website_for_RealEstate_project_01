<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Redirect;
use Auth;
use App\Admin;

class AdminLoginController extends Controller
{

		public function __construct() {
		$this -> middleware('guest:admin');
	}
    

    public function show() {
    	return view('admin.adminLogin');
    }


    public function login() {

    	$data = Input::except(array('_token'));

    	$rule = array(

    		'email' => 'required',
    		'password' => 'required|min:6',
    	);

    	$validator = Validator::make($data, $rule);

    	if($validator -> fails()) {
    		return Redirect::to('adminLogin')->withErrors($validator);

    	} else {

    		$userdata = array(
    			'email' => Input::get('email'),
    			'password' => Input::get('password')
    		);
    		
    		if(Auth::guard('admin')->attempt($userdata)) {
 
    			return Redirect::to('')->with('success', 'Successfully Logged in');
    		} else {
    			return Redirect::to('adminLogin');
    		}
    }


    }

}
