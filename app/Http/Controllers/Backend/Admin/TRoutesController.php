<?php

namespace TransitPro\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use TransitPro\Http\Requests;
use TransitPro\Location;
use TransitPro\District;
use TransitPro\TRoute;

class TRoutesController extends Controller
{
  protected $troutes;

  public function __construct(TRoute $troutes){
    $this->troutes = $troutes;
    parent::__construct();
  }
  public function index()
  {
    $troutes= $this->troutes->with('start')->with('end')->get();
    return view('backend.admin.troutes.index', compact('troutes'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create(troute $troute)
  {
    $locations=Location::lists('name','id');
    return view('backend.admin.troutes.form', compact('troute', 'locations'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Requests\StoretrouteRequest $request)
  {
    $troute=$this->troutes->create($request->only('name', 'start_location', 'end_location','expectedDuration'));
    return redirect(route('dashboard.admin.troutes.index'))->with('status', 'New troute Has Been Created.');
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
    $troute=$this->troutes->findOrFail($id);
    $locations=Location::lists('name','id');
    return view('backend.admin.troutes.form', compact('troute', 'locations'));
  }



  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Requests\UpdatetrouteRequest $request, $id)
  {
    $troute=$this->troutes->findOrFail($id);
    $troute->fill($request->only('name', 'start_location', 'end_location','expectedDuration', 'active'))->save();

    return redirect(route('dashboard.admin.troutes.edit', $troute->id))->with('status', $troute->name.' troute Has Been Updated');
  }
  
  public function confirm($id)
  {
      $troute=$this->troutes->findOrFail($id);
      return view('backend.admin.troutes.confirm', compact('troute'));
  }
  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $troute=$this->troutes->findOrFail($id);
     $name=$troute->name;
    $troute->delete();
    return redirect(route('dashboard.admin.troutes.index'))->with('status', 'troute '. $name.' Has Been Deleted');
  }
}
