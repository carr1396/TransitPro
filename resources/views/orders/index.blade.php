@extends('crudgenerator::layouts.master')

@section('content')


<h2 class="page-header">{{ ucfirst('orders') }}</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        List of {{ ucfirst('orders') }}
    </div>

    <div class="panel-body">
        <div class="">
            <table class="table table-striped" id="thegrid">
              <thead>
                <tr>
                                        <th>Id</th>
                                        <th>User Id</th>
                                        <th>Active</th>
                                        <th>Vehicle Id</th>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Booked</th>
                                        <th>Pending</th>
                                        <th>Paid</th>
                                        <th>Amount</th>
                                        <th>Address</th>
                                        <th>Address2</th>
                                        <th>Phone</th>
                                        <th>Phone2</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th style="width:50px"></th>
                    <th style="width:50px"></th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
        </div>
        <a href="{{url('orders/add')}}" class="btn btn-primary" role="button">Add order</a>
    </div>
</div>




@endsection



@section('scripts')
    <script type="text/javascript">
        var theGrid = null;
        $(document).ready(function(){
            theGrid = $('#thegrid').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "responsive": true,
                "ajax": "{{url('orders/grid')}}",
                "columnDefs": [
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{url('orders/show')}}/'+row[0]+'">'+data +'</a>';
                        },
                        "targets": 1
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{url('orders/update')}}/'+row[0]+'" class="btn btn-default">Update</a>';
                        },
                        "targets": 16                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{url('orders/delete')}}" onclick="return doDelete('+row[0]+')" class="btn btn-danger">Delete</a>';
                        },
                        "targets": 16+1
                    },
                ]
            });
        });
        function doDelete(id) {
            if(confirm('You really want to delete this record?')) {
               $.ajax('{{url('orders/delete')}}/'+id).success(function() {
                theGrid.ajax.reload();
               });
                
            }
            return false;
        }
    </script>
@endsection