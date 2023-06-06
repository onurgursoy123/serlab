<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;

use App\Models\Products;
use App\Models\Pages;


class ProductsCTRL extends \App\Http\Controllers\Controller
{
  public function products() {
    $data = Pages::with('products')->where('path', 'admin.products')->get();
    $products = Products::where('parent_id', 0)->orderBy('sort', 'DESC')->get();
    return view('products.products')->with(['data' => $data, 'products' => $products]);

  }
  
  public function productList() {

    return view('products.productList');
  }

  public function search(Request $request) {

    $data = Pages::with('products')->where('path', 'admin.products')->get();
    $products = Products::where('title', 'Like', '%'.$request->word.'%')->orderBy('sort', 'DESC')->get();
    return view('products.products')->with(['data' => $data, 'products' => $products]);

  }

}
