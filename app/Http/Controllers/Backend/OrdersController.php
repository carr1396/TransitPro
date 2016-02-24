<?php

namespace TransitPro\Http\Controllers\Backend;

use Illuminate\Http\Request;

use TransitPro\Http\Requests;

use TransitPro\Order;

use DB;

class OrdersController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function getIndex(Request $request)
	{
	    return view('orders.index', []);
	}

	public function getAdd(Request $request)
	{
	    return view('orders.add', [
	        []
	    ]);
	}

	public function getUpdate(Request $request, $id)
	{
		$order = Order::findOrFail($id);
	    return view('orders.add', [
	        'model' => $order	    ]);
	}

	public function getShow(Request $request, $id)
	{
		$order = Order::findOrFail($id);
	    return view('orders.show', [
	        'model' => $order	    ]);
	}

	public function getGrid(Request $request)
	{
		$len = $_GET['length'];
		$start = $_GET['start'];

		$select = "SELECT *,1,2 ";
		$presql = " FROM orders a ";
		if($_GET['search']['value']) {
			$presql .= " WHERE user_id LIKE '%".$_GET['search']['value']."%' ";
		}

		$presql .= "  ";

		$sql = $select.$presql." LIMIT ".$start.",".$len;


		$qcount = DB::select("SELECT COUNT(a.id) c".$presql);
		//print_r($qcount);
		$count = $qcount[0]->c;

		$results = DB::select($sql);
		$ret = [];
		foreach ($results as $row) {
			$r = [];
			foreach ($row as $value) {
				$r[] = $value;
			}
			$ret[] = $r;
		}

		$ret['data'] = $ret;
		$ret['recordsTotal'] = $count;
		$ret['iTotalDisplayRecords'] = $count;

		$ret['recordsFiltered'] = count($ret);
		$ret['draw'] = $_GET['draw'];

		echo json_encode($ret);

	}


	public function postSave(Request $request) {
	    //
	    /*$this->validate($request, [
	        'name' => 'required|max:255',
	    ]);*/
		$order = null;
		if($request->id > 0) { $order = Order::findOrFail($request->id); }
		else {
			$order = new Order;
		}


	    	    $order->id = $request->id;
	    	    $order->user_id = $request->user_id;
	    	    $order->active = $request->active;
	    	    $order->vehicle_id = $request->vehicle_id;
	    	    $order->start = $request->start;
	    	    $order->end = $request->end;
	    	    $order->booked = $request->booked;
	    	    $order->pending = $request->pending;
	    	    $order->paid = $request->paid;
	    	    $order->amount = $request->amount;
	    	    $order->address = $request->address;
	    	    $order->address2 = $request->address2;
	    	    $order->phone = $request->phone;
	    	    $order->phone2 = $request->phone2;
	    	    $order->created_at = $request->created_at;
	    	    $order->updated_at = $request->updated_at;
	    	    //$order->user_id = $request->user()->id;
	    $order->save();

	    return redirect('/orders/index');

	}

	public function getDelete(Request $request, $id) {

		$order = Order::findOrFail($id);

		$order->delete();
		return redirect('/orders/index');

	}


}
