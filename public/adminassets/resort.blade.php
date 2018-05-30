@include('adminassets.header')
<div class="wrapper">

  @include('adminassets.headeribbon')

 <script language="jscript" type="text/javascript">
    function Confirm()
    {
      var response  = confirm ("Are you sure you want to delete this Resort?");
      if (response == false){
      return 'false';
    }
      return 'true';
    }
 </script>

    <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <h1>
                Resort Edit
              </h1>
              <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Resort Edit</li>
              </ol>
            </section>

            <!-- Main content -->
            <section class="content">
              <!-- Small boxes (Stat box) -->
              <div class="row">

                <div class="box-header">
                  <h3 class="box-title"> <button class="condoadd">Add New Condo</button> </h3>
                </div>
                <div class="box-body">
                    {{--  <!-- div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Edit</a></li>
                            </ul>

                    </div -->  --}}
                    {{--  <div class="tab-content">
                              <div class="tab-pane active" id="tab_1">  --}}

                                    <div class="col-md-12">

                                         <div class="btn-align"><h3>Resort</h3> </h3></div>
                                           <form id="editresort" action="" method="POST">
                                            <input type="hidden" name="resort_id" value="{{$row->resort_id}}">
                                            <table class="table table-striped table-responsive">
                                                <tbody><tr>
                                            <td nowrap="nowrap"><b>Name:</b></td>
                                            <td><input type="text" name="resort_name" value="{{$row->resort_name}}"> <input type="submit" name="change" id="change" value="Update"> </td>
                                            </tr>
                                            </tbody>
                                            </table>
                                            </form>

{{--
                                    </div>
                              </div>  --}}

                              <table id="dataTableResort" class="table table-bordered table-striped">
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

                                  @foreach($condos as $data)
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

                      {{--  </div>
                            <!-- /.tab-content -->
                    </div>  --}}
              </div>
            </section>

        </div>


  @include('adminassets.condomodal', ['resorts' => $resorts])

  @include('adminassets.footer')
