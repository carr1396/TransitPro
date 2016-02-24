@extends('layouts.admin')

@section('title', $type->exists ? 'Editing Vehicle Type '.$type->id : ' Create New Vehicle Type' )

@section('tab-content')
   {!! Form::model($type, [
     'method' => $type->exists ? 'put': 'post',
     'route' => $type->exists ? ['dashboard.admin.types.update', $type->id]: ['dashboard.admin.types.store'],
     'class'=>'container-fluid'
     ]) !!}
     <div class="row">
       <div class="col-md-12">
         <div class="form-group">
           {!!  Form::label('name') !!}
           <div class="input-group">
             <span class="input-group-addon">*</span>
             {!!  Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Type Name']) !!}
           </div>
         </div>
       </div>
       <div class="col-md-12">
         <div class="form-group">
           {!!  Form::label('description') !!}
           <div class="input-group">
             <span class="input-group-addon">*</span>
             {!!  Form::text('description', null, ['class' => 'form-control', 'placeholder'=>'Type Description']) !!}
           </div>
         </div>
       </div>
       <div class="col-md-12">
         <div class="form-group">
           {!!  Form::submit($type->exists ?'Save':'Create', ['class' => 'btn btn-primary']) !!}
           <p class="pull-right">
             <input type="reset" name="reset" value="Reset Fields" class="btn btn-danger">
             <a href="{{route('dashboard.admin.types.index')}}">See All Vehicle Types</a>
           </p>
         </div>
       </div>
     </div>
   {!! Form::close() !!}

@endsection
