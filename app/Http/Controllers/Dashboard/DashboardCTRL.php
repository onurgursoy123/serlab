<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Pages;
use App\Models\Products;

class DashboardCTRL extends \App\Http\Controllers\Controller
{
  public function index() {
    $data = Pages::where('path', 'admin.dashboard')->get();
    return view('index')->with('data', $data);
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
  
}
