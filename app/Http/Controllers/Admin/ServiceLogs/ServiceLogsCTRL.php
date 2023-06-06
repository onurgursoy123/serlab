<?php

namespace App\Http\Controllers\Admin\ServiceLogs;

use Illuminate\Http\Request;

use App\Models\Blogs;

class ServiceLogsCTRL extends \App\Http\Controllers\Controller
{

  public function index() {
    $blogs = Blogs::orderBy('sort', 'DESC')->get();
    return view('admin.service-logs.service-logs')->with(['blogs' => $blogs]);
  }

  public function store(Request $request) {

    $request->validate([
      'title' => ['required', 'string'],
      'contents' => ['required', 'string'],
    ]);


    $blog = new Blogs();
    $blog->title = $request->title;
    $blog->contents = $request->contents;
    $blog->sort = isset($request->sort) ? $request->sort : 0;

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
      $blog->img_json = json_encode($data);
    }

    if ($blog->save()) return back()->with('success', 'İşlem Başarılı');

    return back()->with('error', 'İşlem Başarısız');

  }

  public function update(Request $request, $id) {

    $request->validate([
      'title' => ['required', 'string'],
      'contents' => ['required', 'string'],
    ]);

    $blog = Blogs::find($id);

    if (empty($blog)) return back()->with('error', 'İşlem Başarısız');

    $blog->title = $request->title;
    $blog->contents = $request->contents;
    $blog->sort = isset($request->sort) ? $request->sort : 0;

    if ($request->file('files')) {

      $flag = imageRemove($blog->img_json, 1);
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
      $blog->img_json = json_encode($data);
    }

    if ($blog->save()) return back()->with('success', 'İşlem Başarılı');

    return back()->with('error', 'İşlem Başarısız');

  }

  public function destroy($id) {

    $blog = Blogs::find($id);
    if (empty($blog)) back()->with('error', 'İşlem Başarısız');

    $flag = imageRemove($blog->img_json, 1);
    if ($flag == false) back()->with('error', 'İşlem Başarısız');

    if ($blog->delete()) return back()->with('success', 'İşlem Başarılı');

    return back()->with('error', 'İşlem Başarısız');
  }

}
