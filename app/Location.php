<?php

namespace TransitPro;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;

class Location extends Model implements LogsActivityInterface
{
  use LogsActivity;
  protected $fillable = [
      'name',  'longitude','latitude', 'description',  'address', 'district_id'
  ];
  public function district()
  {
    return $this->belongsTo('TransitPro\District');
  }
  public function getActivityDescriptionForEvent($eventName)
  {

      if ($eventName == 'created')
      {
          return 'Location "' . $this->name. ' " was created';
      }

      if ($eventName == 'updated')
      {
          return 'Location "' . $this->name. ' " was updated';
      }

      if ($eventName == 'deleted')
      {
          return 'Location "' . $this->name. ' " was deleted';
      }

      return '';
  }
}
