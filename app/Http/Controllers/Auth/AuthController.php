<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
   public function showLogin()
  {
    return view('admin.login_form');
  }   
   
   public function login()
  {
    $credentials = $request->only('email','password');

    if ( Auth::guard('admin')->attempt($credentials))
    {
     $request->session()->regenerate();
     return redirect('admin');
    }

    return back()->withErrors([
      'login_error'=>'メールアドレスかパスワードが間違っています。',  
    ]);
  } 

  public function logout(Request $request)
  {
    Auth::guard('admin')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('admin/login_form');
  }
}
