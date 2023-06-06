<?php

namespace App\Http\Controllers\Admin\Products;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

use App\Models\Products;
use App\Models\Pages;


class ProductsListCTRL extends \App\Http\Controllers\Controller
{

  public function index($parent_id) {

    $products = Products::where('parent_id', $parent_id)->orderBy('sort', 'DESC')->get();
    // return view('admin.products.subProducts')->with(['products' => $products, 'parent_id' => $parent_id]);
    return view('admin.products.productList')->with(['products' => $products, 'parent_id' => $parent_id]);
  }

  public function update(Request $request) {

    $request->validate([
      'id' => ['required', 'integer'],
      'title' => ['required', 'string'],
      // 'price' => ['required', 'numeric', 'min:1','max:999999999.99'],
      // 'stock' => ['required', 'integer'],
      'parent_id' => ['required', 'integer'],
      'description' => ['required']
    ]);

    $product = Products::find($request->id);
    if (empty($product)) back()->with('error', 'İşlem Başarısız');

    $product->parent_id = $request->parent_id;
    $product->title = $request->title;
    $product->price = isset($request->price) ? $request->price : null;
    $product->stock = $request->stock;
    $product->description = $request->description;
    $product->sort = isset($request->sort) ? $request->sort : 0;

    $dataOld = [];
    if (isset($request->imgsDel) && !empty($request->imgsDel)) {
      foreach (json_decode($product->img_json) as $img) {
        $img_del = false;
        foreach($request->imgsDel as $imgsDel) {
          if ($imgsDel == $img->path."/".$img->name) {
            $img_del = true;
          }
        }
        if ($img_del) {
          if (file_exists(public_path().$img->path."/".$img->name)) {
            @unlink(public_path().$img->path."/".$img->name);
          }
        } else {
          if (isset($request->default_image_title) && $img->path."/".$img->name == $request->default_image_title) {
            array_push($dataOld, ['name' => $img->name, 'path' => '/image', 'is_dafault' => 1]);
          } else {
            array_push($dataOld, ['name' => $img->name, 'path' => '/image', 'is_dafault' => 0]);
          }
        }
      }
    }
    
    if ($request->file('files')) {
      // $flag = multiImageRemove($product->img_json, 1);
      // if ($flag == false) back()->with('error', 'İşlem Başarısız');

      try {
        $data = [];
        foreach($request->file('files') as $index => $file) {
          $name = date('YmdHis').rand(1, 1000).'.'.$file->extension();
          $path = public_path().'/image';
          $file->move($path, $name);
          if (isset($request->default_image_title) && $file->getClientOriginalName() == $request->default_image_title) {
            array_push($data, ['name' => $name, 'path' => '/image', 'is_dafault' => 1]);
          } else {
            array_push($data, ['name' => $name, 'path' => '/image', 'is_dafault' => 0]);
          }
        }
      } catch (\Exception $e) {
        return back()->with('error', 'İşlem Başarısız');
      }

      $data = array_merge($data, $dataOld);
      $product->img_json = json_encode($data);
    } else {
      $product->img_json = json_encode($dataOld);
    }

    $dataOldFile = [];
    if (isset($request->pdfsDel) && !empty($request->pdfsDel)) {
      foreach (json_decode($product->files_json) as $file) {
        $file_del = false;
        foreach($request->pdfsDel as $pdfsDel) {
          if ($pdfsDel == $file->name) {
            $file_del = true;
          }
        }
        if ($file_del) {
          if (file_exists(public_path().$file->path."/".$file->name)) {
            @unlink(public_path().$file->path."/".$file->name);
          }
        } else {
          array_push($dataOldFile, ['name' => $file->name, 'path' => '/documents']);
        }
      }
    }
    if (!empty($request->file('files_pdf'))) {
      $flag = multiImageRemove($product->files_json, 1);
      if ($flag == false) back()->with('error', 'İşlem Başarısız');

      try {
        $data_file = [];
        foreach($request->file('files_pdf') as $index => $file) {
          $name = date('YmdHis').rand(1, 1000).'.'.$file->extension();
          $path = public_path().'/documents';
          $file->move($path, $name);
          array_push($data_file, ['name' => $name, 'path' => '/documents']);
        }
      } catch (\Exception $e) {
        return back()->with('error', 'İşlem Başarısız');
      }

      $product->files_json = json_encode($data_file);
      
      $data_file = array_merge($data_file, $dataOldFile);
      if (empty($data_file)) {
        $product->files_json = null;
      } else {
        $product->files_json = json_encode($data_file);
      }
    } else {
      if (empty($dataOldFile)) {
        $product->files_json = null;
      } else {
        $product->files_json = json_encode($dataOldFile);

      }
    }

    if ($product->update()) return back()->with('success', 'İşlem Başarılı');

    return back()->with('error', 'İşlem Başarısız');

  }

  public function store(Request $request) {
    
    $validator = Validator::make($request->all(), [
      'files_pdf.*' => 'mimes:pdf,doc,docx|max:2048'
    ]);

    if ($validator->fails()) {
      return back()->with('error', 'Sadece pdf, doc veya docx uzantılı dosya yükleyebilirsiniz.');
    }

    $request->validate([
      'title' => ['required', 'string'],
      // 'price' => ['required', 'numeric', 'min:1','max:999999999.99'],
      // 'stock' => ['required', 'integer'],
      'parent_id' => ['required', 'integer'],
      'description' => ['required'],

    ]);

    $product = new Products();
    $product->parent_id = $request->parent_id;
    $product->title = $request->title;
    $product->sort = isset($request->sort) ? $request->sort : 0;
    isset($request->price) ? $product->price = $request->price : "";
    isset($request->stock) ? $product->stock = $request->stock : "";
    isset($request->priceLink) ? $product->priceLink = $request->priceLink : "";
    $product->description = $request->description;

    if (isset($request->video)) {
      $a = explode("youtu.be/", $request->video);
      if (!empty($a[1])) {
        $product->video = $a[1];

      } else {

        $b = explode("watch?v=", $request->video);
        $b = explode("&", $b[1]);
        if (!empty($b[0])) {
          $product->video = $b[0];

        }
      }
    }

    if (!empty($request->file('files'))) {
      try {
          $data = [];
          foreach ($request->file('files') as $index => $file) {
            $name = date('YmdHis').rand(1, 1000).'.'.$file->extension();
            $path = public_path().'/image';
            $file->move($path, $name);
            if (isset($request->default_image_title) && $file->getClientOriginalName() == $request->default_image_title) {
              array_push($data, ['name' => $name, 'path' => '/image', 'is_dafault' => 1]);
            } else {
              array_push($data, ['name' => $name, 'path' => '/image', 'is_dafault' => 0]);
            }
          }
      } catch (\Exception $e) {
          return back()->with('error', 'İşlem Başarısız');
      }
      $product->img_json = json_encode($data);
    }

    if (!empty($request->file('files_pdf'))) {
      try {
        $data_file = [];
        foreach($request->file('files_pdf') as $index => $file) {
          $name = date('YmdHis').rand(1, 1000).'.'.$file->extension();
          $path = public_path().'/documents';
          $file->move($path, $name);
          array_push($data_file, ['name' => $name, 'path' => '/documents']);
        }
      } catch (\Exception $e) {
        return back()->with('error', 'İşlem Başarısız');
      }
      $product->files_json = json_encode($data_file);
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

  public function search(Request $request) {

    $products = Products::where('parent_id', $request->parent_id)->where('title', 'Like', '%'.$request->word.'%')->get();
    return view('admin.products.productList')->with(['products' => $products, 'parent_id' => $request->parent_id]);

  }

}
