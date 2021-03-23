<?php
// AuthController
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        
        User::create([
             'name' => $request['name'],
             'email' => $request['email'],
             'password' => Hash::make($request['password']),
         ]);        

        return redirect()->to('/login'); 
    }



    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Either email or password is wrong.'], 401);
        }
        return redirect()->to('/home');
    }


    public function logout() {
        auth()->logout();
        //return view('register');
        return redirect()->to('/login'); 
    }

    public function home($guard=null) {
        if(Auth::guard($guard)->check()){
            return redirect()->to('/register'); 
        }else{
            return view('home');
        }
        //return view('register');
        
    }
    public function userProfile() {
        return response()->json(auth()->user());
    }



}
