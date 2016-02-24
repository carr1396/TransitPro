<?php

namespace TransitPro\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use TransitPro\Http\Requests;
use TransitPro\Http\Requests\StoreVehicleRequest;
use TransitPro\Http\Requests\UpdateVehicleRequest;

use TransitPro\Vehicle;

use TransitPro\Type;
use Activity;


use DB;

class VehiclesController extends Controller
{
    protected $vehicles;

    public function __construct(Vehicle $vehicles){
      $this->vehicles = $vehicles;
      parent::__construct();
    }


    public function index()
    {
        $vehicles=$this->vehicles->orderBy('type', 'desc')->with('vehicle_type')->paginate(10);
        return view('backend.admin.vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Vehicle $vehicle)
    {
        $types=Type::lists('name','id');
        return view('backend.admin.vehicles.form', compact('vehicle', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreVehicleRequest $request)
    {
        $active = $request['active'];
        if($active){
          $active=1;
        }else{
          $active=0;
        }
        $vehicle = $this->vehicles->create($request->only('type', 'color',
        'registration_number', 'capacity', 'image', 'year', 'vehicle_number',
         'model', 'make', 'route','number_plate')+array('active' => $active ));
         return redirect(route('dashboard.admin.vehicles.index'))->with('status', 'New vehicle Information Has Been Added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($type, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $types=Type::lists('name','id');
        $vehicle=$this->vehicles->with('vehicle_type')->findOrFail($id);
        return view('backend.admin.vehicles.form', compact('vehicle', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateVehicleRequest $request, $id)
    {
      $active = $request['active'];
      $booked=$request['booked'];
      if($active){
        $active=1;
      }else{
        $active=0;
      }
      if($booked){
        $booked=1;
      }else{
        $booked=0;
      }
      $vehicle=$this->vehicles->findOrFail($id);
      $vehicle->fill($request->only('type',
      'registration_number', 'capacity', 'image', 'year', 'vehicle_number','color',
       'model', 'make', 'route','number_plate', 'booking_amount')+array('active' => $active, 'booked'=>$booked ))->save();
       return redirect(route('dashboard.admin.vehicles.edit', $vehicle->id))->with('status', 'Vehicle Information Has Been Updated.');
    }
    public function assignRoute(Request $request, $id)
    {
      $vehicle=$this->vehicles->findOrFail($id);
      $route_id = $request['route'];
      $route_name = $request['route_name'];
      if($vehicle->vehicle_number){
        $gen_vehicle_number= $route_name.''.$vehicle->id;
        $vehicle->fill(array('vehicle_number' => $gen_vehicle_number, 'route' => $route_id ))->save();
      }else{
        $vehicle->fill($request->only('route'))->save();
      }
      return redirect()->back()->with('status', 'Vehicle Information Has Been Updated.');
    }
    public function assignFleet(Request $request, $id)
    {
      $vehicle=$this->vehicles->findOrFail($id);
      $route_name = $request['route_name'];
      $gen_vehicle_number= $vehicle->vehicle_number?: $route_name.''.$vehicle->id;
      if($vehicle->vehicle_number){
        $gen_length= strlen($gen_vehicle_number);
        $last_character = substr($gen_vehicle_number, $gen_length-1);
        $first_characters = substr($gen_vehicle_number, 0, $gen_length-1);
        // echo $first_characters;
        if (!preg_match("/^[a-zA-Z]$/", $last_character)) {//if not alpha
          $gen_vehicle_number = $gen_vehicle_number.'A';
        }elseif ($last_character == 'Z') {
          $gen_vehicle_number = $gen_vehicle_number;
        }else{
          $next_character = chr(ord($last_character)+1);
          $gen_vehicle_number = $first_characters.''.$next_character;
        }
      }
      $vehicle->fill(array('vehicle_number' => $gen_vehicle_number ))->save();
      return redirect()->back()->with('status', 'Vehicle Information Has Been Updated.');
    }
    public function assignDriver(Request $request, $id)
    {
      $vehicle=$this->vehicles->where('id', $id)->with('drivers')->first();
      $driver_id = $request['driver_id'];
      $isAlreadyDriver = false;
      for ($i=0; $i < count($vehicle->drivers) ; $i++) {
        if($vehicle->drivers[i]->id == $driver_id){
          $isAlreadyDriver=true;
          break;
        }
      }
      if(!$isAlreadyDriver){
        $vehicle->drivers()->attach($driver_id);
        Activity::log('Driver '.$request['driver_id']. ' Attached To '.$vehicle->number_plate);
      }
      // $vehicle->fill(array('driver_id' => $driver_id, 'vehicle_id' => $vehicle->id ))->save();
      return redirect()->back()->with('status', 'Vehicle Information Has Been Updated.');
    }
    public function deattachDriver(Request $request, $id)
    {
      $vehicle=$this->vehicles->where('id', $id)->with('drivers')->first();
      $driver_id = $request['driver_id'];
      $vehicle->drivers()->detach($driver_id);
      Activity::log('Driver '.$request['driver_id']. ' Detached From '.$vehicle->number_plate);
      // $vehicle->fill(array('driver_id' => $driver_id, 'vehicle_id' => $vehicle->id ))->save();
      return redirect()->back()->with('status', 'Vehicle Information Has Been Updated.');
    }
    public function confirm($id){
      $vehicle=$this->vehicles->findOrFail($id);
      return view('backend.admin.vehicles.confirm', compact('vehicle'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $vehicle=$this->vehicles->findOrFail($id);
      $name=$vehicle->number_plate;
      $vehicle->delete();
      return redirect(route('dashboard.admin.vehicles.index'))->with('status', 'Vehicle '. $name.' Has Been Deleted');
    }
}
