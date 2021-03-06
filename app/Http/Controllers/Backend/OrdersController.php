<?php

namespace TransitPro\Http\Controllers\Backend;

use Illuminate\Http\Request;

use TransitPro\Http\Requests;
use Auth;
use Input;
use TransitPro\Order;
use TransitPro\Vehicle;

class OrdersController extends Controller
{

  protected $orders;


  public function __construct(Order $orders){
    $this->orders = $orders;
    parent::__construct();
  }
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $orders=$this->orders->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->with('user')->with('vehicle')->paginate(10);
    return view('backend.orders.index', compact('orders'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    //
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Requests\CreateOrderRequest $request)
  {
    $vehicle=Vehicle::findOrFail($request['vehicle_id']);
    if ($vehicle) {
      if ($vehicle->booked) {
        return redirect()->back()->with('status', 'Vehicle Already Booked');
      } else {
        $vehicle->fill($request->only('booked'))->save();
        $order=$this->orders->create($request->only('user_id', 'amount', 'vehicle_id',
        'start', 'end', 'booked', 'remarks', 'phone', 'phone2', 'address', 'address2'));
        return redirect(route('account.orders.index'))->with('status', 'You Have Created A New Vehicle Booking.');
      }
    } else {
      return redirect()->back()->with('status', 'Vehicle Could Not Be Found');
    }

  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $order=$this->orders->where('id', $id)->with('user')->with('vehicle')->first();
    return view('backend.orders.show', compact('order'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Requests\CreateOrderRequest $request, $id)
  {
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $order=$this->orders->where('id', $id)->with('user')->with('vehicle')->first();

    if($order){
      if(Auth::user()->id != $order->user->id || !Auth::user()->isAdmin()){
        return redirect()->back()->withErrors([
          'error' =>'You DO Not Have Permission To Delete This Order'
        ]);
      }else{
        $vehicle=Vehicle::findOrFail($order->vehicle_id);
        if($vehicle){
          $vehicle->fill(array('booked'=>0))->save();
        }
        $order->delete();
        return redirect()->back()->with('status', 'Vehicle Has Been Deleted');
      }
    }else{
      return redirect()->back()->withErrors([
        'error' =>'Order Not Found'
      ]);
    }
  }
}
