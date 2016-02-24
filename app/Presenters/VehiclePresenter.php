<?php
namespace TransitPro\Presenters;

use Laracasts\Presenter\Presenter;
use League\CommonMark\CommonMarkConverter;

class VehiclePresenter extends Presenter {
  public function displayName(){
    $number = $this->number_plate;
    if ($this->vehicle_number) {
      $number=$this->vehicle_number;
    }

    return ''.$this->vehicle_type->name.'( '.$number.' )';
  }
}
