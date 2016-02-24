@extends('layouts.admin')

@section('title', $driver->exists ? 'Editing Vehicle driver '.$driver->id : ' Create New Vehicle driver' )

@section('tab-content')
   {!! Form::model($driver, [
     'method' => $driver->exists ? 'put': 'post',
     'route' => $driver->exists ? ['dashboard.admin.drivers.update', $driver->id]: ['dashboard.admin.drivers.store'],
     'class'=>'container-fluid'
     ]) !!}
     <div class="row">
       @if($driver->exists)
         <div class="col-sm-4">
           <div class="checkbox">
             <label for="active" >
               {{-- {!!  Form::checkbox('hidden') !!} --}}
               {{ Form::checkbox('active', '1', $driver->active) }}
               Active
               <span class="help-block text-muted"></span>
             </label>
           </div>
         </div>
       @endif
       <div class="col-md-6">
         <div class="form-group">
           {!!  Form::label('user_id') !!}
           <div class="input-group">
             <span class="input-group-addon">*</span>
             {{-- {!!  Form::select('user_id', $users,null, ['class' => 'form-control' , 'required' =>'Required']) !!} --}}
             <select id="user_id" name="user_id" class="form-control" required="Required">
               @foreach($users as $user)
                 <option value="{{$user->id}}" {{$driver->exists && $user->id === $driver->user_id ?'selected':''}}>{{$user->name()}}</option>
               @endforeach
             </select>
           </div>
         </div>
       </div>
       <div class="col-md-12">
         <div class="form-group">
           {!!  Form::label('license') !!}
           <div class="input-group">
             <span class="input-group-addon">*</span>
             {!!  Form::text('license', null, ['class' => 'form-control', 'placeholder'=>'Driver License', 'required' =>'Required']) !!}
           </div>
         </div>
       </div>
       <div class="col-md-12">
         <div class="form-group">
           {!!  Form::submit($driver->exists ?'Save':'Create', ['class' => 'btn btn-primary']) !!}
           <p class="pull-right">
             <input driver="reset" name="reset" value="Reset Fields" class="btn btn-danger">
             <a href="{{route('dashboard.admin.drivers.index')}}">See All Vehicle drivers</a>
           </p>
         </div>
       </div>
     </div>
   {!! Form::close() !!}

@endsection
