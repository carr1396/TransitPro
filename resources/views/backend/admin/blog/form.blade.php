@extends('layouts.admin')

@section('title', $post->exists ? 'Editing '.$post->title : ' Create New post' )

@section('content')
<div class="pull-left">
  <a href="{{route('blog.post', [$post->id, $post->slug])}}" class="btn btn-primary">
    <span class="glyphicon glyphicon-eye-open"></span>
    View Post In This Window
  </a>
  <a href="{{route('blog.post', [$post->id, $post->slug])}}" class="btn btn-primary" target="_blank">
    <span class="glyphicon glyphicon-eye-open"></span>
    View Post In New Window
    <span class="glyphicon glyphicon-log-in"></span>
  </a>
</div>
  <div class="row">
    @if($post->exists)
    @endif
    <div class="col-md-10">
      {!! Form::model($post, [
        'method' => $post->exists ? 'put': 'post',
        'route' => $post->exists ? ['dashboard.admin.blog.update', $post->id]: ['dashboard.admin.blog.store']
        ]) !!}
        <div class="form-group">
          {!!  Form::label('title') !!}
          {!!  Form::text('title', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!!  Form::label('slug') !!}
          {!!  Form::text('slug', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group row">
          <div class="col-md-12">
            {!!  Form::label('published_at') !!}
          </div>
          <div class="col-md-5">
            {!!  Form::text('published_at', null, ['class' => 'form-control']) !!}
          </div>
        </div>
        <div class="form-group excerpt">
          {!!  Form::label('excerpt') !!}
          <p  class="help-block">
            This Editor uses Markdown. For help <a href="https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet">See Syntax For Markdown.</a>
          </p>
          {!!  Form::textarea('excerpt', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!!  Form::label('body') !!}
          <p  class="help-block">
            This Editor uses Markdown. For help <a href="https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet">See Syntax For Markdown.</a>
          </p>
          {!!  Form::textarea('body', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group pull-right">
          {!!  Form::submit($post->exists ?'Save Changes To Blog Post':'Create New Blog Post ', ['class' => 'btn btn-primary']) !!}
        </div>
      {!! Form::close() !!}
    </div>
  </div>

  <script type="text/javascript">
    new SimpleMDE({
      element: document.getElementsByName('body')[0]
    }).render();
    new SimpleMDE({
      element: document.getElementsByName('excerpt')[0]
    }).render();

    $('input[name=published_at]').datetimepicker({
      allowInputToggle : true,
      format:'YYYY-MM-DD HH:mm:ss',
      showClear:true,
      defaultDate:'{{old('published_at', $post->published_at)}}'
    });

    $('input[name=title]').on('blur', function(){
      var slugElement = $('input[name=slug]');
      if(slugElement.val()){
        return;
      }
      slugElement.val(this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+$/g, ''));
    });
  </script>
@endsection
