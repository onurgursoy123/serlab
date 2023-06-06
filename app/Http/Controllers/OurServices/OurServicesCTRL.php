<?php

namespace App\Http\Controllers\OurServices;

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

    return view('our-services.empty')->with('data', $page);
  }

  /*
  public function getHeaderName() {
    $pages = Pages::where('path', 'Like', '%admin.our-services%')->get();
    if (empty($pages)) {
      return response()->json(['status' => false, "error" => "Bilinmedik bir hata oluştu, site yöneticisine başvurun."]);
    }
    return response()->json(['status' => true, "data" => $pages]);
  }


  public function guarantee() {
    $data = Pages::where('path', 'admin.our-services.guarantee')->first();
    return view('our-services.guarantee')->with('data', $data);

  }
  
  public function productSales() {
    $data = Pages::where('path', 'admin.our-services.product-sales')->first();
    return view('our-services.product-sales')->with('data', $data);
    
  }
  
  public function repairAndMaintenance() {
    $data = Pages::where('path', 'admin.our-services.repair-and-maintenance')->first();
    return view('our-services.repair-and-maintenance')->with('data', $data);
    
  }
  
  public function spareParts() {
    $data = Pages::where('path', 'admin.our-services.spare-parts')->first();
    return view('our-services.spare-parts')->with('data', $data);
    
  }

  public function otherServices() {
    $data = Pages::where('path', 'admin.our-services.other-services')->first();
    return view('our-services.other-services')->with('data', $data);

  }
  */
  
}
