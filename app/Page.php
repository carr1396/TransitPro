<?php

namespace TransitPro;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Baum\Node;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;

class Page extends Node implements LogsActivityInterface
{
  use PresentableTrait, LogsActivity;
  protected $presenter = 'TransitPro\Presenters\PagePresenter';
  protected $fillable = [
      'title', 'name', 'uri', 'content', 'template', 'parent_id', 'lft', 'rgt', 'depth', 'hidden'
  ];

  public function setNameAttribute($value){
    $this->attributes['name'] = $value ? $value :null;
  }
  public function setHiddenAttribute($value){
    $this->attributes['hidden'] = $value? $value :0;
  }
  public function setTemplateAttribute($value){
    $this->attributes['template'] = $value ?:null;
  }
  public function updateOrder($order, $orderPage){
    $orderPage =$this->findOrFail($orderPage);
    if($order =='before'){
      $this->moveToLeftOf($orderPage);
    }elseif($order =='after'){
      $this->moveToRightOf($orderPage);
    }elseif($order =='childOf'){
      $this->makeChildOf($orderPage);
    }
  }

  public function getPaddedTitleAttribute(){//move this code to presenter lateron
    return  str_repeat('&gt;', $this->depth*4).' '.$this->title;
  }
  public function getActivityDescriptionForEvent($eventName)
  {

      if ($eventName == 'created')
      {
          return 'Permission "' . $this->title.' " was created';
      }

      if ($eventName == 'updated')
      {
          return 'Permission "' . $this->title.' " was updated';
      }

      if ($eventName == 'deleted')
      {
          return 'Permission "' . $this->title.' " was deleted';
      }

      return '';
  }
}
