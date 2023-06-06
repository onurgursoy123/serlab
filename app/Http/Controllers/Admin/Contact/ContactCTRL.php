<?php

namespace App\Http\Controllers\Admin\Contact;

use Illuminate\Http\Request;

use App\Models\Pages;

class ContactCTRL extends \App\Http\Controllers\Controller
{
  public function index() {
    $page = Pages::where('path', 'admin.contact')->where('title', 'settings')->first();
    return view('admin.contact.contact')->with('data', $page);
  }

  public function update(Request $request) {

    $request->validate([
      'contents' => ['required']
    ]);

    $page = Pages::where('path', 'admin.contact')->where('title', 'settings')->first();
    if (empty($page)) return back()->with('error', 'İşlem Başarısız');

    $page->contents = $request->contents;
    if ($page->update()) return back()->with('success', 'İşlem Başarılı');

    
    
    return $request;
    return back()->with('success', 'İşlem Başarılı');
  }


}
