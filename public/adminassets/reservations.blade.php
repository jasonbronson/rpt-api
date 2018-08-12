@include('adminassets.header')
<div class="wrapper">

  @include('adminassets.headeribbon')
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Reservations
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Reservations</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        

        <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
              <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Guests</th>
                    <th>Resorts / Condos</th>
                    <th>Travel Dates</th>
                    <th>Total</th>
                    <th>Received</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                
                  @foreach($rows as $data)
                  <tr>
                    <td><a href="/admin/reservation/{{$data->order_id}}">{{$data->last_name}},{{$data->first_name}} </a></td>
                    <td>{{($data->adults + $data->kids)}}</td>
                    <td>{{$data->resort_name}} {{$data->condo_name}}</td>
                    <td>{{$data->arrive}} to {{$data->depart}}</td>
                    <td>${{$data->total}}</td>
                    <td>{{$data->order_date_submit}}</td>
                    <td>{{$data->order_status}}</td>
                  </tr>
                  @endforeach
                  
                
                </tbody>
                <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Guests</th>
                    <th>Resorts / Condos</th>
                    <th>Travel Dates</th>
                    <th>Total</th>
                    <th>Received</th>
                    <th>Status</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>

  @include('adminassets.footer')

  <script>
      $( document ).ready(function() {
        console.log( "ready!" );
        
        $('#dataTable').DataTable({

          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : false,
          'info'        : false,
          'autoWidth'   : false
        })
    });

    </script>