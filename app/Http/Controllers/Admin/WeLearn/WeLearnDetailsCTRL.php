<?php

namespace App\Http\Controllers\Admin\WeLearn;

use Illuminate\Http\Request;

use App\Models\WeLearn;

class WeLearnDetailsCTRL extends \App\Http\Controllers\Controller
{

  public function index($id) {
    $weLearn = WeLearn::find($id);
    $weLearnsOther = WeLearn::where('id', '!=', $id)->orderBy('id', 'DESC')->take(10)->get();
    return view('admin.we-learn.we-learn-details')->with(['weLearn' => $weLearn, 'weLearnsOther' => $weLearnsOther]);
  }

}
