<?php

namespace TransitPro\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use TransitPro\User;
use TransitPro\Role;
use TransitPro\Permission;
use TransitPro\Http\Requests;
// use App\Http\Controllers\Controller;
use TransitPro\Http\Requests\StoreUserRequest;
use TransitPro\Http\Requests\UpdateUserRequest;
use TransitPro\Http\Requests\DeleteUserRequest;

class UsersController extends Controller
{

  protected $users;

  public function __construct(User $user){
    $this->users = $user;
    parent::__construct();
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=$this->users->paginate(10);
        return view('backend.admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $roles = Role::all();
        return view('backend.admin.users.form', compact('user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreUserRequest $request)
    {
        $user= $this->users->create($request->only('first_name','other_names', 'last_name', 'email', 'password'));
        $this->syncRoles($request, $user);
        return redirect(route('dashboard.admin.users.index'))->with('status', 'New user Has Been Created.');
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
          $user=$this->users->findOrFail($id);
          $roles = Role::all();
          return view('backend.admin.users.form', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateUserRequest $request, $id)
    {
        $user=$this->users->findOrFail($id);
        $user->fill($request->only('first_name','other_names', 'last_name', 'email', 'password'))->save();
        $this->syncRoles($request, $user);
        return redirect(route('dashboard.admin.users.edit', $user->id))->with('status', 'User Has Been Updated');
    }

    public function confirm(Requests\DeleteUserRequest $request, $id)
    {
        $user=$this->users->findOrFail($id);
        return view('backend.admin.users.confirm', compact('user'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requests\DeleteUserRequest $request, $id)
    {
        $user=$this->users->findOrFail($id);
        $name=$user->name();
        $user->delete();
        return redirect(route('dashboard.admin.users.index'))->with('status', 'User '. $name.' Has Been Deleted');
    }


    protected function changePassword(UserUpdateRequest $request, $user)
    {
        if ($request->has(['password', 'password_confirmation'])) {
            $pass = $request->get('password', false);
            $pass_conf = $request->get('password_confirmation', false);
            if ($pass && $pass_conf && ( $pass == $pass_conf )) {
                $user->password = bcrypt($pass);
            }
        }
    }
    protected function syncRoles(Request $request, $user)
    {
        if ($request->has('roles')) {
            $user->roles()->sync(array_keys($request->roles));
        } else {
            $user->roles()->sync(['customer']);
        }
    }
}
