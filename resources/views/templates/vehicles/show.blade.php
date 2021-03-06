<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
    </div>
    <div class="col-md-12">
      <div class="col-md-6">
        @if(Auth::user() && Auth::user()->isAdmin()  && strpos(strtoupper($vehicle->vehicle_type->name), strtoupper('bus')) !== false)
          <h1 class="text-left">Bus Profile: <span class="label {{$vehicle->active?'label-success':'label-danger'}}">{{$vehicle->active?'Active':'Not Active'}}</span></h1>
          <div class="panel panel-warning">
            <div class="panel-heading">
              <h3 class="panel-title text-center">{{$vehicle->present()->displayName()}}</h3>
            </div>
            @if($errors->any())

              <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Errors!</strong>
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            {{-- @if($status)
            <div class="alert alert-info">
            <p>
            {{$status}}
          </p>
        </div>
      @endif --}}
      <div class="list-group">
        <div class="list-group-item">
          <span>Route: @if($vehicle->route)
            ( {{$vehicle->vehicle_route->name}} ) {{$vehicle->vehicle_route->start->name}} &#x02192; {{$vehicle->vehicle_route->end->name}}</span>
          @else
            N/A
          @endif
          <form method="post" action="{{route('dashboard.admin.vehicles.assignRoute', $vehicle->id)}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @if($vehicle->route)
              <input type="hidden" name="route_name" value="{{$vehicle->vehicle_route->name}}">
            @endif
            <div class="form-flex-group">
              <div class="">
                <select class="form-control" name="route" id="optionTransitRoute">
                  @foreach($troutes as $route)
                    <option value="{{$route->id}}" {{$vehicle->route === $route->id ?'selected':''}}>( {{$route->name}} ) {{$route->start->name}} &#x02192; {{$route->end->name}}</option>
                  @endforeach
                </select>
              </div>
              <input type="submit" name="assignRoute" value="{{$vehicle->route?'Change':'Assign'}}"  class="btn btn-success">
            </div>
          </form>
        </div>
        <div class="list-group-item">
          @if($vehicle->route)
            <form method="post" action="{{route('dashboard.admin.vehicles.assignFleet', $vehicle->id)}}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="route_name" value="{{$vehicle->vehicle_route->name}}">
              <span>Fleet No: {{$vehicle->vehicle_number?:'N/A'}}</span>
              <p class="text-right">Click Here To Change <input type="submit" name="assignFleet" value="{{$vehicle->vehicle_number?'Change':'Assign'}} Fleet Number"  class="btn btn-warning btn-sm"></p>
            </form>
          @else
            <span class="help-block text-muted"> Fleet Number Is Generated From Route Please Assign A Route</span>
          @endif
        </div>
        <div class="list-group-item">
          <p>Year:  {{$vehicle->year}}  </p>
        </div>
        <div class="list-group-item">
          <form method="post" action="{{route('dashboard.admin.vehicles.assignDriver', $vehicle->id)}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
            <div class="form-flex-group">
              <div class="">
                <select class="form-control" name="driver_id" id="optionDriverID">
                  @foreach($drivers as $driver)
                    <option value="{{$driver->id}}">( {{$driver->user->email}} ) {{$driver->user->name()}}</option>
                  @endforeach
                </select>
              </div>
              <input type="submit" name="assignRoute" value="Assign Driver"  class="btn btn-success">
            </div>
          </form>
          @if(count($vehicle->drivers)>0)
            <div class="list-group">
              @foreach($vehicle->drivers as $driver)
                <div class="list-group-item form-flex-group">
                  <a href="#" class="thumbnail" style="width:20%">
                    @if($driver->user->image)
                      <img src="{{$driver->user->image}}" alt="{{$driver->user->name()}}" class="img-responsive" >
                    @else
                      <img src="{{theme('/images/logo.png')}}" alt="{{$driver->user->name()}}" class="img-responsive" >
                    @endif
                  </a>
                  <div style="padding:10px; width:70%;" class="text-right">
                    <form method="post" action="{{route('dashboard.admin.vehicles.deattachDriver', $vehicle->id)}}">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                      <input type="hidden" name="driver_id" value="{{ $driver->id }}">
                      <input type="submit" name="deattachDriver" value="X"  class="btn btn-danger btn-sm pull-right">
                    </form>
                    <br>
                    <br/>{{$driver->user->name()}} <br>{{$driver->user->email}}<br> License: {{$driver->license}}
                  </div>
                </div>
              @endforeach
            </div>
          @else
            <p><span class="help-block text-muted">No Drivers For This Bus</p>
            @endif
          </div>
        </div>
      </div>
    @endif
  </div>
  <div class="{{Auth::user() && Auth::user()->isAdmin() && strpos(strtoupper($vehicle->vehicle_type->name), strtoupper('bus')) !== false?'col-md-6': 'col-md-8 col-md-offset-2'}}">
    <div class="col-md-12">
      <h1 class="text-center">{{$vehicle->present()->displayName()}}</h1>
      <a href="{{route('vehicles.show', [lcfirst($vehicle->vehicle_type->name), $vehicle->id,  $vehicle->number_plate])}}" class="thumbnail">
        @if($vehicle->image)
          <img src="{{$vehicle->image}}" alt="{{$vehicle->registration_number}}">
        @else
          <img src="{{theme('images/whitebus.jpg')}}" alt="{{$vehicle->registration_number}}">
        @endif
      </a>
      @if(strpos(strtoupper($vehicle->vehicle_type->name), strtoupper('bus')) == false)
        @if(!$vehicle->booking_amount)
          <span class="label label-default">No Booking Amount Added Yet</span>
        @else
          @if($vehicle->booked)
            <span class="label label-default">Vehicle Booked</span>
          @else
            <p class="text-right">
              <button id="orderVehicleBtn" class="btn btn-sm btn-success" onclick="toggleContactDriverForm(orderForm)">Book At {{floatval($vehicle->booking_amount)}} RM</button>
              <div class="order-form" id="orderForm">
                @if(!Auth::user())
                  <p class="text-left">Please Login To Order</p>
                @else
                  @if(Auth::user()->address)
                    <form action="{{ route('account.orders.store') }}" method="POST" class="form-horizontal">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="user_id" id="user_id" class="form-control" value="{{Auth::user()->id}}">
                      <input type="hidden" name="vehicle_id" id="vehicle_id" class="form-control" value="{{$vehicle->id}}">
                      <input type="hidden" name="booked" id="booked" class="form-control" value="1">
                      <input type="hidden" name="active" id="active" class="form-control" value="1">
                      <input type="hidden" name="paid" id="paid" class="form-control" value="0">
                      <input type="hidden" name="amount" id="amount" class="form-control" value="{{$vehicle->booking_amount}}">
                      <div class="form-group">
                        <label for="start" class="col-sm-12 control-label">Expected PickUp Date: </label>
                        <div class="col-sm-12">
                          <input type="text" name="start" id="start" class="form-control bfh" value="{{$model['start'] or ''}}" required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="end" class="col-sm-12 control-label">Expected Return Date: </label>
                        <div class="col-sm-12">
                          <input type="text" name="end" id="end" class="form-control" value="{{$model['end'] or ''}}" required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="address" class="col-sm-12 control-label">Address</label>
                        <div class="col-sm-12">
                          <input type="text" name="address" id="address" class="form-control" value="{{Auth::user()->address}}" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="address2" class="col-sm-12 control-label">Address2</label>
                        <div class="col-sm-12">
                          <input type="text" name="address2" id="address2" class="form-control" value="{{Auth::user()->address2}}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="phone" class="col-sm-12 control-label">Contact Phone</label>
                        <div class="col-sm-12">
                          <input type="text" name="phone" id="phone" class="form-control" value="{{Auth::user()->phone}}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="phone2" class="col-sm-12 control-label">Alternative Phone Number: </label>
                        <div class="col-sm-12">
                          <input type="text" name="phone2" id="phone2" class="form-control" value="{{Auth::user()->phone2}}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="remarks" class="col-sm-12 control-label">Any Remarks: </label>
                        <div class="col-sm-12">
                          <textarea name="remarks" rows="8" cols="40" class="form-control"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-12">
                          <button type="submit" class="btn btn-success">
                            <i class="fa fa-shopping-cart"></i> Confirm Vehicle Booking
                          </button>
                          <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                      </div>
                    </form>
                  @else
                    <p class="text-left">Please Add Your Address Information <a href="/account/address">Here</a></p>
                  @endif

                @endif
              </div>
            </p>
          @endif
        @endif
      @endif
      <ul class="list-unstyled">
        <li>Type: {{$vehicle->vehicle_type->name}}</li>
        <li>No: {{$vehicle->vehicle_number?:'N/A'}}</li>
        <li>Route: {{$vehicle->route?$vehicle->vehicle_route->name:'N/A'}}</li>
        <li>Number Plate: {{$vehicle->number_plate}}</li>
      </ul>

      @if($vehicle->route)
        <div class="well well-sm" >
          <a href="/map/{{$vehicle->vehicle_route->start->district->name}}/{{$vehicle->vehicle_route->start->district->id}}/bus_routes" class="btn btn-sm btn-success">District: {{$vehicle->vehicle_route->start->district->name}}</a>
          See Map And Explore Routes
        </div>
      @endif
      <div class="list-group">
        @if($errors->any())

          <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Errors!</strong>
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
              @endforeach
            </ul>
          </div>
        @endif
        @foreach($vehicle->drivers as $driver)
          <div class="list-group-item">
            <h4>Drivers: </h4>
            <div class="form-flex-group">
              <a href="#" class="thumbnail" style="width:20%">
                @if($driver->user->image)
                  <img src="{{$driver->user->image}}" alt="{{$driver->user->name()}}" class="img-responsive" >
                @else
                  <img src="{{theme('/images/logo.png')}}" alt="{{$driver->user->name()}}" class="img-responsive" >
                @endif
              </a>
              <p style="padding:10px;" class="text-right"><br/>{{$driver->user->name()}} <br>{{$driver->user->email}}<br> License: {{$driver->license}}</p>
            </div>
            <button id="toggleContactDriverForm{{$driver->id}}" onclick='toggleContactDriverForm(contactDriverForm{{$driver->id}})' class="btn btn-sm btn-primary pull-right">Contact</button>

            <form class="form-group contact-driver-form" id="contactDriverForm{{$driver->id}}" method="POST" action="{{route('messages.messageDriver')}}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="email" value="{{ $driver->user->email}}">
              <input type="hidden" name="name" value="{{ $driver->user->name()}}">
              <input type="hidden" name="sender" value="{{ Auth::user()?'<'. Auth::user()->email.'>'.Auth::user()->name():'Guest'}}">
              <p class="text-right"><label for="message">Message: </label>
                <input type="submit" name="sendMessage" value=" Send " class="btn btn-sm btn-default"></p>
                <textarea name="body" rows="8" cols="40" class="form-control" required=""></textarea>
              </form>
              <br>
              <br>
            </div>
          @endforeach
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h4>Featured Transit: </h4>
        </div>
        @forelse (get_featured_transit() as $vehicle)
          <div class="col-md-3 list-item">
            <div class="col-sm-12">
              <h5>{{$vehicle->present()->displayName()}}</h5>
            </div>
            <div class="col-sm-12">
              <a href="{{route('vehicles.show', [lcfirst($vehicle->vehicle_type->name), $vehicle->id,  $vehicle->number_plate])}}" class="thumbnail">
                @if($vehicle->image)
                  <img src="{{$vehicle->image}}" alt="{{$vehicle->registration_number}}" class="img-responsive" >
                @else
                  <img src="{{theme('images/whitebus.jpg')}}" alt="{{$vehicle->registration_number}}" class="img-responsive" >
                @endif
              </a>
            </div>
            <div class="col-sm-12">

              <ul class="list-unstyled">
                <li>Type: {{$vehicle->vehicle_type->name}}</li>
                <li>No: {{$vehicle->vehicle_number?:'N/A'}}</li>
                <li>Route: {{$vehicle->route?:'N/A'}}</li>
              </ul>
            </div>
          </div>
        @empty
          <div class="jumbotron jumbotron-fluid text-center">
            <div class="container">
              <p class="lead">No Featured Transit Yet</p>
            </div>
          </div>
        @endforelse
      </div>
    </div>

  </div>
</div>
</div>
<script charset="utf-8">
function toggleContactDriverForm(target){
  // var target_id = target.id[target.id.length-1];
  // console.log(target);
  $(target).toggle(function() {
    /* Stuff to do every *odd* time the element is clicked */
  }, function() {
    /* Stuff to do every *even* time the element is clicked */
  });

}
$(document).ready(function() {
  (function(){
    $('input[name=start]').datetimepicker({
      allowInputToggle : true,
      format:'YYYY-MM-DD HH:mm:ss',
      showClear:true
    });
    $('input[name=end]').datetimepicker({
      allowInputToggle : true,
      format:'YYYY-MM-DD HH:mm:ss',
      showClear:true
    });
  })();
});

</script>
