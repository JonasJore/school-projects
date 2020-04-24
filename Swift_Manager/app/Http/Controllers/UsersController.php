<?php

namespace App\Http\Controllers;

use App\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class UsersController extends Controller
{
    public function index() {
        //return response()->json(Users::get(),200);
        //"SELECT * FROM ansatt where email = 'jonas@test.no' and passord = 'jjore'";
        return DB::select(DB::raw("select epost, brukernavn, passord from ansatt join påloggingsinfo on idAnsatt = Ansatt_idAnsatt where epost = 'jonas@test.no' and passord = 'test1'"));
        //return (DB::select(DB::raw("select epost, brukernavn, passord from ansatt join påloggingsinfo on idAnsatt = Ansatt_idAnsatt where brukernavn = 'jjore'")));
    }

    public function show($idAnsatt) {
        return response()->json(Users::find($idAnsatt),200);
    }
}
