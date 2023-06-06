<?php

namespace App\Http\Controllers\Admin\Corporate;

use Illuminate\Http\Request;

use App\Models\Corporate;

class CorporateCTRL extends \App\Http\Controllers\Controller
{
  public function index() {
    $corporate = Corporate::find(1);
    return view('admin.corporate.corporate')->with('corporate', $corporate);

  }

  public function update(Request $request) {

    $corporate = Corporate::find(1);
    if ($request->status == 1) {
      
      
      if ($request->file('files')) {

        try {
          $flag = imageRemove($request->img_json, 1);
          $data = [];
          $name = date('YmdHis').rand(1, 1000).'.'.$request->file('files')->extension();
          $path = public_path().'/image';
          $request->file('files')->move($path, $name);
          array_push($data, ['name' => $name, 'path' => '/image']);
  
        } catch (\Exception $e) {
          return back()->with('error', 'İşlem Başarısız');
        }
        $corporate->img_json = json_encode($data);

      }



      if ($corporate->update()) return back()->with('success', 'İşlem Başarılı');
      
    } else if ($request->status == 2) {
      $corporate->contents = $request->contents;
      if ($corporate->update()) return back()->with('success', 'İşlem Başarılı');

    }

    return back()->with('error', 'İşlem Başarısız');
  }

}
