<?php

namespace TransitPro;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;
use TransitPro\User;
use TransitPro\Vehicle;

class Order extends Model  implements LogsActivityInterface
{
  use LogsActivity;

  protected $fillable = ['active', 'paid', 'user_id', 'amount', 'vehicle_id',
   'start', 'end', 'booked', 'pending', 'remarks', 'phone', 'phone2', 'address', 'address2'];
  protected $dates =['start', 'end'];
  public function user(){
    // return $this->belongsTo(User::class); //used if key isnamed <name>_id
    return $this->belongsTo(User::class);
  }
  public function vehicle(){
    // return $this->belongsTo(User::class); //used if key isnamed <name>_id
    return $this->belongsTo(Vehicle::class);
  }
  public function getActivityDescriptionForEvent($eventName)
  {

      if ($eventName == 'created')
      {
          return 'Order "' . $this->id.' " was uploaded';
      }

      if ($eventName == 'updated')
      {
          return 'Order "' . $this->id.' " was updated';
      }

      if ($eventName == 'deleted')
      {
          return 'Order "' . $this->id.' " was deleted';
      }

      return '';
  }
}
