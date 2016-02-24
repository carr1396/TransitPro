@extends('layouts.frontend')

@section('title', $page->title)

@section('content')
  @if($page->view)
    {!! $page->view->render() !!}
  @else
    {!! $page->present()->contentHTML() !!}
  @endif

  {{-- {!! $page->present()->contentHTML() !!} --}}
@endsection
