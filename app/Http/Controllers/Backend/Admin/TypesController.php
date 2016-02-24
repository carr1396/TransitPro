<?php

namespace TransitPro\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use TransitPro\Http\Requests;
use TransitPro\Http\Requests\StoreTypeRequest;
use TransitPro\Type;

class TypesController extends Controller
{
  protected $types;

   public function __construct(type $types){
     $this->types = $types;
     parent::__construct();
   }


     public function index()
     {
         $types=$this->types->paginate(10);
         return view('backend.admin.types.index', compact('types'));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Type $type)
    {
        return view('backend.admin.types.form', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreTypeRequest $request)
    {
      $type=$this->types->create($request->only('name', 'description'));
      return redirect(route('dashboard.admin.types.index'))->with('status', 'New Type Has Been Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect(route('dashboard.admin.types.edit', $id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $type=$this->types->findOrFail($id);
      return view('backend.admin.types.form', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateTypeRequest $request, $id)
    {
      $type=$this->types->findOrFail($id);
      $type->fill($request->only('name', 'description'))->save();
      return redirect(route('dashboard.admin.types.edit', $type->id))->with('status', $type->name.' Type Has Been Updated');
    }

    public function confirm($id){
      $type=$this->types->findOrFail($id);
      return view('backend.admin.types.confirm', compact('type'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $type=$this->types->findOrFail($id);
      $name=$type->id;
      $type->delete();
      return redirect(route('dashboard.admin.types.index'))->with('status', 'type '. $name.' Has Been Deleted');
    }
}
