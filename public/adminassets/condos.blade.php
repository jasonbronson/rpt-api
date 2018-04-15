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
                
              <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Condo Name</th>
                    <th>Bedrooms</th>
                    <th>Delete</th>
                    
                </tr>
                </thead>
                <tbody>
                
                  @foreach($rows as $data)
                  <tr>
                    <td><a href="/admin/condo/{{$data->condo_id}}">{{$data->condo_name}}</a></td>
                    <td>{{$data->condo_bedrooms}}</td>
                    <td><button class="condodelete" onclick="btn_del_click({{$data->condo_id}})">Delete</button></td>
                    
                  </tr>
                  @endforeach
                  
                
                </tbody>
                <tfoot>
                <tr>
                    <th>Condo Name</th>
                    <th>Bedrooms</th>
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


  <div class="modal fade" id="condomodal" role="dialog">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    
                                <h2>Add new condo</h2>
                                <form id="editcondo" action="" method="POST">
                                  <input type="hidden" name="newcondo" value="true">
                                  <table class="table table-striped table-responsive">
                                      <tbody>
                                          <tr>
                                              <td nowrap="nowrap"><b>Name:</b></td>
                                              <td><input type="text" name="condo_name" value=""></td>
                                            </tr>
                                            <tr>
                                                <td nowrap="nowrap"><b>Resort Id:</b></td>
                                                <td><select name="resort_id">
                                                    <?php foreach($resorts as $resort): ?>
                                                    <option value="{{$resort->resort_id}}">{{$resort->resort_name}}</option>
                                                    <?php endforeach; ?>
                                                    </select> 
                                                  </td>
                                            </tr>
                                            <tr>
                                                <td nowrap="nowrap"><b>Condo Bedrooms:</b></td>
                                                <td><input type="text" name="condo_bedrooms" value=""></td>
                                            </tr>
                                            <tr>
                                                <td nowrap="nowrap"><b>Condo Booking Fee:</b></td>
                                                <td><input type="text" name="condo_fee_booking" value=""></td>
                                            </tr>
                                            <tr>
                                                <td nowrap="nowrap"><b>Condo Impact Fee:</b></td>
                                                <td><input type="text" name="condo_fee_impact" value=""></td>
                                            </tr>
                                            <tr>
                                                <td nowrap="nowrap"><b>Condo Tax Rate:</b></td>
                                                <td><input type="text" name="condo_tax_rate" value=""></td>
                                            </tr>
                                            <tr>
                                                <td nowrap="nowrap"><b>Condo Min Occupancy:</b></td>
                                                <td><input type="text" name="condo_min_occupancy" value=""></td>
                                            </tr>
                                            <tr>
                                                <td nowrap="nowrap"><b>Condo Max Occupancy:</b></td>
                                                <td><input type="text" name="condo_max_occupancy" value=""></td>
                                            </tr>
                                            <tr>
                                                <td nowrap="nowrap"><b>Condo Min Nights:</b></td>
                                                <td><input type="text" name="condo_min_nights" value=""></td>
                                            </tr>
                                        <tr>
                                  <td></td>
                                  <td> <input type="submit" name="change" id="change" value="Add"> </td>
                                  </tr>
                                  </tbody>
                                  </table>
                                  </form>    
                    
                  </div>
                </div>
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
        });

        $('#cancel').click(function( e ){
          e.preventDefault();
          $('#condomodal').modal('hide');
        });
        
        $('.condoadd').click(function(e) {
          e.preventDefault();
          console.log("condo add ");
          $('#condomodal').modal('show');
        });

        
        
    });

    function btn_del_click(id) {
      if (window.confirm("Are you sure you want to delete?")) {
        location.href = '/admin/condos?delete=' + id;
      }
    }

    </script>