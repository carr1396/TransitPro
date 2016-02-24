<?php

namespace TransitPro\Http\Controllers\Backend;

use Illuminate\Http\Request;

use TransitPro\Http\Requests;
use Auth;
use JavaScript;
use Activity;
use TransitPro\User;
use Spatie\Activitylog\Models\Activity as ActivityModel;

class AccountController extends Controller
{
    public function index(){
      $activities = ActivityModel::where('user_id', Auth::user()->id)->with('user')->latest()->limit(100)->paginate(10);
      // Activity::log('Administration Panel Accessed ');
      return view('backend.account.index', compact('activities'));
    }
    public function settings(){
      return view('backend.account.settings');
    }
    public function address(){
      return view('backend.account.address');
    }
    public function addressCreate(Requests\UpdateUserAddressInformation $request, $id){
      $user=User::findOrFail($id);

      $user->fill($request->only('phone','phone2', 'address', 'address2'))->save();

      // var_dump($request->only('phone','phone2', 'address', 'address2'));
      return redirect(route('backend.account.address'))->with('status', 'User Address Information Has Been Updated');
    }
    public function update(Requests\UpdateUserAccountRequest $request, $id)
    {
        $user=User::findOrFail($id);
        $user->fill($request->only('first_name','other_names', 'last_name', 'email', 'password', 'image'))->save();
        return redirect(route('backend.account.settings'))->with('status', 'User Has Been Updated');
    }
}
