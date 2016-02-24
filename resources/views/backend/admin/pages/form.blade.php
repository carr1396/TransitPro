@extends('layouts.admin')
@section('title', $page->exists ? 'Editing '.$page->name : ' Create New page' )

@section('tab-content')
<p class="pull-right"><a href="{{route('dashboard.admin.pages.index')}}">See All Pages</a></p>
  {!! Form::model($page, [
    'method' => $page->exists ? 'put': 'post',
    'route' => $page->exists ? ['dashboard.admin.pages.update', $page->id]: ['dashboard.admin.pages.store']
    ]) !!}
    <div class="form-group">
      {!!  Form::label('title') !!}
      {!!  Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
      {!!  Form::label('uri', 'URI') !!}
      {!!  Form::text('uri', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
      {!!  Form::label('name') !!}
      {!!  Form::text('name', null, ['class' => 'form-control']) !!}
      <p class="help-block">
        Name is used to generate urls to the page
      </p>
    </div>
    <div class="form-group">
      <div class="row">
        <div class="col-md-12">
          {!!  Form::label('template') !!}
        </div>
        <div class="col-md-4">
          {!!  Form::select('template', $templates,null, ['class' => 'form-control']) !!}
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="row">
        <div class="col-md-12">
          {!!  Form::label('order') !!}
        </div>
        <div class="col-md-2">
          {!!  Form::select('order',
            [''=>'',
              'before'=>'Before',
              'after'=>'After',
              'childOf'=>'Child Of'
            ]
            ,null, ['class' => 'form-control']) !!}
        </div>
        <div class="col-md-5">
          {{--  add padding for  nested vales--}}
          {!!  Form::select('orderPage',
            [''=>'']+$orderPages->lists('padded_title', 'id')->toArray()
            ,null, ['class' => 'form-control']) !!}
        </div>
      </div>
    </div>
    <div class="form-group">
      {!!  Form::label('content') !!}
      <p  class="help-block">
        This Editor uses Markdown. For help<a href="https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet">See Syntax For Markdown.</a>
      </p>
      {!!  Form::textarea('content', null, ['class' => 'form-control']) !!}
    </div>
    <div class="checkbox">
      <label for="hidden">
        {{-- {!!  Form::checkbox('hidden') !!} --}}
        {{ Form::checkbox('hidden', '1', $page->hidden) }}
        Show Or Hide Page From Navigation
        <span class="help-block text-muted">Checking This Will Hide page From Navigation, Can Only Applied For Pages Without Children</span>
      </label>
    </div>

    <div class="form-group pull-right">
      {!!  Form::submit($page->exists ?'Save':'Create', ['class' => 'btn btn-primary']) !!}
    </div>
  {!! Form::close() !!}

  <script type="text/javascript">
    new SimpleMDE().render();
  </script>
@endsection
