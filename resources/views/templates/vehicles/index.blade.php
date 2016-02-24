<div class="container-fluid">
  <div class="list row  transit-list">
    <h1 class="list-title col-md-12">Available Transits</h1>
    @forelse ($vehicles as $vehicle)
      <div class="col-md-6 list-item">
        <h2>{{$vehicle->present()->displayName()}}</h2>
        <div class="col-sm-2 col-xs-4">
          <a href="{{route('vehicles.show', [lcfirst($vehicle->vehicle_type->name), $vehicle->id,  $vehicle->number_plate])}}" class="thumbnail">
            <img src="{{theme($vehicle->image?:'images/whitebus.jpg')}}" alt="$vehicle->registration_number">
          </a>
        </div>
        <div class="col-sm-10 col-xs-8">
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
          <h1 class="display-3">No Available Active Transit</h1>
          <p class="lead">Administration Has Not Yet Added Any Active Transit (Vehicles).</p>
        </div>
      </div>
    @endforelse
    <div class="col-md-12">
      {{$vehicles->render()}}
    </div>
  </div>
</div>
