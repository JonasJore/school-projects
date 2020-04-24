<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Input;
use Log;
use View;
use Validator;
use Redirect;
use Auth;
use Form;

class LoginController extends Controller {

    public function showLogin() {
        return View::make('login');
    }

    public function doLogin(Request $request) {
        //rules for the input in loginform
        $rulesForForm = [
            'brukernavn' => 'required',
            'passord' => 'required'
        ];
        

        $validation = Validator::make(Input::all(), $rulesForForm);

        // if($validation->fails()) {
        //     //Log::debug("fails validation");
        //     //return Redirect::to('login')->withErrors($validation)->withInput(Input::except('password'));
        // } else {
        //     Log::debug("second else");
            

            
        // } 
        // var_dump(Input::get('brukernavn'));
        // var_dump(Input::get('passord'));


        

        if(Auth::attempt(['brukernavn' => Input::get('brukernavn'),'passord' => Input::get('passord')])) {
            Log::debug("shit works yo");
            return View::make('board');

        }

        



    }
}
