<?php
  namespace TransitPro\Presenters;
  use Laracasts\Presenter\Presenter;
  use League\CommonMark\CommonMarkConverter;

  class PagePresenter extends Presenter {

    protected $markdown;
    public function __construct($entity){
      $this->markdown = new CommonMarkConverter();
      parent::__construct($entity);
    }
    public function prettyUri(){

      return '/'.ltrim($this->uri, '/');
    }

    public function contentHTML(){
      return $this->markdown->convertToHtml($this->content);
    }

    public function linkToPaddedTitle($link){
      $padding = str_repeat('&gt;', $this->depth*4);
      return $padding.link_to($link, $this->title);
    }
    // public function paddedTitle(){
    //   return  str_repeat('-', $this->depth*4).$this->title;
    // }

    public function uriWildcard(){
      return $this->uri.'*';
    }

  }
