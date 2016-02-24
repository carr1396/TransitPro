<?php
  namespace TransitPro\Templates;
  use Illuminate\View\View;

  abstract class AbstractTemplate{

    protected $view;

    abstract public function prepare(View $view, array $paramaters);

    public function getView(){
      return $this->view;
    }
  }
