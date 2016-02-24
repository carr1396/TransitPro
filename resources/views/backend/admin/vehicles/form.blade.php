@extends('layouts.admin')

@section('title', $vehicle->exists ? 'Editing Vehicle '.$vehicle->id : ' Create New Vehicle' )

@section('tab-content')
   <p class="pull-right"> <a href="{{route('dashboard.admin.vehicles.index')}}">Go Back To Vehicle List</a></p>
   @if(!$types->isEmpty())
   {!! Form::model($vehicle, [
     'method' => $vehicle->exists ? 'put': 'post',
     'route' => $vehicle->exists ? ['dashboard.admin.vehicles.update', $vehicle->id]: ['dashboard.admin.vehicles.store'],
     'class'=>'container-fluid'
     ]) !!}
     <div class="row">
       <div class="col-md-6">
         <div class="form-group">
           {!!  Form::label('number_plate') !!}
           <div class="input-group">
             <span class="input-group-addon">*</span>
             {!!  Form::text('number_plate', null, ['class' => 'form-control', 'placeholder'=>'A-127-0012', 'required' =>'Required']) !!}
           </div>
         </div>
       </div>
       <div class="col-md-6">
         <div class="form-group">
           {!!  Form::label('type') !!}
           <div class="input-group">
             <span class="input-group-addon">*</span>
             {!!  Form::select('type', $types,null, ['class' => 'form-control' , 'required' =>'Required']) !!}
           </div>
         </div>
       </div>
       <div class="col-md-6">
         <div class="form-group">
           {!!  Form::label('make') !!}
           <div class="input-group">
             <span class="input-group-addon">*</span>
             {!!  Form::text('make', null, ['class' => 'form-control', 'placeholder'=>'Vehicle Make', 'required' =>'Required']) !!}
           </div>
         </div>
       </div>
       <div class="col-md-6">
         <div class="form-group">
           {!!  Form::label('model') !!}
           <div class="input-group">
             <span class="input-group-addon">*</span>
             {!!  Form::text('model', null, ['class' => 'form-control', 'placeholder'=>'Vehicle Model', 'required' =>'Required']) !!}
          </div>
         </div>
       </div>

       <div class="col-md-6">
         <div class="form-group">
           {!!  Form::label('year') !!}
           <div class="input-group">
             <span class="input-group-addon">*</span>
             {!!  Form::number('year', null, ['class' => 'form-control', 'placeholder'=>'Year Of Vehicle Release' , 'required' =>'Required']) !!}
          </div>
         </div>
       </div>
       <div class="col-md-6">
         <div class="form-group">
           {!!  Form::label('color') !!}
           <div class="input-group">
             <span class="input-group-addon">^</span>
             {!!  Form::text('color', null, ['class' => 'form-control', 'placeholder'=>'Vehicle Color (Optional)']) !!}
          </div>
         </div>
       </div>
       <div class="col-md-6">
         <div class="form-group">
           {!!  Form::label('capacity') !!}
           <div class="input-group">
             <span class="input-group-addon">*</span>
             {!!  Form::number('capacity', null, ['class' => 'form-control bfh-number', 'placeholder'=>'Vehicle Capacity', 'required' =>'Required']) !!}
          </div>
         </div>
       </div>
       <div class="col-md-6">
         <div class="form-group">
           {!!  Form::label('registration_number') !!}
           <div class="input-group">
             <span class="input-group-addon">*</span>
             {!!  Form::text('registration_number', null, ['class' => 'form-control', 'placeholder'=>'Registration Number', 'required' =>'Required']) !!}
          </div>
         </div>
       </div>
       @if(strpos(strtoupper($vehicle->vehicle_type->name), strtoupper('bus')) == false)
         <div class="col-md-6">
           <div class="form-group">
             {!!  Form::label('booking_amount', 'Book Amount (RM)') !!}
             <div class="input-group">
               <span class="input-group-addon">*</span>
               {!!  Form::number('booking_amount', null, ['class' => 'form-control', 'placeholder'=>'Vehicle Capacity', 'required' =>'Required']) !!}
            </div>
           </div>
         </div>
       @endif
       <div class="col-md-12">
         <div class="form-group">
           {!!  Form::label('image', 'Image Path (Get One from image manager)') !!}
           <span class="text-muted help-block">/image/user/imagename</span>
           <div class="input-group">
             <span class="input-group-addon addon-danger"><i class="fa fa-asterisk"></i></span>
             {!!  Form::text('image', null, ['class' => 'form-control']) !!}
           </div>
         </div>
       </div>
       <div class="col-md-6">
         <div class="checkbox">
           <label for="active">
             {!!  Form::checkbox('active') !!}
             Active (Default False)
           </label>
         </div>
       </div>
       <div class="col-md-6">
         <div class="checkbox">
           <label for="booked">
             {!!  Form::checkbox('booked') !!}
             Booked (Default False)
           </label>
         </div>
       </div>
       <div class="col-md-6">
         {!!  Form::submit($vehicle->exists ?'Update Vehicle Information':'Add New Vehicle', ['class' => 'btn btn-primary']) !!}
       </div>
     </div>
   {!! Form::close() !!}
   <script type="text/javascript">
     (function(){
       $('input[name=year]').datetimepicker({
         allowInputToggle : true,
         format:'YYYY',
         viewMode:'years',
         showClear:true,
         defaultDate:'{{old('year', $vehicle->year)}}'
       });
     })();
   </script>
   @else
    <div class="jumbotron jumbotron-fluid text-center">
      <div class="container">
        <h1 class="display-3">No Vehicle Types Added Yet</h1>
        <p class="lead text-danger">You Have Not Added Vehicle Types (Type is a required field for adding a vehicle). Go
          <a href="{{route('dashboard.admin.types.create')}}">Here To</a> Add Some. </p>
      </div>
    </div>
   @endif
@endsection
