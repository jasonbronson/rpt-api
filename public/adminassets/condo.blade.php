@include('adminassets.header')
<div class="wrapper">

  @include('adminassets.headeribbon')
  
 <script language="jscript" type="text/javascript">
    function Confirm()
    {
    var response  = confirm ("Are you sure you want to delete this Condo?");
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
                Condo Edit
              </h1>
              <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Condo Edit</li>
              </ol>
            </section>
        
            <!-- Main content -->
            <section class="content">
              <!-- Small boxes (Stat box) -->
              <div class="row">

                    <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Edit</a></li>
                            </ul>
                            
                    </div>
                    <div class="tab-content">
                              <div class="tab-pane active" id="tab_1">
                                
                                    <div class="col-md-6">

                                         <div class="btn-align"><h3>Condo</h3> </h3></div>
                                           <form id="editcondo" action="" method="POST">
                                            <input type="hidden" name="condo_id" value="{{$row->condo_id}}">
                                            <table class="table table-striped table-responsive">
                                                <tbody>
                                                <tr>
                                                  <td nowrap="nowrap"><b>Name:</b></td>
                                                  <td><input type="text" name="condo_name" value="{{$row->condo_name}}"></td>
                                                </tr>
                                                <tr>
                                                    <td nowrap="nowrap"><b>Resort Id:</b></td>
                                                    <td><select name="resort_id">
                                                      <?php foreach($resorts as $resort): ?>
                                                      @if($resort->resort_id == $row->resort_id)
                                                      <option value="{{$resort->resort_id}}" selected>{{$resort->resort_name}}</option>
                                                      @else
                                                      <option value="{{$resort->resort_id}}">{{$resort->resort_name}}</option>
                                                      @endif
                                                      <?php endforeach; ?>
                                                      </select> 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td nowrap="nowrap"><b>Condo Bedrooms:</b></td>
                                                    <td><input type="text" name="condo_bedrooms" value="{{$row->condo_bedrooms}}"></td>
                                                </tr>
                                                <tr>
                                                    <td nowrap="nowrap"><b>Condo Booking Fee:</b></td>
                                                    <td><input type="text" name="condo_fee_booking" value="{{$row->condo_fee_booking}}"></td>
                                                </tr>
                                                <tr>
                                                    <td nowrap="nowrap"><b>Condo Impact Fee:</b></td>
                                                    <td><input type="text" name="condo_fee_impact" value="{{$row->condo_fee_impact}}"></td>
                                                </tr>
                                                <tr>
                                                    <td nowrap="nowrap"><b>Condo Tax Rate:</b></td>
                                                    <td><input type="text" name="condo_tax_rate" value="{{$row->condo_tax_rate}}"></td>
                                                </tr>
                                                <tr>
                                                    <td nowrap="nowrap"><b>Condo Min Occupancy:</b></td>
                                                    <td><input type="text" name="condo_min_occupancy" value="{{$row->condo_min_occupancy}}"></td>
                                                </tr>
                                                <tr>
                                                    <td nowrap="nowrap"><b>Condo Max Occupancy:</b></td>
                                                    <td><input type="text" name="condo_max_occupancy" value="{{$row->condo_max_occupancy}}"></td>
                                                </tr>
                                                <tr>
                                                    <td nowrap="nowrap"><b>Condo Min Nights:</b></td>
                                                    <td><input type="text" name="condo_min_nights" value="{{$row->condo_min_nights}}"></td>
                                                </tr>

                                            <td><input type="submit" name="change" id="change" value="Update"></td>
                                            </tr>
                                            </tbody>
                                            </table>
                                            </form>                                           

                                    </div>
                              </div>

                            </div>
                            <!-- /.tab-content -->
  
              </div>
            </section>

        </div>



  @include('adminassets.footer')
