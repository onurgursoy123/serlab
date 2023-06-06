<?php

namespace App\Http\Controllers\Admin\Dashboard;

use Illuminate\Http\Request;

use App\Models\Pages;
use App\Models\Products;
use Exception;

class DashboardCTRL extends \App\Http\Controllers\Controller
{
  public function index() {
    $data = Pages::where('path', 'admin.dashboard')->get();
    return view('admin.dashboard')->with('data', $data);
  }

  public function update(Request $request) {
    $request->validate([
      'status' => 'required',
      'title' => ['required', 'string'],
      'path' => ['required', 'string'],
      'description' => ['required']
    ]);

    $page = Pages::where('path', $request->path)->where('title', $request->title)->first();
    if (empty($page)) return back()->with('error', 'İşlem Başarısız');

    // status 3 ise fotograf gonderilmistir
    if ($request->status == 3) {
      if($request->hasFile('description')) {
        $description = imageUpload($request);
        if (empty($description)) return back()->with('error', 'İşlem Başarısız');
        // imageRemove($page);
        $page->description = $description;
      }
    } else if ($request->status == 4) { // birden fazla fotograf
      if($request->hasFile('description')) {
        $description = multiImageUpload($request);
        if (empty($description)) return back()->with('error', 'İşlem Başarısız');
        multiImageRemove($page);
        $page->description = $description;
      }
    } else {
      $page->description = $request->description;
    }
    if ($page->update()) return back()->with('success', 'İşlem Başarılı');

    return back()->with('error', 'İşlem Başarısız');

  }

  public function getHeaderData() {
    $page = Pages::where('path', 'admin.header')->first();
    if (empty($page)) {
      return back()->with('error', 'İşlem Başarısız');
    }
    $header = json_decode($page->description);
    $header->status = true;

    return $header;
  }

  public function headerUpdate(Request $request) {
    $page = Pages::where('path', 'admin.header')->first();
    if (empty($page)) {
      return back()->with('error', 'İşlem Başarısız');
    }

    $header = [];
    $header['telNo'] = (isset($request->telNo) && !empty($request->telNo)) ? $request->telNo : null; 
    $header['mail'] = (isset($request->mail) && !empty($request->mail)) ? $request->mail : null; 
    $header['time'] = (isset($request->time) && !empty($request->time)) ? $request->time : null; 
    $header['address'] = (isset($request->address) && !empty($request->address)) ? $request->address : null; 
    $header['wtelNo'] = (isset($request->wtelNo) && !empty($request->wtelNo)) ? $request->wtelNo : null; 
    $header['facebook'] = (isset($request->facebook) && !empty($request->facebook)) ? $request->facebook : null; 
    $header['twitter'] = (isset($request->twitter) && !empty($request->twitter)) ? $request->twitter : null; 
    $header['instagram'] = (isset($request->instagram) && !empty($request->instagram)) ? $request->instagram : null; 
    $header['linkedIn'] = (isset($request->linkedIn) && !empty($request->linkedIn)) ? $request->linkedIn : null; 

    $page->description = json_encode($header);

    if ($page->update()) return back()->with('success', 'İşlem Başarılı');

    return back()->with('error', 'İşlem Başarısız');

  }

  public function destroy(Request $request) {

    return $request;

  }

  public function upload(Request $request) {

    if ($request->hasFile('upload')) {
        $file = $request->upload;
        $newName = date('YmdHis').rand(1, 1000).time().'.'.$file->extension();
        $path = public_path().'/image/ck';
        $file->move($path, $newName);
        $url = asset("image/ck/$newName");
        return response()->json(['filename' => $newName, 'uploaded' => true, 'url' => $url]);
    }

  }

  public function getHeaderProducts() {
    $products = Products::where('parent_id', 0)
      ->where('id', '!=', 19)
      ->where('title', '!=', '2.El Cihazlar')
      ->get();

    return ['status' => true, 'products' => $products];
  }

  public function getFooterData() {
    $data = Pages::where('path', 'admin.footer')->where('title', 'settings')->first();
    return response()->json(['status' => true, "data" => $data]);
  }

  public function footerUpdate(Request $request) {
    $data = Pages::where('path', 'admin.footer')->where('title', 'settings')->first();
    $data->contents = $request->contents;

    if ($data->update()) return back()->with('success', 'İşlem Başarılı');
    
    return back()->with('error', 'İşlem Başarısız');
    
  }
}
