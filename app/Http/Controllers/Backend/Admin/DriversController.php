<?php

namespace TransitPro\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use TransitPro\Http\Requests;
use TransitPro\Http\Requests\StoredriverRequest;
use TransitPro\Driver;
use TransitPro\User;

class DriversController extends Controller
{
  protected $drivers;

   public function __construct(Driver $driver){
     $this->drivers = $driver;
     parent::__construct();
   }


     public function index()
     {
         $drivers=$this->drivers->with('user')->paginate(10);
         return view('backend.admin.drivers.index', compact('drivers'));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(driver $driver)
    {
        $users = array();
        foreach ( User::all() as $user) {
          if($user->hasRole('staff') && !$user->isAdmin()){
            array_push($users, $user);
          }
        }

        return view('backend.admin.drivers.form', compact('driver', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreDriverRequest $request)
    {
      $driver=$this->drivers->create($request->only('user_id', 'license'));
      return redirect(route('dashboard.admin.drivers.index'))->with('status', 'New driver Has Been Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect(route('dashboard.admin.driver.edit', $id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $users = array();
      foreach ( User::all() as $user) {
        if($user->hasRole('staff') && !$user->isAdmin()){
          array_push($users, $user);
        }
      }
      $driver=$this->drivers->findOrFail($id);
      return view('backend.admin.drivers.form', compact('driver', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateDriverRequest $request, $id)
    {
      $driver=$this->drivers->findOrFail($id);
      $driver->fill($request->only('user_id', 'license', 'active'))->save();
      return redirect(route('dashboard.admin.drivers.edit', $driver->id))->with('status', $driver->name.' driver Has Been Updated');
    }

    public function confirm($id){
      $driver=$this->drivers->findOrFail($id);
      return view('backend.admin.drivers.confirm', compact('driver'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $driver=$this->drivers->findOrFail($id);
      $name=$driver->id;
      $driver->delete();
      return redirect(route('dashboard.admin.drivers.index'))->with('status', 'driver '. $name.' Has Been Deleted');
    }
}
