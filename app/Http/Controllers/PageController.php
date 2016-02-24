<?php

namespace TransitPro\Http\Controllers;

use Illuminate\Http\Request;

use TransitPro\Http\Requests;
use TransitPro\Http\Controllers\Controller;
use TransitPro\Page;
use Illuminate\Contracts\Auth\Guard;

class PageController extends Controller
{

    public function show(Page $page, array $parameters){

      $this->prepareTemplate($page, $parameters);
      return view('page', compact('page'));
    }
    protected function prepareTemplate(Page $page, array $parameters){
      $templates = config('pro.templates');
      if(!$page->template || !(isset($templates[$page->template]))){
        return;
      }
      $template= app($templates[$page->template]);//get instance of template
      $view = sprintf('templates.%s', $template->getView());//get view name

      if(!view()->exists($view)){//checlk if view exists
        return;
      }
      $template->prepare($view = view($view), $parameters);
       $page->view = $view;
    }
}
