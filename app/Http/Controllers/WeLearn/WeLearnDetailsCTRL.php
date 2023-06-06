<?php

namespace App\Http\Controllers\WeLearn;

use Illuminate\Http\Request;

use App\Models\WeLearn;

class WeLearnDetailsCTRL extends \App\Http\Controllers\Controller
{

  public function index($id) {
    $weLearn = WeLearn::find($id);
    $weLearnsOther = WeLearn::where('id', '!=', $id)->orderBy('id', 'DESC')->take(10)->get();
    return view('we-learn.we-learn-details')->with(['weLearn' => $weLearn, 'weLearnsOther' => $weLearnsOther]);
  }
  
}
