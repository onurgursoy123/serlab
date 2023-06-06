<?php

namespace App\Http\Controllers\Admin\WeLearn;

use Illuminate\Http\Request;

use App\Models\WeLearn;

class WeLearnCTRL extends \App\Http\Controllers\Controller
{

  public function index() {
    $weLearns = WeLearn::orderBy('sort', 'DESC')->get();
    return view('admin.we-learn.we-learn')->with(['weLearns' => $weLearns]);
  }

  public function store(Request $request) {

    $request->validate([
      'title' => ['required', 'string'],
      'contents' => ['required', 'string'],
    ]);

    $weLearn = new WeLearn();
    $weLearn->title = $request->title;
    $weLearn->contents = $request->contents;
    $weLearn->sort = isset($request->sort) ? $request->sort : 0;

    if ($request->file('files')) {
      try {
        $data = [];
        $name = date('YmdHis').rand(1, 1000).'.'.$request->file('files')->extension();
        $path = public_path().'/image';
        $request->file('files')->move($path, $name);
        array_push($data, ['name' => $name, 'path' => '/image']);

      } catch (\Exception $e) {
        return back()->with('error', 'İşlem Başarısız');
      }
      $weLearn->img_json = json_encode($data);
    }

    if ($weLearn->save()) return back()->with('success', 'İşlem Başarılı');

    return back()->with('error', 'İşlem Başarısız');

  }

  public function update(Request $request, $id) {

    $request->validate([
      'title' => ['required', 'string'],
      'contents' => ['required', 'string'],
    ]);

    $weLearn = WeLearn::find($id);

    if (empty($weLearn)) return back()->with('error', 'İşlem Başarısız');

    $weLearn->title = $request->title;
    $weLearn->contents = $request->contents;
    $weLearn->sort = isset($request->sort) ? $request->sort : 0;

    if ($request->file('files')) {

      $flag = imageRemove($weLearn->img_json, 1);
      if ($flag == false) back()->with('error', 'İşlem Başarısız');

      try {
        $data = [];
        $name = date('YmdHis').rand(1, 1000).'.'.$request->file('files')->extension();
        $path = public_path().'/image';
        $request->file('files')->move($path, $name);
        array_push($data, ['name' => $name, 'path' => '/image']);

      } catch (\Exception $e) {
        return back()->with('error', 'İşlem Başarısız');
      }
      $weLearn->img_json = json_encode($data);
    }

    if ($weLearn->save()) return back()->with('success', 'İşlem Başarılı');

    return back()->with('error', 'İşlem Başarısız');

  }

  public function destroy($id) {

    $weLearn = WeLearn::find($id);
    if (empty($weLearn)) back()->with('error', 'İşlem Başarısız');

    $flag = imageRemove($weLearn->img_json, 1);
    if ($flag == false) back()->with('error', 'İşlem Başarısız');

    if ($weLearn->delete()) return back()->with('success', 'İşlem Başarılı');

    return back()->with('error', 'İşlem Başarısız');
  }

}
