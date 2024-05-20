<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\Authenticate\LoginRequest;
use App\Http\Requests\Authenticate\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function Login(){
        if(Auth::check()){
            return redirect()->route('homepage');
        };
        return view('user.auth');
    }

    public function pLogin(LoginRequest $request){
        $account = $request->validated();
        if (Auth::attempt($account)) {
            $request->session()->regenerate();
            return redirect()->route('homepage');
        }else{
            return redirect()->back()->withErrors(['msg' => 'Wrong password or username!']);
        }
    }

    public function register(){
        return view('user.register');
    }

    public function pRegister(RegisterRequest $request){
        $account = $request->validated();
        $role = ['role'=>UserRole::User];
        $account = array_merge($account,$role);
        $user=User::create($account);
        Auth::login($user);
        return redirect()->route('homepage');
    }

    public function Logout(User $user){
        Auth::logout($user);
        return redirect()->route('homepage');
    }

    
}
