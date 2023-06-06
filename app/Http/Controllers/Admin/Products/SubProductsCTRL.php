<?php

namespace App\Http\Controllers\Admin\Products;

use Illuminate\Http\Request;

use App\Models\Products;
use App\Models\Pages;


class SubProductsCTRL extends \App\Http\Controllers\Controller
{
  public function index($parent_id) {

    $products = Products::where('parent_id', $parent_id)->orderBy('sort', 'DESC')->get();
    return view('admin.products.subProducts')->with(['products' => $products, 'parent_id' => $parent_id]);
  }

  public function update(Request $request) {
    
    $request->validate([
      'id' => ['required', 'integer'],
      'title' => ['required', 'string'],
      // 'price' => ['required', 'numeric', 'min:1','max:999999999.99'],
      // 'stock' => ['required', 'integer'],
      'parent_id' => ['required', 'integer'],
      // 'description' => ['required']
    ]);

    $product = Products::find($request->id);
    if (empty($product)) back()->with('error', 'İşlem Başarısız');

    // $product->parent_id = $request->parent_id;
    $product->title = $request->title;
    $product->sort = isset($request->sort) ? $request->sort : 0;

    // isset($request->price) ? $product->price = $request->price : "";
    // isset($request->stock) ? $product->stock = $request->stock : "";
    // isset($request->description) ? $product->description = $request->description : "";
    
    if ($request->file('files')) {
      $flag = multiImageRemove($product->img_json, 1);
      if ($flag == false) back()->with('error', 'İşlem Başarısız');

      try {
        $data = [];
        foreach($request->file('files') as $index => $file) {
          $name = date('YmdHis').rand(1, 1000).'.'.$file->extension();
          $path = public_path().'/image';
          $file->move($path, $name);
          array_push($data, ['name' => $name, 'path' => '/image']);
        }
      } catch (\Exception $e) {
        return back()->with('error', 'İşlem Başarısız');
      }

      $product->img_json = json_encode($data);
    }

    if ($product->update()) return back()->with('success', 'İşlem Başarılı');

    return back()->with('error', 'İşlem Başarısız');

  }

  public function store(Request $request) {

    $request->validate([
      'title' => ['required', 'string'],
      // 'price' => ['required', 'numeric', 'min:1','max:999999999.99'],
      // 'stock' => ['required', 'integer'],
      'parent_id' => ['required', 'integer'],
      // 'description' => ['required']
    ]);

    $product = new Products();
    $product->parent_id = $request->parent_id;
    $product->title = $request->title;
    $product->sort = isset($request->sort) ? $request->sort : 0;
    // isset($request->price) ? $product->price = $request->price : "";
    // isset($request->stock) ? $product->stock = $request->stock : "";
    // isset($request->description) ? $product->description = $request->description : "";

    if (!empty($request->file('files'))) {
      try {
          $data_img = [];
          foreach ($request->file('files') as $index => $file) {
              $name = date('YmdHis').rand(1, 1000).'.'.$file->extension();
              $path = public_path().'/image';
              $file->move($path, $name);
              array_push($data_img, ['name' => $name, 'path' => '/image']);
          }
      } catch (\Exception $e) {
          return back()->with('error', 'İşlem Başarısız');
      }
      $product->img_json = json_encode($data_img);
    }

    if ($product->save()) return back()->with('success', 'İşlem Başarılı');

    return back()->with('error', 'İşlem Başarısız');
  }

  public function destroy(Request $request) {

    $request->validate([
      'id' => ['required', 'integer'],
    ]);

    $product = Products::find($request->id);
    if (empty($product)) back()->with('error', 'İşlem Başarısız');

    $flag = multiImageRemove($product->img_json, 1);
    if ($flag == false) back()->with('error', 'İşlem Başarısız');

    if ($product->delete()) return back()->with('success', 'İşlem Başarılı');

    return back()->with('error', 'İşlem Başarısız');

  }

  public function search(Request $request, $parent_id) {
    $data = Pages::with('products')->where('path', 'admin.products')->get();
    $products = Products::where('parent_id', $parent_id)->where('title', 'Like', '%'.$request->word.'%')->get();
    return view('admin.products.subProducts')->with(['data' => $data, 'products' => $products, 'parent_id' => $parent_id]);

  }

}
