<?php

namespace App;

use Illuminate\Support\Facades\Input;
use Hash;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Register extends Authenticatable
{

	// protected $table = "register_users";
    
    public static function form_store($data) {
    	// echo "Here the model is";

    	// var_dump($data);

    	$name = Input::get('name');
    	$email = Input::get('email');
    	$password = Hash::make(Input::get('password'));

    	$users = new Register();

    	$users -> name = $name;
    	$users -> email = $email;
    	$users -> password = $password;

    	$users -> save();
    }
}
