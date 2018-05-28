@include('adminassets.header')
<div class="wrapper">

  @include('adminassets.headeribbon')
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Resorts
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Resorts</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        

        <div class="box">
            <div class="box-header">
              <h3 class="box-title"> <button class="resortadd">Add New Resort</button> </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
              <table id="dataTableResorts" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Resort Name</th>
                    <th>Delete</th>
                    <th>Active</th>
                </tr>
                </thead>
                <tbody>
                
                  @foreach($rows as $data)
                  <tr>
                    <td><a href="/admin/resort/{{$data->resort_id}}">{{$data->resort_name}}</a></td>
                    <td><button class="resortdelete" onclick="btn_del_click({{$data->resort_id}})">Delete</button></td>
                    <td>{{$data->active}}</td>
                  </tr>
                  @endforeach
                  
                
                </tbody>
                <tfoot>
                <tr>
                    <th>Resort Name</th>
                    <th>Delete</th>
                    <th>Active</th>
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


  <div class="modal fade" id="resortmodal" role="dialog">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    
                                <h2>Add new resort</h2>
                                <form id="editresort" action="" method="POST">
                                  <input type="hidden" name="newresort" value="true">
                                  <table class="table table-striped table-responsive">
                                      <tbody><tr>
                                  <td nowrap="nowrap"><b>Name:</b></td>
                                  <td><input type="text" name="resort_name" value=""> <input type="submit" name="change" id="change" value="Add"> </td>
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
        
        $('#dataTableResorts').DataTable({

          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : false,
          'info'        : false,
          'autoWidth'   : false
        });

        $('#cancel').click(function( e ){
          e.preventDefault();
          $('#resortmodal').modal('hide');
        });
        
        $('.resortadd').click(function(e) {
          e.preventDefault();
          console.log("resort add ");
          $('#resortmodal').modal('show');
        });

        
        
    });

    function btn_del_click(id) {
      if (window.confirm("Are you sure you want to delete?")) {
        location.href = '/admin/resorts?delete=' + id;
      }
    }

    </script>