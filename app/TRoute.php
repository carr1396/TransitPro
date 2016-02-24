<?php

namespace TransitPro;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;

class TRoute extends Model implements LogsActivityInterface
{
  use LogsActivity;

  protected $table ='routes';
  protected $fillable = [
    'name', 'start_location', 'end_location','expectedDuration', 'active'
  ];
  public function start()
  {
    return $this->belongsTo('TransitPro\Location', 'start_location')->with('district');
  }
  public function end()
  {
    return $this->belongsTo('TransitPro\Location', 'end_location')->with('district');
  }
  public function getActivityDescriptionForEvent($eventName)
  {

      if ($eventName == 'created')
      {
          return 'Transit Route "' . $this->name.' " was created';
      }

      if ($eventName == 'updated')
      {
          return 'Transit Route "' . $this->name.' " was updated';
      }

      if ($eventName == 'deleted')
      {
          return 'Transit Route "' . $this->name.' " was deleted';
      }

      return '';
  }
}
