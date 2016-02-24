<?php
namespace TransitPro\Templates;
use Illuminate\View\View;
use TransitPro\Vehicle;
use TransitPro\TRoute;
use TransitPro\Driver;
use Carbon\Carbon;

class VehicleShowTemplate extends AbstractTemplate
{

  protected $view='vehicles.show';

  protected $vehicles;

  public function __construct(Vehicle $vehicles){
    $this->$vehicles = $vehicles;
  }
  public function prepare(View $view, array $paramaters){
    $vehicle= Vehicle::with('vehicle_type')->with('vehicle_route')->with('drivers')->where('id', $paramaters['id'])->first();
    $drivers=Driver::with('user')->get();
    $troutes= TRoute::with('start')->with('end')->get();
    $view->with(array('vehicle'=> $vehicle,  'troutes'=>$troutes, 'drivers'=>$drivers));
  }

}
