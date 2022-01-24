<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AuthController extends Controller
{
  public function login(){
    return view('back.auth.login');
  }

  public function loginPost(Request $request){
    if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
      toastr()->success('Hoşgeldiniz '.Auth::user()->name);
      return redirect()->route('admin.dashboard');
    }
    else {
      return redirect()->route('admin.login')->withErrors('Email Adresi veya Şifre Hatalı!');
    }
  }

  public function logout(){
    Auth::logout();
    return redirect()->route('admin.login');
  }

}
