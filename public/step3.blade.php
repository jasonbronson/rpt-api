                  <!--  Start Billing -->
                  <li class="tab-content active">
                      <form action="?step=4" method="post" class="reservationbilling-form" id="reservationbilling-form">

                            <input type="hidden" name="onstep" value="3">
                      <article class="information segment no-target segment-title">
                          <div class="row text-left">
                              <div class="col-md-6 col-md-offset-2">
                                  <legend>Billing Address (Must Match Your Credit Card)</legend>
                                  <div class='form-row'>
                                      <div class='form-group required'>
                                          <div class="col-md-6">
                                              <label class='control-label'>Address:</label>
                                          </div>
                                          <div class="col-md-6">
                                              <input class='form-control' type='text' name="address1" value="{{$address1}}">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6 col-md-offset-2">
                                  <div class='form-row'>
                                      <div class='form-group required'>
                                          <div class="col-md-6">
                                              <label class='control-label'>Address 2:</label>
                                          </div>
                                          <div class="col-md-6">
                                              <input class='form-control' type='text' name="address2" value="{{$address2}}">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6 col-md-offset-2">
                                  <div class='form-row'>
                                      <div class='form-group required'>
                                          <div class="col-md-6">
                                              <label class='control-label'>City:</label>
                                          </div>
                                          <div class="col-md-6">
                                              <input class='form-control' type='text' name="city" value="{{$city}}">
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <div class="col-md-6 col-md-offset-2">
                                  <div class='form-row'>
                                      <div class='form-group required'>
                                          <div class="col-md-6">
                                              <label class='control-label'>State:</label>
                                          </div>
                                          <div class="col-md-6">
                                              <select class="input-md col-sm-4" name="state">
                                                  <option value="" selected=""></option>
                                                <?php 
                                                $states = array("AK","AL","AR","AZ","CA","CO","CT","DC","DE","FL","GA","HI","IA","ID","IL","IN","KS","KY","LA","MA","MD","ME","MI","MN","MO","MS","MT","NC","ND","NE","NH","NJ","NM","NV","NY","OH","OK","OR","PA","PR","RI","SC","SD","TN","TX","UT","VA","VI","VT","WA","WI","WV","WY","-","BC","MB","NB","NL","NT","NS","ON","PE","QC","SK","YT","VI","-","AG","BC","BS","CH","CL","CM","CO","CS","DF","DG","GR","GT","HG","JA","MI","MO","MX","NA","NL","OA","PU","QR","QT","SI","SL","SO","TB","TL","TM","VE","YU","ZA","Other");
                                                ?>
                                                  @foreach($states as $value)
                                                    @if($state == $value)
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
                              <div class="col-md-6 col-md-offset-2">
                                  <div class='form-row'>
                                      <div class='form-group required'>
                                          <div class="col-md-6">
                                              <label class='control-label'>Zip:</label>
                                          </div>
                                          <div class="col-md-6">
                                              <input class='form-control' type='text' name="zip" value="{{$zip}}">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6 col-md-offset-2">
                                  <div class='form-row'>
                                      <div class='form-group required'>
                                          <div class="col-md-6">
                                              <label class='control-label'>Country:</label>
                                          </div>
                                          <div class="col-md-6">
                                              <select class="input-md col-sm-12" name="country">
                                                  <?php 
                                                  $countries = array("US" => "United States","AF" => "Afghanistan","AL" => "Albania","DZ" => "Algeria","AS" => "American Samoa","AD" => "Andorra","AO" => "Angola","AI" => "Anguilla","AQ" => "Antarctica","AG" => "Antigua/Barbuda","AR" => "Argentina","AM" => "Armenia","AW" => "Aruba","AU" => "Australia","AT" => "Austria","AZ" => "Azerbaijan","BS" => "Bahamas","BH" => "Bahrain","BD" => "Bangladesh","BB" => "Barbados","BY" => "Belarus","BE" => "Belgium","BZ" => "Belize","BJ" => "Benin","BM" => "Bermuda","BT" => "Bhutan","BO" => "Bolivia","BA" => "Bosnia","BW" => "Botswana","BV" => "Bouvet Island","BR" => "Brazil","IO" => "British Indian Ocean Territory","WI" => "British West Indies","BN" => "Brunei Darussalam","BG" => "Bulgaria","BF" => "Burkina Faso","BU" => "Burma","BI" => "Burundi","KH" => "Cambodia","CM" => "Cameroon","CA" => "Canada","CV" => "Cape Verde","KY" => "Cayman Islands","CF" => "Central Africa","TD" => "Chad","CL" => "Chile","CN" => "China","CX" => "Christmas Island","CC" => "Cocos (Keeling) Islands","CO" => "Colombia","KM" => "Comoros","CG" => "Congo","CK" => "Cook Islands","CR" => "Costa Rica","CI" => "Cote D'Ivoire","HR" => "Croatia","CU" => "Cuba","CY" => "Cyprus","CZ" => "Czech Republic","DK" => "Denmark","DJ" => "Djibouti","DM" => "Dominica","DO" => "Dominican Republic","TP" => "East Timor","EC" => "Ecuador","EG" => "Egypt","SV" => "El Salvador","GB" => "England","GQ" => "Equatorial Guinea","ER" => "Eritrea","EE" => "Estonia","ET" => "Ethiopia","FO" => "Faeroe Islands","FK" => "Falkland Islands","FJ" => "Fiji","FI" => "Finland","FR" => "France","PF" => "French Polynesia","TF" => "French Southern Territories","GA" => "Gabon","GM" => "Gambia","XA" => "Gaza","GE" => "Georgia","DE" => "Germany","GH" => "Ghana","GI" => "Gibraltar","GR" => "Greece","GL" => "Greenland","GD" => "Grenada","GP" => "Guadeloupe","GU" => "Guam","GT" => "Guatemala","GF" => "Guiana","GN" => "Guinea","GW" => "Guinea-Bissau","GY" => "Guyana","HT" => "Haiti","HM" => "Heard And Mcdonald Islands","XH" => "Held Territories","HN" => "Honduras","HK" => "Hong Kong","HU" => "Hungary","IS" => "Iceland","IN" => "India","XI" => "Indian Ocean Islands","ID" => "Indonesia","IR" => "Iran","IQ" => "Iraq","IE" => "Ireland","IL" => "Israel","IT" => "Italy","JM" => "Jamaica","JP" => "Japan","JO" => "Jordan","KZ" => "Kazakhstan","KE" => "Kenya","KI" => "Kiribati","KR" => "Korea","KW" => "Kuwait","KG" => "Kyrgyzstan","LA" => "Laos","LV" => "Latvia","LB" => "Lebanon","LS" => "Lesotho","LR" => "Liberia","LY" => "Libya","LI" => "Liechtenstein","LT" => "Lithuania","LU" => "Luxembourg","MO" => "Macau","MK" => "Macedonia","MG" => "Madagascar","MW" => "Malawi","MY" => "Malaysia","MV" => "Maldives","ML" => "Mali","MT" => "Malta","MH" => "Marshall Islands","MQ" => "Martinique","MR" => "Mauritania","MU" => "Mauritius","YT" => "Mayotte","MX" => "Mexico","FM" => "Micronesia","MD" => "Moldova","MC" => "Monaco","MN" => "Mongolia","MS" => "Montserrat","MA" => "Morocco","MZ" => "Mozambique","MM" => "Myanmar","NA" => "Namibia","NR" => "Nauru","NP" => "Nepal","NL" => "Netherlands","AN" => "Netherlands Antilles","NC" => "New Caledonia","NZ" => "New Zealand","NI" => "Nicaragua","NE" => "Niger","NG" => "Nigeria","NU" => "Niue","NF" => "Norfolk Island","KP" => "North Korea","XB" => "Northern Ireland","MP" => "Northern Mariana Islands","NO" => "Norway","OM" => "Oman","PK" => "Pakistan","PW" => "Palau","PA" => "Panama","PG" => "PapuaNew Guinea","PY" => "Paraguay","PE" => "Peru","PH" => "Philippines","PN" => "Pitcairn","PL" => "Poland","PT" => "Portugal","PR" => "Puerto Rico","QA" => "Qatar","RE" => "Reunion","RO" => "Romania","RU" => "Russia","RW" => "Rwanda","LC" => "SaintLucia","SM" => "San Marino","ST" => "Sao Tome And Principe","SA" => "Saudi Arabia","WY" => "Scotland","SN" => "Senegal","SC" => "Seychelles","SL" => "Sierra Leone","SG" => "Singapore","SK" => "Slovak Republic","SI" => "Slovenia","SB" => "Solomon Islands","SO" => "Somalia","ZA" => "South Africa","GS" => "South Georgia","ES" => "Spain","LK" => "Sri Lanka","SH" => "St. Helena","KN" => "St. Kitts &amp; Nevis","PM" => "St. Pierre","VC" => "St. Vincent &amp; The Grendadines","SD" => "Sudan","SR" => "Suriname","SJ" => "Svalbard And Jan Mayen Islands","SZ" => "Swaziland","SE" => "Sweden","CH" => "Switzerland","SY" => "Syria","TW" => "Taiwan","TJ" => "Tajikistan","TZ" => "Tanzania","TH" => "Thailand","TG" => "Togo","TK" => "Tokelau","TO" => "Tonga","TT" => "Trinidad And Tobago","TN" => "Tunisia","TR" => "Turkey","TM" => "Turkmenistan","TC" => "Turks And Caicos Islands","TV" => "Tuvalu","UM" => "U.S. Minor Outlying Islands","UG" => "Uganda","UA" => "Ukraine","AE" => "United Arab Emirates","UY" => "Uruguay","UZ" => "Uzbekistan","VU" => "Vanuatu","VA" => "Vatican City State","VE" => "Venezuela","VN" => "Vietnam","VG" => "Virgin Islands (British)","VI" => "Virgin Islands (U.S.)","WX" => "Wales","WF" => "Wallis And Futuna Islands","EH" => "Western Sahara","WS" => "Western Samoa","YE" => "Yemen","YU" => "Yugoslavia","ZR" => "Zaire","ZM" => "Zambia","ZW" => "Zimbabwe");
                                                  ?>
                                                  @foreach($countries as $countryabr => $countryname)
                                                    @if($countryabr == $country)
                                                        <option value="{{$countryabr}}" selected>{{$countryname}}</option>
                                                    @else
                                                        <option value="{{$countryabr}}">{{$countryname}}</option>
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
                                  <a href="?step=2" class="bookmystaybtn">Go Back</a>
                              </div>
                              <div class="col-md-6">
                                  <a class="bookmystaybtn" href="javascript:document.getElementById('reservationbilling-form').submit();">Continue</a>
                              </div>
                          </div>

                      </article>
                      </form>
                  </li>
                  <!-- End Billing -->
