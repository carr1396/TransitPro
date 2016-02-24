@if($user)
  {!! Form::model($user, [
    'method' => 'put',
    'route' =>  ['backend.account.update', $user->id]
    ]) !!}
      <div class="form-group">
        <p class="help-block">
          (<span class="text-danger"><i class="fa fa-asterisk"></i></span>) Fields required
          (<span class="text-primary">^</span>) Fields Optional
        </p>
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
        {!!  Form::label('image', 'Image Path (Get One from image manager)') !!}
        <span class="text-muted help-block">/image/user/imagename</span>
        <div class="input-group">
          <span class="input-group-addon addon-danger"><i class="fa fa-asterisk"></i></span>
          {!!  Form::text('image', null, ['class' => 'form-control']) !!}
        </div>
      </div>
    <div class="form-group pull-left">
      {!!  Form::submit('Update Your Profile', ['class' => 'btn btn-primary']) !!}
    </div>
  {!! Form::close() !!}

@else
  <div class="jumbotron-hr">
    <p>Failed To Load Profile Data</p>
  </div>
@endif
