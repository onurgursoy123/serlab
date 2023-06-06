<?php

namespace App\Http\Controllers\Comments;

use Illuminate\Http\Request;

use App\Models\Comments;

class CommentsCTRL extends \App\Http\Controllers\Controller
{
  public function index() {
    return "comments";
  }

  public function store(Request $request) {
    
    $request->validate([
      // 'product_id' => ['required', 'integer'],
      'name' => ['required', 'string'],
      'email' => 'required|email',
      'contents' => ['required', 'string'],
    ]);

    $comment = new Comments();
    
    if (!empty($request->product_id))
      $comment->product_id = $request->product_id;
    else if (!empty($request->blog_id))
      $comment->blog_id = $request->blog_id;
    else if (!empty($request->weLearn_id))
      $comment->weLearn_id = $request->weLearn_id;
    else
      return back()->with('error', 'İşlem Başarısız');

    $comment->name = $request->name;
    $comment->email = $request->email;
    $comment->contents = $request->contents;

    if ($comment->save()) {
      return back()->with('success', 'İşlem Başarılı');
    }
    return back()->with('error', 'İşlem Başarısız');
  }

  public function destroy() {
    return "destroy";
  }

}
