                  <li class="tab-content active">
                      <form action="?step=3" method="post" class="reservationinformation-form" id="reservationinformation-form">

                            <input type="hidden" name="onstep" value="2">
                      <article class="information segment no-target segment-title">
                          <div class="row text-center">
                              <div class="col-md-6 col-md-offset-2">
                                  <legend>Your Information </legend><h5>Reservation Name Must Match Credit Card</h5>
                                  <div class='form-row'>
                                      <div class='form-group '>

                                          <div class="col-md-6">
                                              <label class='control-label'>First Name:</label>
                                          </div>
                                          <div class="col-md-6">
                                              <input class='form-control' type='text' name="fname" required value="{{$fname}}">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6 col-md-offset-2">
                                  <div class='form-row'>
                                      <div class='form-group required'>
                                          <div class="col-md-6">
                                              <label class='control-label'>Last Name:</label>
                                          </div>
                                          <div class="col-md-6">
                                              <input class='form-control' type='text' name="lname" value="{{$lname}}">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6 col-md-offset-2">
                                  <div class='form-row'>
                                      <div class='form-group required'>
                                          <div class="col-md-6">
                                              <label class='control-label'>Email Address:</label>
                                          </div>
                                          <div class="col-md-6">
                                              <input class='form-control' type='email' name="email" value="{{$email}}">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!--div class="col-md-6 col-md-offset-2">
                                  <div class='form-row'>
                                      <div class='form-group required'>

                                          <div class="col-md-6">
                                              <label class='control-label'>Email Verify:</label>
                                          </div>
                                          <div class="col-md-6">
                                              <input class='form-control' type='text' name="emailverify">
                                          </div>
                                      </div>
                                  </div>
                              </div-->
                              <div class="col-md-6 col-md-offset-2">
                                  <div class='form-row'>
                                      <div class='form-group required'>

                                          <div class="col-md-6">
                                              <label class='control-label'>Daytime Phone:</label>
                                          </div>
                                          <div class="col-md-6">
                                              <input class='form-control' type='text' name="dayphone" value="{{$dayphone}}">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6 col-md-offset-2">
                                  <div class='form-row'>
                                      <div class='form-group required'>

                                          <div class="col-md-6">
                                              <label class='control-label'>Evening Phone:</label>
                                          </div>
                                          <div class="col-md-6">
                                              <input class='form-control' type='text' name="eveningphone" value="{{$eveningphone}}">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6 col-md-offset-2">
                                  <div class='form-row'>
                                      <div class='form-group required'>

                                          <div class="col-md-6">
                                              <label class='control-label'>Fax:</label>
                                          </div>
                                          <div class="col-md-6">
                                              <input class='form-control' type='text' name="fax" value="{{$fax}}">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6 col-md-offset-2">
                                  <div class='form-row'>
                                      <div class='form-group required'>

                                          <div class="col-md-6">
                                              <label class='control-label'>How did you hear about us?</label>
                                          </div>
                                          <div class="col-md-6">
                                              <select class="input-md col-sm-10" id="select-1497923592515" name="how_did_you_hear">
                                                  <option selected="">Select</option>
                                                  <?php 
                                                  $howdidyouhear = array("Arizona Republic Travel Section",
                                                  "Arizona Tourist Newspaper",
                                                  "Craigslist",
                                                  "Google PAY-PER-CLICK (Paid Banner)",
                                                  "Google search",
                                                  "Mi Tierra Restaurant",
                                                  "Recommendation from friend",
                                                  "Repeat customer",
                                                  "Rocky Point Online Website",
                                                  "Rocky Point Times Magazine",
                                                  "Tucson Star",
                                                  "Yahoo search",
                                                  "Yahoo PAY-PER-CLICK (Paid Banner",
                                                  "mexonline.com",
                                                  "VRBO",
                                                  "Zurouna - MED Club Publication",
                                                  "Other");
                                                  ?>
                                                  @foreach($howdidyouhear as $value)
                                                    @if($how_did_you_hear == $value)
                                                        <option selected>{{$value}}</option>
                                                    @else
                                                        <option>{{$value}}</option>    
                                                    @endif
                                                  @endforeach
                                                  
                                              </select>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-md-6">
                                  <a href="?step=1" class="bookmystaybtn">Go Back</a>
                              </div>
                              <div class="col-md-6 ">
                                  <a class="bookmystaybtn" href="javascript:document.getElementById('reservationinformation-form').submit();">Continue</a>
                              </div>
                          </div>

                      </article>
                      </form>
                  </li>

