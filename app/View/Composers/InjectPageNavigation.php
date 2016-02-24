<?php
 namespace TransitPro\View\Composers;

 use Illuminate\View\View;

 use TransitPro\Page;

 class InjectPageNavigation{
   protected $pages;

   public function __construct(Page $pages){
     $this->pages = $pages;
   }
   public function compose(View $view){
    //  $pages = $this->pages->all()->toHierarchy();
    $pages = $this->pages->where('hidden', false)->get()->toHierarchy();
     $view->with('pages', $pages);
   }
 }
