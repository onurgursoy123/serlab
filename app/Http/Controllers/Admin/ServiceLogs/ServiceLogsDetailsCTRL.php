<?php

namespace App\Http\Controllers\Admin\ServiceLogs;

use Illuminate\Http\Request;

use App\Models\Blogs;

class ServiceLogsDetailsCTRL extends \App\Http\Controllers\Controller
{

  public function index($id) {
    $blog = Blogs::find($id);
    $blogsOther = Blogs::where('id', '!=', $id)->orderBy('id', 'DESC')->take(10)->get();
    return view('admin.service-logs.service-logs-details')->with(['blog' => $blog, 'blogsOther' => $blogsOther]);
  }

}
