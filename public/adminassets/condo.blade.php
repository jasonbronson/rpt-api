@include('adminassets.header')
<div class="wrapper">

  @include('adminassets.headeribbon')
  
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
                              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="true">Rates</a></li>
                            </ul>
                            
                    </div>
                    <div class="tab-content">
                              <div class="tab-pane active" id="tab_1">
                                
                                    <div class="col-md-6">
                                         <div class="btn-align"><h3>Condo</h3> </div>
                                           <form id="editcondo" action="" method="POST">
                                            <input type="hidden" name="condo_id" value="{{$row->condo_id}}">
                                            <input type="hidden" name="edit_condo" value="1">
                                            <table class="table table-striped table-responsive">
                                                <tbody>
                                                <tr>
                                                  <td nowrap="nowrap"><b>Name:</b></td>
                                                  <td><input type="text" name="condo_name" value="{{$row->condo_name}}"></td>
                                                </tr>
                                                <tr>
                                                    <td nowrap="nowrap"><b>Resort Id:</b></td>
                                                    <td><select name="resort_id">
                                                      @foreach($resorts as $resort)
                                                      @if($resort->resort_id == $row->resort_id)
                                                      <option value="{{$resort->resort_id}}" selected>{{$resort->resort_name}}</option>
                                                      @else
                                                      <option value="{{$resort->resort_id}}">{{$resort->resort_name}}</option>
                                                      @endif
                                                      @endforeach
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
                                                    <td nowrap="nowrap"><b>Condo Cleaning Fee:</b></td>
                                                    <td><input type="text" name="condo_fee_cleaning" value="{{$row->condo_fee_cleaning}}"></td>
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

                                            <td><input type="submit" name="change" id="change" value="Update">  </td>
                                            </tr>
                                            </tbody>
                                            </table>
                                            </form>                                           

                                    </div>
                                    <div class="col-md-5 col-md-offset-1">
                                        <div class="btn-align"><h3>Age Groups</h3> </div>
                                        <form id="editagegroups" action="" method="POST">
                                            <input type="hidden" name="agegroups" value="1">
                                            <table class="table table-striped table-responsive">
                                                <tbody>
                                                
                                                  @foreach($age as $item)
                                                  <tr>
                                                  <td nowrap="nowrap"><b>{{$item->agegroup_name}}:</b></td>
                                                  <td> <input type="text" name="restriction_extra_fee[]" value="{{$item->restriction_extra_fee}}">
                                                       <input type="hidden" name="condo_id[]" value="{{$row->condo_id}}">
                                                       <input type="hidden" name="agegroup_id[]" value="{{$item->agegroup_id}}">
                                                  </td>
                                                  </tr>
                                                  <tr>
                                                  <td>Restriction number free</td> 
                                                  <td> <input type="text" name="restriction_num_free[]" value="{{$item->restriction_num_free}}"></td>
                                                  </tr>
                                                  @endforeach
                                                
                                                

                                            <td><input type="submit" name="change" id="change" value="Update">  </td>
                                            </tr>
                                            </tbody>
                                            </table>
                                            </form> 
                                    </div>
                              </div>

                              <div class="tab-pane" id="tab_2">
                                   
                                    <div class="col-md-6">
                                        <p>Existing Rates <select id="existingrates" name="name"></p>
                                         <div class="btn-align"><h3>Condo Rates</h3></div>
                                         <p>
                                            <option value="new">Add New Rate</option>
                                            @foreach($rates as $rate)
                                              <option value="{{$rate->rate_name}}">{{$rate->rate_name}}</option>
                                            @endforeach
                                            </select>
                                          </p>
                                           <form id="condorates">
                                            <input type="hidden" id="condo_id" name="condo_id" value="{{$row->condo_id}}">
                                            <input type="hidden" id="rate_id" name="rate_id" value="">
                                            <table class="table table-striped table-responsive">
                                                <tbody><tr>
                                                    <td><b>Resort:</b></td>
                                                    <td>@foreach($resorts as $resort)
                                                        @if($resort->resort_id == $row->resort_id)
                                                        {{$resort->resort_name}}
                                                        @else
                                                        @endif
                                                        @endforeach 
                                                        </td>
                                                  </tr>
                                                  <tr>
                                                    <td><b>Condo:</b></td>
                                                    <td> {{$row->condo_name}}</td>
                                                  </tr>
                                                  <tr>
                                                    <td><b>Rate Name:</b></td>
                                                    <td><input type="text" name="rate_name" size="45"></td>
                                                  </tr>
                                                  <tr>
                                                    <td><b>Sunday:</b></td>
                                                    <td><input type="text" size="5" name="rate_price_sunday" value=""></td>
                                                  </tr>
                                                  <tr>
                                                    <td><b>Monday:</b></td>
                                                    <td><input type="text" size="5" name="rate_price_monday" value=""></td>
                                                  </tr>
                                                  <tr>
                                                    <td><b>Tuesday:</b></td>
                                                    <td><input type="text" size="5" name="rate_price_tuesday" value=""></td>
                                                  </tr>
                                                  <tr>
                                                    <td><b>Wednesday:</b></td>
                                                    <td><input type="text" size="5" name="rate_price_wednesday" value=""></td>
                                                  </tr>
                                                  <tr>
                                                    <td><b>Thursday:</b></td>
                                                    <td><input type="text" size="5" name="rate_price_thursday" value=""></td>
                                                  </tr>
                                                  <tr>
                                                    <td><b>Friday:</b></td>
                                                    <td><input type="text" size="5" name="rate_price_friday" value=""></td>
                                                  </tr>
                                                  <tr>
                                                    <td><b>Saturday:</b></td>
                                                    <td><input type="text" size="5" name="rate_price_saturday" value=""></td>
                                                  </tr>
                                                  <tr>
                                                    <td><b>Min Nights:</b></td>
                                                    <td><input type="text" size="5" name="rate_min_nights" value=""> </td>
                                                  </tr>
                                                  <tr>
                                                    <td><b>Price Overide:</b></td>
                                                    <td><input type="radio" name="rate_price_override" value="n">No 
                                                        <input type="radio" name="rate_price_override" value="y">Yes 
                                                        &nbsp;(This rate will be applied to a number of days equal to the minimum night stay if the stay overlaps this rate)</td>
                                                  </tr>
                                                  <tr>
                                                    <td></td>
                                                    <td><input type="button" id="saverates" name="submit" value="Save"> <input type="button" name="delete" id="deleterates" value="Delete"></td>
                                                  </tr>
                                              </tbody>
                                            </tbody>
                                            </table>
                                            </form>                                           

                                    </div>

                                    <div class="col-md-6 border">
                                      
                                      <div class="panel panel-default setratesform">
                                            <div class="panel-heading">Set The Rate Dates</div>
                                            <form id="setratesform">
                                              <div class="panel-body">
                                                      <p>Here you can set or unset the rates for each rate name dates</p><br><br>
                                                      <div class="input-daterange input-group" id="datepicker">
                                                          <input type="text" class="input-sm form-control" name="start" />
                                                          <span class="input-group-addon">to</span>
                                                          <input type="text" class="input-sm form-control" name="end" />
                                                      </div>
                                                      <br>
                                                      <input type="button" id="setrates" name="submit" value="Set"> &nbsp;
                                                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                      <input type="button" id="unsetrates" name="submit" value="UnSet"> 

                                              </div>
                                            </form>
                                      </div>

                                      <div class="panel panel-default">
                                          <div class="panel-heading">Rate Prices</div>
                                          <div class="panel-body">
                                              <table id="ratepricestable">
                                              
                                              </table> 

                                          </div>
                                    </div>

                                    </div>
                              </div>

                            </div>
                            <!-- /.tab-content -->
  
              </div>
            </section>

        </div>

      
  

  @include('adminassets.footer')
