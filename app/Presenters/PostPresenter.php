<?php
namespace TransitPro\Presenters;

use Laracasts\Presenter\Presenter;
use League\CommonMark\CommonMarkConverter;

class PostPresenter extends Presenter {

  protected $markdown;
  public function __construct($entity){
    $this->markdown = new CommonMarkConverter();
    parent::__construct($entity);
  }
   public function excerptHtml(){
     return $this->excerpt ? $this->markdown->convertToHtml($this->excerpt):null;
   }
   public function bodyHtml(){
     return $this->body ? $this->markdown->convertToHtml($this->body):null;
   }
  public function publishedDate(){
    if($this->published_at){
      return $this->published_at->toFormattedDateString();
    }
    return 'Not Published';
  }
  public function publishedHighlight(){
    if($this->published_at && $this->published_at->isFuture()){
      return 'info';
    }elseif(!$this->published_at){
      return 'warning';
    }
  }
}
