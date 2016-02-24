@extends('layouts.account')

@section('title', 'Account')

@section('content')
  {{Auth::user()->name()}} Profile
  <div class="row">
    <div class="col-md-12">
      @if(count($activities)<=0)
        <div class="jumbotron-hr">
          <p class="lead">No Activities Yet On This Account</p>
        </div>
      @else
        <form id="live-search" action="" class="styled" method="post">
          <div class="input-group">
            <span class="input-group-addon"  >Filter: <span id="filter-count"></span></span>
            <input type="text" class="text-input form-control" id="filter" value="" />
          </div>
        </form>
        <div class="list-group" id="activity-list">
          @foreach($activities as $activity)
            <div class="list-group-item">
              {!! Form::open(['method' =>'delete', 'route'=>['admin.activities.destroy', $activity->id]]) !!}
              {!!  Form::submit('X Delete', ['class' => 'btn btn-xs btn-danger pull-right']) !!}
              {!! Form::close() !!}
              <span class="activity_owner label label-info ">
                Done By:
                {{$activity->user->name()}}
              </span>
              <p class="list-group-item-text text-left"> {{$activity->text}}</p>
              <span class="label label-pill label-primary pull-right">{{$activity->created_at}}</span>
              <br>
            </div>
          @endforeach
        </div>
        {{$activities->render()}}
        <script charset="utf-8">
        $(document).ready(function(){
          document.getElementById('live-search').addEventListener('submit', function(e){
            e.preventDefault();
          });
          $("#filter").keyup(function(){
            // Retrieve the input field text and reset the count to zero
            var filter = $(this).val(), count = 0;

            // Loop through the comment list
            $("#activity_list div.list-group-item").each(function(){

              // If the list item does not contain the text phrase fade it out
              if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();

                // Show the list item if the phrase matches and increase the count by 1
              } else {
                $(this).show();
                count++;
              }
            });

            // Update the count
            var numberItems = count;
            $("#filter-count").text(""+count);
          });
        });
        </script>
      @endif
    </div>
  </div>
@endsection
