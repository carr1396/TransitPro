<?php

namespace TransitPro;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;

class Post extends Model implements LogsActivityInterface
{
  
  use PresentableTrait , LogsActivity;
  protected $presenter = 'TransitPro\Presenters\PostPresenter';

  protected $fillable = [
      'title', 'slug', 'author', 'body', 'published_at', 'excerpt'
  ];
  protected $dates =['published_at'];//will make eloquent treat this as a date so as it is automatically seen as a carbon  instance

  public function setPublishedAtAttribute($value){
    $this->attributes['published_at'] = $value ? $value :null;
  }
  // https://laravel.com/docs/5.2/eloquent-relationships
  public function authored(){
    // return $this->belongsTo(User::class); //used if key isnamed <name>_id
    return $this->belongsTo(User::class, 'author');
  }
  public function getActivityDescriptionForEvent($eventName)
  {

      if ($eventName == 'created')
      {
          return 'Post "' . $this->title.'" was created';
      }

      if ($eventName == 'updated')
      {
          return 'Post "' . $this->title.'" was updated';
      }

      if ($eventName == 'deleted')
      {
          return 'Post "' . $this->title.'" was deleted';
      }

      return '';
  }
}
