    <li class="tab-content default-form reservation active">
            <form action="?step=2" method="post" class="reservation-form" id="reservation-form">
                      <span class="children select-box" id="resortlist">
                            <input id="resortvalue" class="value-holder" type="text" disabled="disabled" placeholder="Resorts" name="resort">
                            <input type="hidden" id="resort">
                            <input type="hidden" name="onstep" value="1">
                            <i class="fa fa-sort arrow-down"></i>
                            <ul id="resortdropdown" class="select-clone custom-list" >
                            </ul>
                        <select id="resortselect" data-placeholder="Resorts">
                            <option>Resorts</option>
                        </select>
                      </span>
            <span class="children select-box active" id="condolist">
                            <input id="condovalue" class="value-holder" type="text" disabled="disabled" placeholder="Condo" name="condo">
                            <input type="hidden" id="condo">
                            <i class="fa fa-sort arrow-down"></i><ul class="select-clone custom-list" style="display: block;"></ul>
                            <ul id="condodropdown" class="select-clone custom-list" style="display: block;"></ul>
                        <select id="condoselect"  data-placeholder="Condo" disabled="">
                        <option value=""></option></select>
                      </span>

            <span class="arrival calendar">
                        <input id="arrival" type="text" name="start" placeholder="Arrive" data-dateformat="m/d/yy">
                        <i class="fa fa-calendar"></i>
                      </span>
            <span class="departure calendar">
                        <input id="depart" type="text" name="stop" placeholder="Depart" data-dateformat="m/d/yy">
                        <i class="fa fa-calendar"></i>
                      </span>
            <span class="adults select-box small" id="adultlist">
                          <input class="value-holder" type="text" disabled="disabled" placeholder="Adults" id="adultvalue" name="adults">
                          <input type="hidden" id="adults">
                          <i class="fa fa-sort arrow-down"></i>
                          <ul id="adultsdropdown" class="select-clone custom-list" style="display: none;">
                              <li data-value="1">1 adult</li>
                              <li data-value="2">2 adults</li>
                              <li data-value="3">3 adults</li>
                              <li data-value="4">4 adults</li>
                          </ul>
                        <select data-placeholder="Adults">
                          <option value="">Adults</option>
                          <option value="1">1 adult</option>
                          <option value="2">2 adults</option>
                          <option value="3">3 adults</option>
                          <option value="4">4 adults</option>
                        </select>
                      </span>
            <span class="children select-box medium" id="childrenlist">
                          <input class="value-holder" type="text" disabled="disabled" placeholder="Children" id="childrenvalue" name="kids">
                          <input type="hidden" id="kids">
                          <i class="fa fa-sort arrow-down"></i>
                          <ul id="childrendropdown" class="select-clone custom-list" style="display: none">
                              <li data-value="0">0 children</li>
                              <li data-value="1">1 children</li>
                              <li data-value="2">2 childrens</li>
                              <li data-value="3">3 childrens</li>
                              <li data-value="4">4 childrens</li>
                          </ul>
                        <select data-placeholder="Children">
                          <option value="">Children</option>
                          <option value="0">0 children</option>
                          <option value="1">1 children</option>
                          <option value="2">2 childrens</option>
                          <option value="3">3 childrens</option>
                          <option value="4">4 childrens</option>
                        </select>
                      </span>

            <span class="submit-btn">
                        <button id="booknowbtn" class="btn btn-transparent">Book Now</button>
                <!--a href="#" class="advanced">Advanced Search</a-->
                      </span>

        </li>
        <!-- End Hotel -->

        <!-- Start Pricing -->
        <li class="tab-content">
            <div id="pricing">
                <article class="segment no-target segment-title">

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
                        <div id="trip-pricing-subtotal">Subtotal: $5.00</div>
                        <div id="trip-pricing-taxes">Taxes: $5.00</div>
                        <div id="trip-pricing-total">Total: $5.00</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <a id="gobackbtn1" class="bookmystaybtn">Go Back</a>
                        </div>
                        <div class="col-md-6 ">
                            <a class="bookmystaybtn" href="javascript:document.getElementById('reservation-form').submit();">Continue</a>
                        </div>
                    </div>
                </article>
            </div>
        </form>
        </li>
