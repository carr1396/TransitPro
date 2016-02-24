<div class='container-fluid '>
  <div class="row">
    <div class="col-sm-8">
      @forelse ($posts as $post)
        <article class="">
          <h2><a href="{{route('blog.post', [$post->id, $post->slug])}}">{{$post->title}}</a></h2>
          <p class="text-muted">
            Posted By {{$post->authored->name()}} On {{$post->published_at}}
          </p>
          @if ($post->excerpt)
            {!! $post->present()->excerptHtml() !!} <a href="{{route('blog.post', [$post->id, $post->slug])}}">Read more ...</a>
          @else
            {!! $post->present()->bodyHtml() !!}
          @endif
        </article>
      @empty
        <div class="jumbotron">
          <p>
            Hello, Site Has No Posts Yet
          </p>
        </div>
      @endforelse
      {!! $posts->render() !!}
    </div>
    <div class="col-sm-4">
      <div class="col-md-12">
        <h4   class="text-right text-muted">  Featured Transit: </h4>
        @forelse (get_featured_transit() as $vehicle)
          <div class="col-md-12 list-item">
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
