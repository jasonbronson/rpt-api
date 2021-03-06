@include('adminassets.header')
<div class="wrapper">

  @include('adminassets.headeribbon')
 
  
 <script language="jscript" type="text/javascript">
    function Confirm()
    {
    var response  = confirm ("Are you sure you want to delete this Reservation?");
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
              <div class="row" id="reservationscreen">

                    <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Reservation</a></li>
                              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Credit Charge History</a></li>
                              <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Customer History</a></li>
                            </ul>
                            <div class="tab-content">
                              <div class="tab-pane active" id="tab_1">
                              <div class="col-md-4">
                                <form id="seasonratesform" name="seasonratesform">
                                    <input name="reservationid" type="hidden" value="{{$id}}"> 
                                    <table class="table table-striped table-responsive">
                                        <thead>
                                            <tr>
                                                <td colspan="5"></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td bgcolor="#6699FF"><font color="#FFFFFF"><b>Season</b></font></td>
                                                <td bgcolor="#6699FF"><font color="#FFFFFF"><b>Date</b></font></td>
                                                <td align="right" bgcolor="#6699FF"><font color="#FFFFFF"><b>Price</b></font></td>
                                                <td align="right" bgcolor="#6699FF"><font color="#FFFFFF"><b>Extra</b></font></td>
                                                <td align="right" bgcolor="#6699FF"><font color="#FFFFFF"><b>Total</b></font></td>
                                            </tr>
                                            <?php 
                                                  $count = 0;  
                                                  foreach($quote['Daily'] as $field => $value):
                                                    $count++;
                                                    if(isset($value['Date'])){
                                                        $date = $value['Date'];
                                                    }else{
                                                        $date = $field;
                                                    }
                                                ?>
                                            <tr>
                                                <td><input name="Season{{$count}}" type="hidden" value="{{$value['Season']}}">{{$value['Season']}}</td>
                                                <td><input name="Date{{$count}}" type="hidden" value="{{$date}}"> {{$date}}</td>
                                                <td align="right"><input name="Price{{$count}}" size="8" type="text" value="{{$value['Price']}}"></td>
                                                <td align="right"><input name="Extra{{$count}}" size="8" type="text" value="{{$value['Extra']}}"></td>
                                                <td align="right" class="RatesTotal{{$count}}">${{$value['Total']}}</td>
                                            </tr>
                                                <?php endforeach; ?>
                                            <tr>
                                                <td colspan="4"><b>Subtotal</b></td>
                                                <td align="right" class="reservationSubtotal"><b>${{$quote['Subtotal']}}</b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><b>Tax</b></td>
                                                <td align="right" class="reservationTax">${{$quote['Tax']}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><b>Booking Fee</b></td>
                                                <td align="right"><input name="BookingFee" size="5" type="text" value="{{$quote['BookingFee']}}"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><b>Cleaning Fee</b></td>
                                                <td align="right"><input name="CleaningFee" size="5" type="text" value="{{$quote['CleaningFee']}}"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><b>Impact Fee</b></td>
                                                <td align="right" colspan="3"><input name="ImpactFee" size="5" type="text" value="{{$quote['ImpactFee']}}"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><b>Total</b></td>
                                                <td align="right" class="reservationTotal"><b>${{$quote['Total']}}</b></td>
                                            </tr>
                                            <tr>
                                            <td colspan="6"></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td align="right" colspan="3"><input name="Subtotal" type="hidden" value="{{$quote['Subtotal']}}"> <input name="Tax" type="hidden" value="{{$quote['Tax']}}"> <input name="Total" type="hidden" value="{{$quote['Total']}}"> <input name="condo" type="hidden" value="{{$data->condo_id}}"> <input id="seasonratesbutton" type="button" value="Change Pricing"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6"><input class="colorred" id="chargecreditbutton" type="button" value="Charge Order"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                                <div>
                                    <p></p>
                                </div>
                                <div>
                                    <hr>
                                    <form id="formadditionalcharges" name="formadditionalcharges">
                                    <input type="hidden" name="reservation_id" value="{{$id}}">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>Additional Charge Description</td>
                                                    <td></td>
                                                    <td colspan="4"><input name="add_charge_description" type="text"></td>
                                                </tr>
                                                <tr>
                                                    <td>Additional Charge Amount $</td>
                                                    <td></td>
                                                    <td align="right" class="reservationTotal"><input name="add_charge_amount" type="text"></td>
                                                </tr>
                                                <tr>
                                                    <td><select name="add_charge_type">
                                                        <option value='A'>
                                                            Authorization
                                                        </option>
                                                        <option value='C'>
                                                            Charge
                                                        </option>
                                                    </select></td>
                                                    <td></td>
                                                    <td align="right"><button id="chargeadditional" class="colorred">Charge Additional</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                                    
                                    <div class="col-md-6">

                                        <div class="btn-align"><h3>Reservation {{$id}}</h3> 
                                            <select id="reservationstatus">
                                            <?php $status = array("c" => "Complete", "p" => "Pending", "n" => "New"); ?>
                                            @foreach($status as $key => $value):
                                                @if($key == $data->order_status)
                                                    <option value="{{$key}}" selected>{{$value}}</option>
                                                @else 
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endif
                                            @endforeach
                                        </select> 
                                        
                                        <img src='' width="20%" height="0px">
                                        <input type="button" class="colorred" value="Delete reservation" id="deletereservation">
                                       </div>
                                        <form id="reservationchangeform">
                                        <input type="hidden" id="reservationid" name="reservationid" value="{{$id}}">
                                        <table class="table table-striped table-responsive">
                                                <tbody><tr>
                                            <td nowrap="nowrap"><b>Status:</b></td>
                                            <td>{{$data->order_status_full}}</td>
                                            </tr>
                                            <tr>
                                            <td nowrap="nowrap"><b>Submitted:</b></td>
                                            <td>{{$data->order_date_submit}}</td>
                                            </tr>
                                                <tr>
                                            <td nowrap="nowrap"><b>Resort:</b></td>
                                            <td><select name="resort" id="reservationresortselect"> 
                                                
                                                @foreach($resorts as $field => $name)
                                                    @if($field == $data->resort_id)
                                                        <option value="{{$field}}" selected>{{$name}}</option> 
                                                    @else
                                                        <option value="{{$field}}">{{$name}}</option>   
                                                    @endif       
                                                @endforeach
                                            </select></td>
                                            </tr>
                                                <tr>
                                            <td nowrap="nowrap"><b>Condo:</b></td>
                                            <td>
                                                <select name="condo" id="reservationchangeselect"> 
                                                    @foreach($condos as $field => $name)
                                                        @if($field == $data->condo_id)
                                                            <option value="{{$field}}" selected>{{$name}}</option> 
                                                        @else
                                                            <option value="{{$field}}">{{$name}}</option>   
                                                        @endif   
                                                    @endforeach
                                                     </select></td>
                                            </tr>
                                                <tr>
                                            <td nowrap="nowrap"><b>Adults:</b></td>
                                            <td><select name="adults" id="reservationadultsselect"> 
                                                    @for($a =1; $a < 10; $a++) 
                                                        @if($a == $data->adults)
                                                            <option value="{{$a}}" selected>{{$a}}</option> 
                                                        @else
                                                            <option value="{{$a}}">{{$a}}</option>   
                                                        @endif  
                                                        
                                                    @endfor
                                                </select></td>
                                            </tr>
                                                <tr>
                                            <td nowrap="nowrap"><b>Children:</b></td>
                                            <td><select name="kids" id="reservationkidsselect">
                                                @for($a =0; $a < 10; $a++) 
                                                    @if($a == $data->kids)
                                                        <option value="{{$a}}" selected>{{$a}}</option> 
                                                    @else
                                                        <option value="{{$a}}">{{$a}}</option>   
                                                    @endif  
                                                    
                                                @endfor
                                                
                                             </select></td>
                                            </tr>
                                                <tr>
                                            <td nowrap="nowrap"><b>Arrival:</b></td>
                                            <td>
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                      <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" name="start" class="form-control pull-right" value="{{$data->arrive}}" id="datepicker">
                                                  </div>
                                            </td>
                                            </tr>
                                                <tr>
                                            <td nowrap="nowrap"><b>Departure:</b></td>
                                            <td>
                                                    <div class="input-group date">
                                                            <div class="input-group-addon">
                                                              <i class="fa fa-calendar"></i>
                                                            </div>
                                                            <input type="text" name="stop" class="form-control pull-right" value="{{$data->depart}}" id="datepicker2">
                                                          </div>
                                            </td>
                                            </tr>
                                            <tr><td></td> <td><input type="submit" name="change" value="Change"></td></tr>
                                                </tbody></table>
                                            </form>    



                                                <div class="btn-align"><h3>Guest Information</h3> </h3></div>
                                           <form id="guestchangeform">
                                            <input type="hidden" name="reservationid" value="{{$id}}">
                                            <table class="table table-striped table-responsive">
                                                <tbody><tr>
                                            <td nowrap="nowrap"><b>Name:</b></td>
                                            <td> <input type="text" name="first_name" value="{{$data->first_name}}">
                                            <input type="text" name="last_name" value="{{$data->last_name}}">
                                            </td>
                                            </tr>
                                                <tr>
                                            <td nowrap="nowrap"><b>Email:</b></td>
                                            <td><input type="text" name="email" value="{{$data->email}}"></td>
                                            </tr>
                                                <tr>
                                            <td nowrap="nowrap"><b>Daytime Phone:</b></td>
                                            <td><input type="text" name="phone_day" value="{{$data->phone_day}}"></td>
                                            </tr>
                                                <tr>
                                            <td nowrap="nowrap"><b>Evening Phone:</b></td>
                                            <td><input type="text" name="phone_eve" value="{{$data->phone_eve}}"></td>
                                            </tr>
                                                <tr>
                                            <td nowrap="nowrap"><b>Fax:</b></td>
                                            <td><input type="text" name="phone_fax" value="{{$data->phone_fax}}"></td>
                                            </tr>
                                                <tr>
                                            <td nowrap="nowrap"><b>Address:</b></td>
                                            <td><input type="text" name="address1" value="{{$data->address1}}" class="col-md-8"></td>
                                            </tr>
                                                <tr>
                                            <td nowrap="nowrap"><b>City:</b></td>
                                            <td><input type="text" name="city" value="{{$data->city}}"></td>
                                            </tr>
                                                <tr>
                                            <td nowrap="nowrap"><b>State/Prov:</b></td>
                                            <td><input type="text" name="state" value="{{$data->state}}"></td>
                                            </tr>
                                                <tr>
                                            <td nowrap="nowrap"><b>Zip/Postal Code:</b></td>
                                            <td><input type="text" name="zip" value="{{$data->zip}}"></td>
                                            </tr>
                                                <tr>
                                            <td nowrap="nowrap"><b>Country:</b></td>
                                            <td>

                                                    <select class="input-md col-sm-12" name="country">
                                                        @foreach($countries as $v)
                                                          @if($v->abbrev == $data->country)
                                                            <option value="{{$v->abbrev}}" selected>{{$v->full}}</option>
                                                          @else 
                                                            <option value="{{$v->abbrev}}">{{$v->full}}</option>
                                                          @endif
                                                        @endforeach      
                                                            
                                                    </select>
                                            </tr>
                                            <tr><td></td><td><input type="button" name="changeguestbutton" id="changeguestbutton" value="Update"></td></tr>
                                                </tbody></table>
                                            </form>

                                                <div class="btn-align"> <h3>Credit Card</h3>  </div>
                                                <form id="creditcardchangeform">
                                                <input type="hidden" name="reservationid" value="{{$id}}">
                                        <table class="table table-striped table-responsive">
                                                <tbody><tr>
                                            <td nowrap="nowrap"><b>Name:</b></td>
                                            <td><input type="text" name="cc_name" value="{{$data->cc_name}}"></td>
                                            </tr>
                                                <tr>
                                            <td nowrap="nowrap"><b>Number:</b></td>
                                            <td><input type="text" name="cc_num" value="{{substr($data->cc_num, -4)}}"></td>
                                            </tr>
                                                <tr>
                                            <td nowrap="nowrap"><b>Expiration:</b></td>
                                            <td><input type="text" name="cc_exp" value="{{$data->cc_exp}}"></td>
                                            </tr>
                                                <tr>
                                            <td nowrap="nowrap"><b>CVC:</b></td>
                                            <td><input type="text" name="cc_cvc" value="{{$data->cc_cvc}}"></td>
                                            </tr>
                                            <tr><td></td><td> <input type="button" name="changeccbutton" id="changeccbutton" value="Change"></td></tr>
                                                </tbody></table> 
                                            </form>

                                            <h2>Other</h2>
                                        <table class="table table-striped table-responsive">
                                                <tbody><tr>
                                            <td nowrap="nowrap"><b>Comments:</b></td>
                                            <td>{{$data->instructions}}</td>
                                            </tr>
                                                <tr>
                                            <td nowrap="nowrap"><b>Accepted Policies?:</b></td>
                                            <td>{{$data->agree_policies}}</td>
                                            </tr>
                                                <tr>
                                            <td nowrap="nowrap"><b>IP Address:</b></td>
                                            <td>{{$data->ip}}</td>
                                            </tr>
                                                <tr>
                                            <td nowrap="nowrap"><b>User Agent:</b></td>
                                            <td>{{$data->user_agent}}</td>
                                            </tr>
                                                </tbody></table>
                                           

                                    </div>
                              </div>
                              <!-- /.tab-pane -->
                              <div class="tab-pane" id="tab_2">
                                    <div class="box box-primary">
                                            <div class="box-header">
                                              
                                            </div>
                                            <div class="box-body">
                                                <table class="table table-striped table-responsive">
                                                    <thead>
                                                    <th>Date</th>    
                                                    <th>Amount</th>
                                                    <th>Details</th>
                                                    </thead>    
                                                    @foreach($cchistory as $value)
                                                      <tr> <td>{{$value->datetime}}</td> <td>{{$value->amount}}</td> <td>{{$value->merchantdetails}} {{$value->header}}</td></tr>
                                                    @endforeach
                                                </table>    
                                            </div>
                                            <!-- /.box-body -->
                                          </div>
                              </div>
                              <!-- /.tab-pane -->
                              <div class="tab-pane" id="tab_3">
                                    <div class="box box-primary">
                                            <div class="box-header">
                                              
                                            </div>
                                            <div class="box-body">
                                                <table class="table table-striped table-responsive">
                                                    <thead>
                                                    <th>Date</th>   
                                                    <th>Details</th>
                                                    </thead>    
                                                    @foreach($orderhistory as $value)
                                                      <tr> <td>{{$value->date}}</td> <td><pre>{{$value->info}}</pre></td> </tr>
                                                    @endforeach
                                                </table>    
                                            </div>
                                            <!-- /.box-body -->
                                          </div>
                              </div>

                            </div>
                            <!-- /.tab-content -->
                          </div>
  
              </div>
            </section>

        </div>


        <div class="modal fade" id="reservationchangemodal" role="dialog">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                   
                    
                      <p class="reservationchangesummary"></p>
                   
                                <h2 id="availability-header" class="title-main">Travel Dates: <span class="arrival-date"></span> to <span class="depart-date"></span></h2>
                                <div id="travel-date-header" role="heading" aria-level="3"> Trip Details </div>
                                <div class="trip-details">
                                    <table id="trip-pricing-table">
                                        <tbody>
            
                                        </tbody>
                                    </table>
                                </div>
                                <div id="selected-price-summary">
            
                                    <div class="trip-includes-details"></div>
            
                                    <div class="traveller-information">(includes <span class="num_adults"></span> adult traveler &amp; <span class="num_children"></span> children)</div>
            
            
                                </div>
            
                                <div id="resort-header">
                                    <div id="resort-type-header" role="heading" aria-level="3">
                                        <span class="trip-resort-name"></span> - <span class="trip-condo-name"></span>          </div>
                                </div>
            
                                <div class="trip-pricing-totals">
                                    <div id="trip-pricing-subtotal">Subtotal: $0.00</div>
                                    <div id="trip-pricing-taxes">Taxes: $0.00</div>
                                    <div id="trip-pricing-total">Total: $0.00</div>
                                </div>
            
                                <div class="row modalrow">
                                    <div class="col-md-6">
                                        <a id="cancel" class="bookmystaybtn">Cancel</a>
                                    </div>
                                    <div class="col-md-6 ">
                                        <a class="bookmystaybtn" href="#" id="reservationchangecontinue">Continue</a>
                                    </div>
                                </div>
                           
                        
                    
                  </div>
                </div>
        </div>


  @include('adminassets.footer')

  <script>
        $(function () {
          //Initialize Select2 Elements
          /*$('.select2').select2()
      
          //Datemask dd/mm/yyyy
          $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
          //Datemask2 mm/dd/yyyy
          $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
          //Money Euro
          $('[data-mask]').inputmask()*/

          $('#reservationresortselect').change(function(){
            
          });
      
          //Date range picker
          $('#reservation').daterangepicker()
          //Date range picker with time picker
          $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
          //Date range as a button
          $('#daterange-btn').daterangepicker(
            {
              ranges   : {
                'Today'       : [moment(), moment()],
                'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate  : moment()
            },
            function (start, end) {
              $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
          )
      
          //Date picker
          $('#datepicker').datepicker({
            autoclose: true
          })
          $('#datepicker2').datepicker({
            autoclose: true
          })
      
      
        })
      </script>