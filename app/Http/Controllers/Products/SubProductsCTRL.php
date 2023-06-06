<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;

use App\Models\Products;
use App\Models\Pages;


class SubProductsCTRL extends \App\Http\Controllers\Controller
{
  public function index($parent_id) {

    $products = Products::where('parent_id', $parent_id)->orderBy('sort', 'DESC')->get();
    return view('products.subProducts')->with(['products' => $products, 'parent_id' => $parent_id]);
  }

  public function search(Request $request, $parent_id) {
    
    $data = Pages::with('products')->where('path', 'admin.products')->get();
    $products = Products::where('parent_id', $parent_id)->where('title', 'Like', '%'.$request->word.'%')->get();
    return view('products.subProducts')->with(['data' => $data, 'products' => $products, 'parent_id' => $parent_id]);
  }

}
