@extends('layouts.admin')

@section('title', $user->exists ? 'Editing '.$user->name() : ' Create New user' )


@section('content')
  {!! Form::model($user, [
    'method' => $user->exists ? 'put': 'post',
    'route' => $user->exists ? ['dashboard.admin.users.update', $user->id]: ['dashboard.admin.users.store']
    ]) !!}
        <div class="help-block">
          (<span class="text-danger"><i class="fa fa-asterisk"></i></span>) Fields required
          <br>
          (<span class="text-primary">^</span>) Fields Optional
        </div>
        {!!  Form::label('first_name') !!}
        <div class="input-group">
          <span class="input-group-addon addon-danger"><i class="fa fa-asterisk"></i></span>
          {!!  Form::text('first_name', null, ['class' => 'form-control', 'placeholder'=>'First Name']) !!}
        </div>
      </div>
      <div class="form-group">
        {!!  Form::label('last_name') !!}
        <div class="input-group">
          <span class="input-group-addon addon-danger"><i class="fa fa-asterisk"></i></span>
          {!!  Form::text('last_name', null, ['class' => 'form-control', 'placeholder'=>'Last Name']) !!}
        </div>
      </div>
      <div class="form-group">
        {!!  Form::label('other_names') !!}
        <div class="input-group">
          <span class="input-group-addon addon-danger">^</span>
          {!!  Form::text('other_names', null, ['class' => 'form-control', 'placeholder'=>'Other Names (If Any)']) !!}
        </div>
      </div>
      <div class="form-group">
        {!!  Form::label('email') !!}
        <div class="input-group">
          <span class="input-group-addon addon-danger"><i class="fa fa-asterisk"></i></span>
          {!!  Form::text('email', null, ['class' => 'form-control', 'placeholder'=>'Email']) !!}
        </div>
      </div>
      <div class="form-group">
        {!!  Form::label('password') !!}
        @if ($user->exists)
        <p class="help-block">
          Leave Both Password And Password Confirmation Blank If You Do Not Wish
          Change The Password.
        </p>
        @endif
        <div class="input-group">
          <span class="input-group-addon addon-danger"><i class="fa fa-asterisk"></i></span>
          {!!  Form::password('password', array('class' => 'form-control', 'placeholder'=>'Password')) !!}
        </div>
      </div>
      <div class="form-group">
        {!!  Form::label('password_confirmation') !!}
        <div class="input-group">
          <span class="input-group-addon addon-danger"><i class="fa fa-asterisk"></i></span>
          {!!  Form::password('password_confirmation', array('class' => 'form-control','placeholder'=>'Confirm Password')) !!}
        </div>
      </div>
      <hr>
      <h2>Permissions</h2>

      <ul class = "list-unstyled">
        @foreach($roles as $role)
            <li>
                <label class = "control-label">
                    {!! Form::checkbox('roles['.$role->id.']',1, $user->hasRole($role->name ) ) !!}
                    {{ $role->display_name }} ( {{ $role->description }} )
                </label>
            </li>
        @endforeach
      </ul>

    <div class="form-group pull-right">
      {!!  Form::submit($user->exists ?'Save':'Create', ['class' => 'btn btn-primary']) !!}
    </div>
  {!! Form::close() !!}
@endsection
