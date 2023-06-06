<?php

namespace App\Http\Controllers\Form;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

use App\Mail\MailSender;

use App\Models\ServiceRequest;
use App\Models\DeviceOffer;
use App\Models\Pages;


class FormCTRL extends \App\Http\Controllers\Controller
{
  public function index() {
    return view('form.form');
  }

  public function sendFormUsingMail(Request $request) {
    
    $request->validate([
      'type' => ['required'],
    ]);

    if ($request->type == 0) {

      $request->validate([
        'name' => ['required', 'string'],
        'surname' => ['required', 'string'],
        'task' => ['required', 'string'],
        'companyName' => ['required', 'string'],
        'department' => ['required', 'string'],
        'phone' => ['required', 'string'],
        'mail' => ['required', 'string'],
        'desiredService' => ['required', 'string'],
        'serviceDetail' => ['required', 'string'],
        'deviceType' => ['required', 'string'],
        'brand' => ['required', 'string'],
        'modelNo' => ['required', 'string'],
        'serialNo' => ['required', 'string'],
        'description' => ['required', 'string'],
        'address' => ['required', 'string'],
        'city' => ['required', 'string'],
        'approval1' => ['required', 'string'],
      ]);

      $serviceRequest = new ServiceRequest();
      $serviceRequest->name = $request->name;
      $serviceRequest->surname = $request->surname;
      $serviceRequest->task = $request->task;
      $serviceRequest->companyName = $request->companyName;
      $serviceRequest->department = $request->department;
      $serviceRequest->phone = $request->phone;
      $serviceRequest->mail = $request->mail;
      $serviceRequest->desiredService = $request->desiredService;
      $serviceRequest->serviceDetail = $request->serviceDetail;
      $serviceRequest->deviceType = $request->deviceType;
      $serviceRequest->brand = $request->brand;
      $serviceRequest->modelNo = $request->modelNo;
      $serviceRequest->serialNo = $request->serialNo;
      $serviceRequest->description = $request->description;
      $serviceRequest->address = $request->address;
      $serviceRequest->city = $request->city;

      if ($serviceRequest->save()) {

        $page = Pages::where('path', 'admin.sales.mail')->first();
        Mail::to($page->description)->send(new MailSender($serviceRequest, 2));
        $serviceRequest->is_send = 1;
        $serviceRequest->update();

        return back()->with('success', 'İşlem Başarılı');
      }
      return back()->with('error', 'İşlem Başarısız');
    
    } else if ($request->type == 1) {
      
      $request->validate([
        'name' => ['required', 'string'],
        'surname' => ['required', 'string'],
        'phone' => ['required', 'string'],
        'mail' => ['required', 'string'],
        'city' => ['required', 'string'],
        'companyName' => ['required', 'string'],
        'department' => ['required', 'string'],
        'task' => ['required', 'string'],
        'desiredDevice' => ['required', 'string'],
        'approval2' => ['required', 'string'],
      ]);

      $deviceOffer = new DeviceOffer();
      $deviceOffer->name = $request->name;
      $deviceOffer->surname = $request->surname;
      $deviceOffer->phone = $request->phone;
      $deviceOffer->mail = $request->mail;
      $deviceOffer->city = $request->city;
      $deviceOffer->companyName = $request->companyName;
      $deviceOffer->department = $request->department;
      $deviceOffer->task = $request->task;
      $deviceOffer->desiredDevice = $request->desiredDevice;

      if ($deviceOffer->save()) {

        $page = Pages::where('path', 'admin.form.deviceOffer.mail')->first();
        Mail::to($page->description)->send(new MailSender($deviceOffer, 3));
        $deviceOffer->is_send = 1;
        $deviceOffer->update();

        return back()->with('success', 'İşlem Başarılı');
      }
      
      return back()->with('error', 'İşlem Başarısız');

    }

    return back()->with('error', 'İşlem Başarısız');
    
  }
  
}
