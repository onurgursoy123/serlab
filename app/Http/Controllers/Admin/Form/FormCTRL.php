<?php

namespace App\Http\Controllers\Admin\Form;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\MailSender;

use App\Models\Pages;
use App\Models\Sales;
use App\Models\DeviceOffer;
use App\Models\ServiceRequest;

class FormCTRL extends \App\Http\Controllers\Controller
{

  public function index() {

    $serviceRequest = Pages::where('path', 'admin.form.serviceRequest.mail')->first();
    $deviceOffer = Pages::where('path', 'admin.form.deviceOffer.mail')->first();
    return view('admin.form.form')->with(['serviceRequestMail' => $serviceRequest->description, 'deviceOfferMail' => $deviceOffer->description]);
  }

  public function mailAddress(Request $request) {
    $request->validate([
      'mail' => 'required',
      'type' => 'required'
    ]);


    if ($request->type == 0) {
      $page = Pages::where('path', 'admin.form.serviceRequest.mail')->first();
      $page->description = $request->mail;
  
      if ($page->update()) return back()->with('success', 'İşlem Başarılı');
  
      return back()->with('error', 'İşlem Başarısız');
    
    } else if ($request->type == 1) {
      $page = Pages::where('path', 'admin.form.deviceOffer.mail')->first();
      $page->description = $request->mail;
  
      if ($page->update()) return back()->with('success', 'İşlem Başarılı');
  
      return back()->with('error', 'İşlem Başarısız');

    } else {
      return back()->with('error', 'İşlem Başarısız');

    }

  }

}
