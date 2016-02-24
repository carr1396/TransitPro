<?php

namespace TransitPro\Http\Controllers;

use Illuminate\Http\Request;

use TransitPro\Http\Requests;
use Mail;
use TransitPro\Http\Controllers\Controller;

class MessagesController extends Controller
{
  public function messageDriver(Request $request)
  {

    $sender = $request['sender'];
    $email = $request['email'];
    Mail::raw($request['body'], function ($m) use ($request) {
            $m->from('carr1396@gmail.com', 'TransitPro');
            $m->to($request['email'], $request['name'])->subject('Message From Customer');
        });
    return redirect()->back()->with('status', 'Vehicle Information Has Been Updated.');
  }
}
