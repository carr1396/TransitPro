@extends('backend.images.manager')

@section('title', 'All User Images')

  @section('manager-content')
    <table class='table table-striped  table-hover'>
      <tr>
        <th>Id </th>
        <th>Name </th>
        <th>Path </th>
        <th>Thumbnail </th>
        <th>Edit </th>
        <th>Delete </th>
      </tr>
      @if(count($images)>0)
        <tr>
          <td colspan="6">
            {!!$images->render()!!}
          </td>
        </tr>
      @endif
      @forelse($images as $image)
        <tr class="{{$image->is_private?'success':'default'}}">
          <td>{{ $image->id }}  </td>
          <td>{{ $image->name }} </td>
          <td>
            {{$image->path.''.$image->name.'.'.$image->extension}}
          </td>
          <td>
            <a href="#"><img src="/images/user/thumbnails/{{ 'thumb-'. $image->name . '.' .$image->extension . '?'. 'time='.time() }}"></a>
          </td>

          <td>
            <a href="{{route('backend.images.edit', $image->id)}}"><span class="glyphicon glyphicon-edit"></span></a>
          </td>
          <td>

            {!! Form::model($image, ['route' => ['backend.images.destroy', $image->id],
              'method' => 'DELETE'
              ]) !!}
              <div class="form-group">

                {!! Form::submit('Delete', array('class'=>'btn btn-xs btn-danger', 'Onclick' => 'return ConfirmDelete()')) !!}

              </div>
              {!! Form::close() !!}
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6">
              You Have No Images And It Seems There Are No Public images to choose from either
            </td>
          </tr>
        @endforelse
      </table>
    @endsection
    <script>

    function ConfirmDelete()
    {
      var x = confirm("Are you sure you want to delete?");
      if (x)
      return true;
      else
      return false;
    }

    </script>
