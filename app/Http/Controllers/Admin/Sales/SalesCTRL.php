<?php

namespace App\Http\Controllers\Admin\Sales;

use Illuminate\Http\Request;

use App\Models\Pages;

class SalesCTRL extends \App\Http\Controllers\Controller
{

  public function index() {
    $data = Pages::where('path', 'admin.sales.mail')->first();
    return view('admin.sales.sales')->with('data', $data);
  }

  public function mailAddress(Request $request) {
    $request->validate([
      'mail' => 'required',
    ]);

    $page = Pages::where('path', 'admin.sales.mail')->first();
    $page->description = $request->mail;

    if ($page->update()) return back()->with('success', 'İşlem Başarılı');

    return back()->with('error', 'İşlem Başarısız');

  }

}
