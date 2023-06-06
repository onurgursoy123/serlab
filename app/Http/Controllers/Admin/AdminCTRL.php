<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\PersonalAccessTokens;


class AdminCTRL extends \App\Http\Controllers\Controller
{
  public function support() {
    // header('Content-Type: application/json');
    return ['status' => true, 'data' => [
      'name' => 'vVE7s',
      'version' => env('SERLAB_VVE7S_VERSION'),
      'author' => 'vVe7s Çekirdek Ekibi',
      'support' => 'https://vve7s.store'
    ]];
  }

  public function login(Request $request) {

    if (session()->has('user')) {
      if (isset(session('user')['token'])) {
        $token = session('user')['token'];
        if (!empty($token)) {
          $personalAccessToken = PersonalAccessTokens::where('token', $token)->where('status', 1)->where('status', 1)->where('expires_token', '>', date('Y-m-d H:i:s'))->first();
          if (!empty($personalAccessToken)) return $this->errorResponse();
        }
      }
    }
    
    return view('admin.auth.login');
  }

  public function errorResponse() {
    return redirect('error');

    return response()->json([
      'status' => false,
      'error' => [
        'description' => 'Yetkiniz bulunmamaktadır!'
      ]
    ]);
  }

}
