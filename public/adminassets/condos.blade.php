@include('adminassets.header')
<div class="wrapper">

  @include('adminassets.headeribbon')
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Condos
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Condos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        
        <div class="box">
            <div class="box-header">
              <h3 class="box-title"> <button class="condoadd">Add New Condo</button> </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
              <table id="dataTableCondos" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Resort</th>  
                  <th>Condo Name</th>
                    <th>Bedrooms</th>
                    <th>Occupancy</th>
                    <th>Delete</th>
                    
                </tr>
                </thead>
                <tbody>
                
                  @foreach($rows as $data)
                  <tr>
                    <td>{{$data->resort_name}}</td>
                    <td><a href="/admin/condo/{{$data->condo_id}}">{{$data->condo_name}}</a></td>
                    <td>{{$data->condo_bedrooms}}</td>
                    <td>Min:{{$data->condo_min_occupancy}} - Max: {{$data->condo_max_occupancy}}</td>
                    <td><button class="condodelete" onclick="btn_del_click({{$data->condo_id}})">Delete</button></td>
                    
                  </tr>
                  @endforeach
                  
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Resort</th>  
                  <th>Condo Name</th>
                    <th>Bedrooms</th>
                    <th>Occupancy</th>
                    <th>Delete</th>
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


  @include('adminassets.condomodal', ['resorts' => $resorts])

  @include('adminassets.footer')
