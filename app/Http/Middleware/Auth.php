<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\PersonalAccessTokens;

class Auth
{
    // serlab.vve7s kullanici kontrolleri burada yapilir
    public function handle(Request $request, Closure $next)
    {   
      if (!session()->has('user')) return $this->errorResponse();

      $token = session('user')['token'];
      if (empty($token)) return $this->errorResponse();

      $personalAccessToken = PersonalAccessTokens::where('token', $token)->where('status', 1)->where('status', 1)->where('expires_token', '>', date('Y-m-d H:i:s'))->first();
      if (empty($personalAccessToken)) return $this->errorResponse();

      $personalAccessToken->expires_token = date('Y-m-d H:i:s', strtotime("+05 minutes", strtotime($personalAccessToken->expires_token))); 
      $personalAccessToken->update();

      return $next($request);
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
