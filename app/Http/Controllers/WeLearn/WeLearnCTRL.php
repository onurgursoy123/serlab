<?php

namespace App\Http\Controllers\WeLearn;

use Illuminate\Http\Request;

use App\Models\WeLearn;

class WeLearnCTRL extends \App\Http\Controllers\Controller
{
  public function index() {
    $weLearn = WeLearn::orderBy('sort', 'DESC')->get();
    return view('we-learn.we-learn')->with(['weLearn' => $weLearn]);
  }
  
}
