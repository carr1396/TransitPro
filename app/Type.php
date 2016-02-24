<?php

namespace TransitPro;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;//http://packalyst.com/packages/package/spatie/activitylog

class Type extends Model implements LogsActivityInterface {

    use LogsActivity;
    protected $table='vehicle_types';
    protected $fillable = [
        'name', 'description'
    ];
    /**
     * Get the message that needs to be logged for the given event name.
     *
     * @param string $eventName
     * @return string
     */
    public function getActivityDescriptionForEvent($eventName)
    {
        if ($eventName == 'created')
        {
            return 'Vehicle Type "' . $this->name . '" was created';
        }

        if ($eventName == 'updated')
        {
            return 'Vehicle Type "' . $this->name . '" was updated';
        }

        if ($eventName == 'deleted')
        {
            return 'Vehicle Type "' . $this->name . '" was deleted';
        }

        return '';
    }
}
