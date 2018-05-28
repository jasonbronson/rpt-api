<div class="modal fade" id="condomodal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        
                    <h2>Add New Condo</h2>
                    <form id="editcondo" action="" method="POST">
                      <input type="hidden" name="newcondo" value="true">
                      <table class="table table-striped table-responsive">
                          <tbody>
                              <tr>
                                  <td><b>Condo Name:</b></td>
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
