<?php

namespace App\Http\Controllers\Contact;

use Illuminate\Http\Request;

use App\Models\Pages;

class ContactCTRL extends \App\Http\Controllers\Controller
{
  
  public function index() {
    $page = Pages::where('path', 'admin.contact')->where('title', 'settings')->first();
    return view('contact.contact')->with('data', $page);
  }

}
