<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
//    issue login token
    public function index()
    {
        $user = Auth::user();
        if($user){
            return redirect(route('user.dashboard'));
        }else{
            return redirect(route('login'));
        }
    }

//    authenticate the user
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return redirect(route('user.dashboard'));
        } else {
            return view('login', [
                'authMessage' => 'Invalid credentials'
            ]);
        }
    }

//    register new user
    public function register(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required|min:8'
        ]);

        $user = User::where('username', $credentials['username'])->first();
        if ($user) {
            return view('register', [
                'authMessage' => "User already exists"
            ]);
        } else {
            $user = new User();
            $user->username = $credentials['username'];
            $user->password = $credentials['password'];
            $user->save();
            return view('register', [
                'authMessage' => 'Successfully registered'
            ]);
        }
    }

//    logout user
    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }

}
