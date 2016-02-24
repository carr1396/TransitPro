<?php

namespace TransitPro\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use TransitPro\Http\Requests;
use Kris\LaravelViewLogger\Logger;
use JavaScript;
use Activity;
use Spatie\Activitylog\Models\Activity as ActivityModel;
use Auth;

// use Spatie\Activitylog\Models\Activity;

class AdminController extends Controller
{
  public function index (){
    //https://github.com/kris-terziev/laravel-view-logger/blob/master/src/Logger.php
    $activities = ActivityModel::with('user')->latest()->limit(100)->paginate(10);

    Activity::log('Administration Panel Accessed by '.Auth::user()->name());
    return view('backend.admin.logs.activities', compact('activities'));
  }
  public function visits (){
    $view_logs =  array('unique' => Logger::unique() , 'year'=> Logger::perMonth(12), 'day' => Logger::perDay(3));
    JavaScript::put([
      'view_logs' => $view_logs,
    ]);
    return view('backend.admin.logs.views', compact('view_logs'));
  }
  public function destroyActivity($id)
  {
      $activity = ActivityModel::findOrFail($id);
      $activity->delete();
      return redirect()->back()->with('status', 'One activity Has Been Deleted');
  }

  public function cleareActivityLog()
  {
      Activity::cleanLog();
      return redirect()->back()->with('status', 'All Activities Have Been Deleted');
  }
}
