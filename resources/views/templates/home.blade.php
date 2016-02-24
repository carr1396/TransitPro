<div class='container-fluid '>
  <div class="jumbotron welcome-banner" style="background:url({{theme('images/bus.jpg')}}) no-repeat; background-size: cover; background-position: center;">
    <div class="welcome-banner-film">

    </div>
    <div class="welcome-banner-content text-center">

      <h1>Welcome, To Transit-Pro</h1>
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <p>We value acess just as well as the journey and destination</p>
        </div>
        <div class="col-md-4 col-md-offset-4">
          <img src="{{theme('images/transitpro.png')}}" alt="Transit Pro" />
        </div>
      </div>

    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      @forelse ($posts as $post)
      <div class="col-md-4">
        <h2><a href="#">{{$post->title}}</a></h2>
        <p class="text-muted">
          Posted By {{$post->authored->name()}} On {{$post->published_at}}
        </p>
        @if ($post->excerpt)
          {!! $post->present()->excerptHtml() !!} <a href="{{route('blog.post', [$post->id, $post->slug])}}">Read more ...</a>
        @else
          {!! $post->present()->bodyHtml() !!}
        @endif
      </div>
      @empty
        <div class="jumbotron">
          <p>
            Hello, Site Has No Posts Yet
          </p>
        </div>
      @endforelse
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
<script charset="utf-8">
  var images = Array.from(document.getElementsByTagName('IMG'));
  images.forEach(function(image) {
    $(image).addClass('img-responsive img-rounded')
  });
</script>
