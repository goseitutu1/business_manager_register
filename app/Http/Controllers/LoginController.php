<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\mysql;
// use Illuminate\Database\Eloquent\Model;
use Validator;
use Auth;
use App\Agent;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function checkLogin(Request $request)
    {
        $this->validate($request,[
            'Email' => 'required|email',
            'password' => 'required|alphaNum|min:6'
        ]);

        $user_data = array(
            'Email' => $request->get('Email'),
            'password' => $request->get('password')
        );

        $agent = Agent::where('email', $user_data['Email'])->first();
        if($agent){
            $password = $agent->password;
            if($password == $user_data['password']){
                return redirect('/register');
            }
            
            else{
                return back()->with('error', 'wrong credentials');
            }
        }

        else{
            return back()->with('error', 'wrong credentials');   
        }
        
    }
    
}
