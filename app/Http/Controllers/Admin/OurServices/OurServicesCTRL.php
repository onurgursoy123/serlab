<?php

namespace App\Http\Controllers\Admin\OurServices;

use Illuminate\Http\Request;

use App\Models\Pages;

class OurServicesCTRL extends \App\Http\Controllers\Controller
{

  public function getOurServicesHeader() {
    $pages = Pages::where('description', 'our-services')->get();

    return response()->json(['status' => true, "ourServices" => $pages]);
  }

  public function getDynamicUrl($url) {
    $page = Pages::where('title', $url)->where('description', 'our-services')->first();

    $page->contents = str_replace("<img", "<img style=\"max-width:100%;\"", $page->contents);

    $page->contents = preg_replace('/<div class=\"ck ck-reset_all ck-widget__type-around\"><div class=\"ck ck-widget__type-around__button ck-widget__type-around__button_before\" title=\"Insert paragraph before block\"><svg xmlns=\"http:\/\/www.w3.org\/2000\/svg\" viewBox=\"0 0 10 8\"><path d=\"M9.055.263v3.972h-6.77M1 4.216l2-2.038m-2 2 2 2.038\"><\/path><\/svg><\/div><div class=\"ck ck-widget__type-around__button ck-widget__type-around__button_after\" title=\"Insert paragraph after block\"><svg xmlns=\"http:\/\/www.w3.org\/2000\/svg\" viewBox=\"0 0 10 8\"><path d=\"M9.055.263v3.972h-6.77M1 4.216l2-2.038m-2 2 2 2.038\"><\/path><\/svg><\/div><div class=\"ck ck-widget__type-around__fake-caret\"><\/div><\/div>/', '', $page->contents);
    
    $page->contents = preg_replace('/<div class=\"ck ck-reset_all ck-widget__resizer\" style=\"display: none;\"><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-left\"><\/div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-right\"><\/div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-right\"><\/div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-left\"><\/div><div class=\"ck ck-size-view\" style=\"display: none;\"><\/div><\/div>/', '', $page->contents);
    
    return view('admin.our-services.empty')->with('data', $page);
  }

  public function store(Request $request) {

    $request->validate([
      'title' => ['required'],
      'contents' => ['required'],
    ]);

    $page = new Pages();
    $page->path = mb_strtolower(str_replace(" ", ".", $request->title));
    $page->title = $request->title;
    $page->description = "our-services";
    $page->contents = $request->contents;

    if ($page->save()) return back()->with('success', 'İşlem Başarılı');

    return back()->with('error', 'İşlem Başarısız');

  }

  public function update(Request $request) {

    $request->validate([
      'title' => ['required'],
      'contents' => ['required'],
    ]);

    $page = Pages::find($request->id);
    if (empty($page)) {
      return back()->with('error', 'İşlem Başarısız');
    }

    $page->title = $request->title;
    $page->contents = $request->contents;

    if ($page->update()) return view('admin.our-services.empty')->with('data', $page);

    return back()->with('error', 'İşlem Başarısız');


  }

  public function get() {
    return view('admin.our-services.new-page');
  }

  /*
  public function changeName(Request $request) {
    
    $request->validate([
      'path' => ['required'],
      'title' => ['required'],
    ]);

    $pages = Pages::where('path', $request->path)->first();
    $pages->title = $request->title;

    if ($pages->update()) return back()->with('success', 'İşlem Başarılı');

    return back()->with('error', 'İşlem Başarısız');

  }

  public function getHeaderName() {
    $pages = Pages::where('path', 'Like', '%admin.our-services%')->get();
    if (empty($pages)) {
      return response()->json(['status' => false, "error" => "Bilinmedik bir hata oluştu, site yöneticisine başvurun."]);
    }
    return response()->json(['status' => true, "data" => $pages]);
  }

  public function guarantee() {
    $data = Pages::where('path', 'admin.our-services.guarantee')->first();
    return view('admin.our-services.guarantee')->with('data', $data);
  }

  public function guaranteeUpdate(Request $request) {
    $request->validate([
      'status' => ['required'],
    ]);

    $page = Pages::where('path', 'admin.our-services.guarantee')->first();

    if ($request->status == 1) {

      if ($request->file('files')) {
        
        $flag = imageRemove($page->files, 1);
        if ($flag == false) return "false";

        try {
          $data = [];
          $name = date('YmdHis').rand(1, 1000).'.'.$request->file('files')->extension();
          $path = public_path().'/image';
          $request->file('files')->move($path, $name);
          array_push($data, ['name' => $name, 'path' => '/image']);
  
        } catch (\Exception $e) {
          return $e->getMessage();
          return back()->with('error', 'İşlem Başarısız');
        }
        $page->description = json_encode($data);
        if ($page->update()) return back()->with('success', 'İşlem Başarılı');

      }
      return back()->with('error', 'İşlem Başarısız');

    } else if ($request->status == 2) {

      $request->validate([
        'contents' => ['required'],
      ]);

      $page->contents = $request->contents;
      if ($page->update()) return back()->with('success', 'İşlem Başarılı');
    }

    return back()->with('error', 'İşlem Başarısız');
  }
  
  public function productSales() {
    $data = Pages::where('path', 'admin.our-services.product-sales')->first();
    return view('admin.our-services.product-sales')->with('data', $data);
  }
  
  public function productSalesUpdate(Request $request) {

    $request->validate([
      'status' => ['required'],
    ]);

    $page = Pages::where('path', 'admin.our-services.product-sales')->first();

    if ($request->status == 1) {
      
      if ($request->file('files')) {
        
        $flag = imageRemove($page->description, 1);
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
        $page->description = json_encode($data);
        if ($page->update()) return back()->with('success', 'İşlem Başarılı');

      }
      return back()->with('error', 'İşlem Başarısız');

    } else if ($request->status == 2) {

      $request->validate([
        'contents' => ['required'],
      ]);

      $page->contents = $request->contents;
      if ($page->update()) return back()->with('success', 'İşlem Başarılı');
    }

    return back()->with('error', 'İşlem Başarısız');
  }
  
  public function repairAndMaintenance() {
    $data = Pages::where('path', 'admin.our-services.repair-and-maintenance')->first();
    return view('admin.our-services.repair-and-maintenance')->with('data', $data);
  }

  public function repairAndMaintenanceUpdate(Request $request) {

    $request->validate([
      'status' => ['required'],
    ]);

    $page = Pages::where('path', 'admin.our-services.repair-and-maintenance')->first();

    if ($request->status == 1) {
      
      if ($request->file('files')) {
        
        $flag = imageRemove($page->description, 1);
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
        $page->description = json_encode($data);
        if ($page->update()) return back()->with('success', 'İşlem Başarılı');

      }
      return back()->with('error', 'İşlem Başarısız');

    } else if ($request->status == 2) {

      $request->validate([
        'contents' => ['required'],
      ]);

      $page->contents = $request->contents;
      if ($page->update()) return back()->with('success', 'İşlem Başarılı');
    }

    return back()->with('error', 'İşlem Başarısız');

  }
  
  public function spareParts() {
    $data = Pages::where('path', 'admin.our-services.spare-parts')->first();
    return view('admin.our-services.spare-parts')->with('data', $data);
  }

  public function sparePartsUpdate(Request $request) {

    $request->validate([
      'status' => ['required'],
    ]);

    $page = Pages::where('path', 'admin.our-services.spare-parts')->first();

    if ($request->status == 1) {
      
      if ($request->file('files')) {
        
        $flag = imageRemove($page->description, 1);
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
        $page->description = json_encode($data);
        if ($page->update()) return back()->with('success', 'İşlem Başarılı');

      }
      return back()->with('error', 'İşlem Başarısız');

    } else if ($request->status == 2) {

      $request->validate([
        'contents' => ['required'],
      ]);

      $page->contents = $request->contents;
      if ($page->update()) return back()->with('success', 'İşlem Başarılı');
    }

    return back()->with('error', 'İşlem Başarısız');
  }

  public function otherServices() {
    $data = Pages::where('path', 'admin.our-services.other-services')->first();
    return view('admin.our-services.other-services')->with('data', $data);
  }

  public function otherServicesUpdate(Request $request) {

    $request->validate([
      'status' => ['required'],
    ]);

    $page = Pages::where('path', 'admin.our-services.other-services')->first();

    if ($request->status == 1) {
      
      if ($request->file('files')) {
        
        $flag = imageRemove($page->description, 1);
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
        $page->description = json_encode($data);
        if ($page->update()) return back()->with('success', 'İşlem Başarılı');

      }
      return back()->with('error', 'İşlem Başarısız');

    } else if ($request->status == 2) {

      $request->validate([
        'contents' => ['required'],
      ]);

      $page->contents = $request->contents;
      if ($page->update()) return back()->with('success', 'İşlem Başarılı');
    }

    return back()->with('error', 'İşlem Başarısız');
  }
  */
  
}
