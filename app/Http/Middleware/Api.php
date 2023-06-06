<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\PersonalAccessTokens;

class Api
{
    // serlab.vve7s kullanici kontrolleri burada yapilir
    public function handle(Request $request, Closure $next)
    {   
      if (empty($request->token)) return $this->errorResponse();

      $personalAccessToken = PersonalAccessTokens::where('token', $request->token)->where('status', 1)->where('status', 1)->where('expires_token', '>', date('Y-m-d H:i:s'))->first();
      if (empty($personalAccessToken)) return $this->errorResponse();

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
