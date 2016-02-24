<?php

namespace TransitPro;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;

class District extends Model implements LogsActivityInterface
{
  use LogsActivity;
  protected $fillable = [
      'name', 'abbreviation', 'longitude','latitude', 'description', 'squareArea', 'elevation', 'address', 'active'
  ];
  public function locations()
    {
        return $this->hasMany('TransitPro\Location');
    }

    public function getActivityDescriptionForEvent($eventName)
    {

        if ($eventName == 'created')
        {
            return 'District "' . $this->name.' " was created';
        }

        if ($eventName == 'updated')
        {
            return 'District "' . $this->name.' " was updated';
        }

        if ($eventName == 'deleted')
        {
            return 'District "' . $this->name.' " was deleted';
        }

        return '';
    }
}
