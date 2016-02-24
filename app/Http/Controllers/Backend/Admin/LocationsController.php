<?php

namespace TransitPro\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use TransitPro\Http\Requests;
use TransitPro\Location;
use TransitPro\District;

class LocationsController extends Controller
{
  protected $locations;

  public function __construct(Location $location){
    $this->locations = $location;
    parent::__construct();
  }
  public function index()
  {
    $locations= $this->locations->all();
    return view('backend.admin.locations.index', compact('locations'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create(Location $location)
  {
    $districts=District::lists('name','id');
    return view('backend.admin.locations.form', compact('location', 'districts'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Requests\StoreLocationRequest $request)
  {
    $location=$this->locations->create($request->only('name', 'longitude','latitude', 'description', 'district_id', 'address'));
    return redirect(route('dashboard.admin.locations.index'))->with('status', 'New location Has Been Created.');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
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
    $location=$this->locations->findOrFail($id);
    $districts=District::lists('name','id');
    return view('backend.admin.locations.form', compact('location', 'districts'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Requests\UpdateLocationRequest $request, $id)
  {
    $location=$this->locations->findOrFail($id);
    $location->fill($request->only('name', 'longitude','latitude', 'description', 'district_id', 'address'))->save();

    return redirect(route('dashboard.admin.locations.edit', $location->id))->with('status', $location->name.' location Has Been Updated');
  }

  public function confirm($id)
  {
      $location=$this->locations->findOrFail($id);
      return view('backend.admin.locations.confirm', compact('location'));
  }
  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $location=$this->locations->findOrFail($id);
     $name=$location->name;
    $location->delete();
    return redirect(route('dashboard.admin.locations.index'))->with('status', 'location '. $name.' Has Been Deleted');
  }
}
