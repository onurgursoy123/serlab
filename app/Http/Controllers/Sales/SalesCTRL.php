<?php

namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Models\Sales;
use App\Models\Pages;
use App\Mail\MailSender;

class SalesCTRL extends \App\Http\Controllers\Controller
{
  public function index() {
    return view('sales.sales');
  }
  
  public function sendFormUsingMail(Request $request) {

    // dispatch(new SendEmail());

    /*
    $sale = Sales::find(1);
    if (!empty($sale)) {
        try {
            Mail::to("vvee77ss@gmail.com")->queue(new MailSender($sale));

        } catch(Exception $e) {
            dd($e->getMessage());
            
        }
    }
    return "T";

    $mailData = Sales::find(1);
    return view('mail.salesMail')->with('mailData', $mailData);
    */
    /*
    try {
      Mail::to('vvee77ss@gmail.com')->send(new MailSender());
    } catch(Exception $e) {
      dd($e->getMessage());
    }
    */

    // dispatch(new SendEmail());

    $request->validate([
      'name' => ['required', 'string'],
      'surname' => ['required', 'string'],
      'phone' => ['required', 'integer'],
      'mail' => ['required', 'string'],
      'deviceType' => ['required', 'string'],
      'brand' => ['required', 'string'],
      'modelNo' => ['required', 'string'],
      'serialNo' => ['required', 'string'],
      'description' => ['required', 'string'],
      'address' => ['required', 'string'],
      'city' => ['required', 'string'],
      'approval' => ['required', 'string'],
    ]);

    $saleForm = new Sales();
    $saleForm->name = $request->name;
    $saleForm->surname = $request->surname;
    $saleForm->phone = $request->phone;
    $saleForm->mail = $request->mail;
    $saleForm->deviceType = $request->deviceType;
    $saleForm->brand = $request->brand;
    $saleForm->modelNo = $request->modelNo;
    $saleForm->serialNo = $request->serialNo;
    $saleForm->description = $request->description;
    $saleForm->address = $request->address;
    $saleForm->city = $request->city;

    if ($request->file('files')) {
      try {
        $data = [];
        foreach($request->file('files') as $ind => $file) {
          if ($ind == 4) break;
          $name = date('YmdHis').rand(1, 1000).'.'.$file->extension();
          $path = public_path().'/temp';
          $file->move($path, $name);
          array_push($data, ['name' => $name, 'path' => "/temp"]);
        }
      } catch (\Exception $e) {
        return $e->getMessage();
      }
      $saleForm->files_json = json_encode($data);
    }

    if ($saleForm->save()) {

      $page = Pages::where('path', 'admin.sales.mail')->first();
      Mail::to($page->description)->send(new MailSender($saleForm, 1));
      $saleForm->is_send = 1;
      $saleForm->update();

      return back()->with('success', 'İşlem Başarılı');
    }

    return back()->with('error', 'İşlem Başarısız');
  }

}
