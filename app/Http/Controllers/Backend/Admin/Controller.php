<?php

namespace TransitPro\Http\Controllers\Backend\Admin;


use TransitPro\Http\Controllers\Backend\Controller as BaseController;


class Controller extends BaseController
{
  public function __construct(){
    $this->middleware('admin');
    parent::__construct();
  }


}
