<?php

namespace App\Http\Controllers\ServiceLogs;

use Illuminate\Http\Request;

use App\Models\Blogs;

class ServiceLogsCTRL extends \App\Http\Controllers\Controller
{
  public function index() {
    $blogs = Blogs::orderBy('sort', 'DESC')->get();
    return view('service-logs.service-logs')->with(['blogs' => $blogs]);
  }
  
}
