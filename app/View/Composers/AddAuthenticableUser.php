<?php
 namespace TransitPro\View\Composers;


 use Illuminate\View\View;
 use Illuminate\Contracts\Auth\Guard;

 class AddAuthenticableUser{
   protected $auth;
   public function __construct(Guard $auth){
     $this->auth=$auth;
   }
   public function compose(View $view){
    //  dd($this->auth->user());
     $view->with('user', $this->auth->user());
   }
 }
