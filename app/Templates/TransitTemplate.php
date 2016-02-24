<?php
  namespace TransitPro\Templates;
  use Illuminate\View\View;
  use TransitPro\Vehicle;
  use Carbon\Carbon;

  class TransitTemplate extends AbstractTemplate
  {

    protected $view='vehicles.index';

    protected $vehicles;

    public function __construct(Vehicle $vehicles){
      $this->vehicles = $vehicles;
    }
    public function prepare(View $view, array $paramaters){

      $vehicles= Vehicle::with('vehicle_type')
                ->where('active', '=', 1)
                ->orderBy('updated_at', 'desc')
                        ->paginate(10);
      $view->with('vehicles', $vehicles);
    }

  }
