<?php

namespace TransitPro;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;
use TransitPro\Driver;
use TransitPro\User;

class Vehicle extends Model implements LogsActivityInterface {

  use PresentableTrait, LogsActivity;

  protected $presenter = 'TransitPro\Presenters\VehiclePresenter';
  protected $table='vehicles';
  protected $fillable =['type', 'registration_number', 'capacity', 'image', 'year', 'vehicle_number', 'model', 'make', 'route','number_plate', 'active', 'booking_amount', 'booked'];

  protected $dates=['updated_at','created_at'];
  public function vehicle_type(){
    // return $this->belongsTo(User::class); //used if key isnamed <name>_id
    return $this->belongsTo(Type::class, 'type');
  }
  public function drivers(){
    // return $this->belongsTo(User::class); //used if key isnamed <name>_id
    return $this->belongsToMany(Driver::class)->with('user');
  }
  public function vehicle_route(){
    // return $this->belongsTo(User::class); //used if key isnamed <name>_id
    return $this->belongsTo(TRoute::class, 'route');
  }
  public function getActivityDescriptionForEvent($eventName)
  {
      if ($eventName == 'created')
      {
          return 'Vehicle "' . $this->number_plate . '" was created';
      }

      if ($eventName == 'updated')
      {
          return 'Vehicle "' . $this->number_plate . '" was updated';
      }

      if ($eventName == 'deleted')
      {
          return 'Vehicle "' . $this->number_plate . '" was deleted';
      }

      return '';
  }
}
