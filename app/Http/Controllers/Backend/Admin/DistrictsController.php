<?php

namespace TransitPro\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use TransitPro\Http\Requests;
use TransitPro\District;

class DistrictsController extends Controller
{
  protected $districts;

  public function __construct(District $district){
    $this->districts = $district;
    parent::__construct();
  }
  public function index()
  {
    $districts= $this->districts->all();
    return view('backend.admin.districts.index', compact('districts'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create(District $district)
  {
    return view('backend.admin.districts.form', compact('district'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Requests\StoreDistrictRequest $request)
  {
    $district=$this->districts->create($request->only('name', 'abbreviation', 'longitude','latitude', 'description', 'squareArea', 'elevation', 'address'));
    return redirect(route('dashboard.admin.districts.index'))->with('status', 'New district Has Been Created.');
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
    $district=$this->districts->findOrFail($id);
    return view('backend.admin.districts.form', compact('district'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Requests\UpdateDistrictRequest $request, $id)
  {
    $district=$this->districts->findOrFail($id);
    $district->fill($request->only('name', 'abbreviation', 'longitude','latitude', 'description', 'squareArea', 'elevation', 'address', 'active'))->save();

    return redirect(route('dashboard.admin.districts.edit', $district->id))->with('status', $district->name.' district Has Been Updated');
  }

  public function confirm($id)
  {
      $district=$this->districts->findOrFail($id);
      return view('backend.admin.districts.confirm', compact('district'));
  }
  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $district=$this->districts->findOrFail($id);
     $name=$district->title;
    $district->delete();
    return redirect(route('dashboard.admin.districts.index'))->with('status', 'District '. $name.' Has Been Deleted');
  }
}
