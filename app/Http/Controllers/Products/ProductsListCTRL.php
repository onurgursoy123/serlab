<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;

use App\Models\Products;


class ProductsListCTRL extends \App\Http\Controllers\Controller
{
  public function index($parent_id) {

    $products = Products::where('parent_id', $parent_id)->orderBy('sort', 'DESC')->get();
    return view('products.productList')->with(['products' => $products, 'parent_id' => $parent_id]);
  }

  public function search(Request $request) {

    $products = Products::where('parent_id', $request->parent_id)->where('title', 'Like', '%'.$request->word.'%')->orderBy('sort', 'DESC')->get();
    return view('products.productList')->with(['products' => $products, 'parent_id' => $request->parent_id]);

  }
  
}
