<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\PersonalAccessTokens;
use App\Models\User;

class AuthCTRL extends \App\Http\Controllers\Controller
{
  public function login(Request $request) {
    
    $request->validate([
      'email' => 'required|email',
      'password' => ['required', 'string', 'min:8']
    ]);
    
    $user = User::where('email', $request->email)->where('password', md5($request->password))->first();
    if (empty($user)) return back()->with('error', 'Giriş Başarısız!');


    $personalAccessToken = new PersonalAccessTokens();
    $personalAccessToken->token = $this->createToken();
    $personalAccessToken->expires_token = date('Y-m-d H:i:s', strtotime('+3 hours'));
    $personalAccessToken->save();

    session()->put('user', [
      'token' => $personalAccessToken->token
    ]);

    return redirect('admin/dashboard');
  }

  public function logout(Request $request) {

    if (!session()->has('user')) return $this->errorResponse();

    $token = session('user')['token'];
    if (empty($token)) return $this->errorResponse();

    $personalAccessToken = PersonalAccessTokens::where('token', $token)->where('status', 1)->where('status', 1)->where('expires_token', '>', date('Y-m-d H:i:s'))->first();
    if (empty($personalAccessToken)) return $this->errorResponse();

    
    session()->forget('user');
		Auth::logout();
    
    $personalAccessToken->status = 0;
    $personalAccessToken->expires_token = date('Y-m-d H:i:s');
    // $personalAccessToken->token = "VV";
    $personalAccessToken->update();
    $personalAccessToken->delete();

    return redirect('admin');
  }

  public function createToken($length = 64) {
    $max = ceil($length / 32);
    $random = '';
    for ($i = 0; $i < $max; $i ++) {
      $random .= md5(microtime(true).mt_rand(10000,90000));
    }
    return substr($random, 0, $length);
  }

  public function errorResponse() {
    return redirect('error');
  }

}
