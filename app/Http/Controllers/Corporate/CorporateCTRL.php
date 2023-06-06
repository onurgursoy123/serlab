<?php

namespace App\Http\Controllers\Corporate;

use Illuminate\Http\Request;

use App\Models\Corporate;

class CorporateCTRL extends \App\Http\Controllers\Controller
{
  
  public function index() {
    $corporate = Corporate::find(1);
    return view('corporate.corporate')->with('corporate', $corporate);
  }

}
