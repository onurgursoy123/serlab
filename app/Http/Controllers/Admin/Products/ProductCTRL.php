<?php

namespace App\Http\Controllers\Admin\Products;

use Illuminate\Http\Request;

use App\Models\Products;
use App\Models\Pages;


class ProductCTRL extends \App\Http\Controllers\Controller
{

  public function index($parent_id, $id) {
    $product = Products::with('comments')->with('same_products')->find($id);
    foreach($product->same_products as $index => $s_product) {
      if ($product->id == $s_product->id) {
        unset($product->same_products[$index]);
      }
    }

    if ($product->same_products->count() > 3) {
      unset($product->same_products[0]);
    }

    $product->description = str_replace("<img", "<img style=\"max-width:100%;\"", $product->description);
    $product->description = preg_replace('/<div class=\"ck ck-reset_all ck-widget__type-around\"><div class=\"ck ck-widget__type-around__button ck-widget__type-around__button_before\" title=\"Insert paragraph before block\"><svg xmlns=\"http:\/\/www.w3.org\/2000\/svg\" viewBox=\"0 0 10 8\"><path d=\"M9.055.263v3.972h-6.77M1 4.216l2-2.038m-2 2 2 2.038\"><\/path><\/svg><\/div><div class=\"ck ck-widget__type-around__button ck-widget__type-around__button_after\" title=\"Insert paragraph after block\"><svg xmlns=\"http:\/\/www.w3.org\/2000\/svg\" viewBox=\"0 0 10 8\"><path d=\"M9.055.263v3.972h-6.77M1 4.216l2-2.038m-2 2 2 2.038\"><\/path><\/svg><\/div><div class=\"ck ck-widget__type-around__fake-caret\"><\/div><\/div>/', '', $product->description);
    $product->description = preg_replace('/<div class=\"ck ck-reset_all ck-widget__resizer\" style=\"display: none;\"><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-left\"><\/div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-right\"><\/div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-right\"><\/div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-left\"><\/div><div class=\"ck ck-size-view\" style=\"display: none;\"><\/div><\/div>/', '', $product->description);


    return view('admin.products.product')->with(['product' => $product]);
  }


}
