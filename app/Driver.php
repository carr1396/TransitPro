<?php

namespace TransitPro;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;
use TransitPro\User;
use TransitPro\Vehicle;

class Driver extends Model  implements LogsActivityInterface
{
  use LogsActivity;

  protected $fillable = [
      'user_id', 'active', 'license'
  ];
  public function user(){
    // return $this->belongsTo(User::class); //used if key isnamed <name>_id
    return $this->belongsTo(User::class);
  }
  public function vehicles(){
    // return $this->belongsTo(User::class); //used if key isnamed <name>_id
    return $this->belongsToMany(Vehicle::class);
  }

  public function getActivityDescriptionForEvent($eventName)
  {

      if ($eventName == 'created')
      {
          return 'Driver "' . $this->id.' " was created';
      }

      if ($eventName == 'updated')
      {
          return 'Driver "' . $this->id.' " was updated';
      }

      if ($eventName == 'deleted')
      {
          return 'Driver "' . $this->id.' " was deleted';
      }

      return '';
  }

}
