<?php
 namespace TransitPro\View;
 use Illuminate\View\FileViewFinder;

 class ProThemeViewFinder extends FileViewFinder
 {
   protected $activeTheme;
   protected $basePath;

   public function setBasePath($path){
    $this->basePath=$path;

   }
   public function setActiveTheme($theme){
     $this->activeTheme=$theme;

     array_unshift($this->paths, $this->basePath.'/'.$theme.'/views');//cascade through all paths
   }
 }
