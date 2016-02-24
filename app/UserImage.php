<?php

namespace TransitPro;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;
use TransitPro\User;

class UserImage extends Model  implements LogsActivityInterface
{
  use LogsActivity;

  protected $fillable = ['is_active', 'is_featured', 'user_id', 'attribution', 'name', 'path', 'extension', 'mobile_image_name', 'mobile_image_path', 'mobile_extension'];
  public function user(){
    // return $this->belongsTo(User::class); //used if key isnamed <name>_id
    return $this->belongsTo(User::class);
  }
  public function getActivityDescriptionForEvent($eventName)
  {

      if ($eventName == 'created')
      {
          return 'Image "' . $this->id.' " was uploaded';
      }

      if ($eventName == 'updated')
      {
          return 'Image "' . $this->id.' " was updated';
      }

      if ($eventName == 'deleted')
      {
          return 'Image "' . $this->id.' " was deleted';
      }

      return '';
  }
}
