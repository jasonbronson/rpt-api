/**
 * AdminLTE Demo Menu
 * ------------------
 * You should not use this file in production.
 * This file is for demo purposes only.
 */
$(document).ready(function(){

  $('#reservationchangeform').submit(function( e ){
    e.preventDefault();
    ChangeReservation(false);
  });

  $('#cancel').click(function( e ){
    e.preventDefault();
    $('#reservationchangemodal').modal('hide');
  });

  $('#chargecreditbutton').click(function( e ){
    e.preventDefault();

    if(window.confirm("Are you sure?")) {
      $.ajax({
      type: "POST",
      dataType: "json",
      url: "/admin/charge",
      data: "reservationid=" + $('#reservationid').val(),
      success: function (response) {
        console.log(response);
        if(response.Error){
          showNotification(response.Error, "error");
          return;
        }
         showNotification('Credit Card Charged', "info");
          
      }
    });
    }
  });


  $('#reservationstatus').change(function( e ){
    e.preventDefault();
    console.log($('#reservationstatus').val());

    $.ajax({
      type: "POST",
      dataType: "json",
      url: "/admin/statusChange",
      data: "status=" +$('#reservationstatus').val() + "&reservationid=" + $('#reservationid').val(),
      success: function (response) {
        console.log(response);
        if(response.Error){
          showNotification(response.Error, "error");
          return;
        }
         showNotification('Status Changed ', "info");
          
      }
    });

  });

  $('#reservationchangecontinue').click(function( e ){
    e.preventDefault();
    $('#reservationchangemodal').modal('hide');
    ChangeReservation(true);
  });

  $('#seasonratesbutton').click(function( e ){
    e.preventDefault();
    var temp = [];
    temp = $('#seasonratesform').serializeArray();
    console.log(temp);
    
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "/admin/seasonRatesChange",
      data: temp,
      success: function (response) {
        console.log(response);
        if(response.Error){
          showNotification(response.Error, "error");
          return;
        }
         showNotification('updated season pricing', "info");
          console.log(response.Tax);
          $('.reservationTax').html(response.Tax);
          $('.reservationTotal').html(response.Total);
          $('.reservationSubtotal').html(response.Subtotal);
          $( "input[name='Subtotal']" ).val(response.Subtotal);
          $( "input[name='Tax']" ).val(response.Tax);
          $( "input[name='Total']" ).val(response.Total);

          var a = 1;
          var item;
            for(item in response.Daily){
              //console.log( response.Daily[item].Total);
              var temp = '.RatesTotal' + a;
              $(temp).html('$' + response.Daily[item].Total);
              a++;
            }
      }
    });

  });

  $('#changeccbutton').click(function( e ){
    e.preventDefault();
    console.log("click");
    var temp = [];
    temp = $('#creditcardchangeform').serializeArray();
    console.log(temp);
    
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "/admin/creditCardChange",
      data: temp,
      success: function (response) {
        console.log(response);
        if(response.Error){
          showNotification(response.Error, "error");
          return;
        }
        if(response == "success"){
          showNotification('updated credit card', "info");
        } 
      }
    });


  });

  $('#changeguestbutton').click(function( e ){
    e.preventDefault();
    console.log("click");
   var temp = [];
    temp = $('#guestchangeform').serializeArray();
    console.log(temp);
    
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "/admin/guestChange",
      data: temp,
      success: function (response) {
        console.log(response);
        if(response.Error){
          showNotification(response.Error, "error");
          return;
        }
        if(response == "success"){
          showNotification('updated guest info', "info");
        }
        
      }
    });


  });

  function ChangeReservation(approval){
      
      var temp = [];
      temp = $('#reservationchangeform').serializeArray();
      temp.push({name: 'approval', value: approval});
      console.log(temp);
      
      $.ajax({
        type: "POST",
        dataType: "json",
        url: "/admin/reservationChange",
        data: temp,
        success: function (response) {
          console.log(response);
          if(response.Error){
            showNotification(response.Error, "error");
            return;
          }
          if(!approval){
            $('#reservationchangemodal').modal('show');
            showReservationChangeSummary(response);

          }
          if(response == "success"){
            showNotification('Reservation has been updated', "info");
            setTimeout(function(){ location.reload(); }, 2000);
          }
          

        }
      });


  }

  function showReservationChangeSummary(object){

    $('.arrival-date').html($('#datepicker').val());
    $('.depart-date').html($('#datepicker2').val());
    $('.num_adults').html($('#reservationadultsselect').val());
    $('.num_children').html($('#reservationkidsselect').val());
    
    var travelRates = object.Daily;
    if(travelRates == null){
        return;
    }
    var table;
    //console.log(travelRates + ' *****');
    for (var i = 0; i < travelRates.length; i++){
        var obj = travelRates[i];
        var name = obj.Season;
        var rates = obj.Price;
        var day_of_week = obj.Day_of_week;
        var subtotal = obj.Total;
        var date = obj.Date;
        var extra = obj.Extra;
        table += '<tr><td>' + name + '</td><td>' + date + '</td><td>' + day_of_week + '</td><td>' + rates + '</td><td>' + extra + '</td><td>' + subtotal + '</td></tr>';

        //console.log("** " + subtotal);

    }
    $('#trip-pricing-table').html('<tr><th>Season</th><th>Date</th><th>Day of Week</th><th>Price</th><th>Extra</th><th>Total</th></tr>' + table);
    $('#trip-pricing-subtotal').html('Subtotal: ' + object.Subtotal);
    $('#trip-pricing-taxes').html('Taxes & Fees: ' + object.Tax);
    $('#trip-pricing-total').html('Total: ' + object.Total);

    //call the click on tab pricing
    $('#banner .banner-bg').trigger('owl.goTo', 1);

  }

  $('#reservationresortselect').change(function(e){
    var value = $('#reservationresortselect').val();
    
    $.ajax({
      type: "GET",
      dataType: "json",
      url: "/data/getcondos/?resort=" + value,
      data: "",
      success: function (response) {
        console.log(response);
        $('#reservationchangeselect').html('');
        $.each(response,function(key, value) 
        {
            $('#reservationchangeselect').append('<option value=' + value.condo_id + '>' + value.condo_name + '</option>');
        });

      }
    });

  });

  $('#chargeadditional').click(function (e) {
    e.preventDefault();
    var myform = $('#formadditionalcharges');
    $.ajax({
        url: '/admin/chargeadditional',
        method: 'post',
        data: myform.serialize(),
        dataType: 'text',
        complete: function(e, xhr) {
            if (e.status === 200) {
                object = JSON.parse(e.responseText);
                console.log(object);
                if(object.Error){
                  showNotification('Charge Failed ' + object.Error, "error");    
                }else{
                  showNotification('Charge Success', "info");
                }

            } else {
              showNotification('Charge Failed', "unknown error");
            }
        }

    });
  });

  $('#existingrates').change(function(){

      var rateName = $('#existingrates').val();
      if(rateName == "new"){
        $('#condorates')[0].reset();
        $('#rate_id').val('');
        return;
      }
      var condo_id =  $('#condo_id').val();
      $.ajax({
        type: "GET",
        dataType: "json",
        url: "/admin/getrates/?rate_name=" + rateName + "&condo_id=" + condo_id,
        data: "",
        success: function (response) {
          //console.log(response);
          $('#condorates').populate(response[0]);
          //load rates
          loadRateTable(condo_id, rateName);
        }
      });

      
    });

    $('#saverates').click(function(){

      var data =  $('#condorates').serialize();
      console.log(data);
      $.ajax({
        type: "POST",
        dataType: "json",
        data: data,
        url: "/admin/saverates",
        success: function (r) {
          console.log(r);
          if(r.response == "success"){
            showNotification('Success saved rates', "info");
          }else{
            showNotification('Failed to save', "error");
          }
          //trigger message of saved
        }
      });

      
    });

    
    $('#deleterates').click(function(){

      var rate_id = $('#rate_id').val();
      
      $.ajax({
        type: "GET",
        dataType: "json",
        url: "/admin/deleterates/?rate_id=" + rate_id,
        data: "",
        success: function (response) {
          console.log(response);
          
        }
      });

      $('#condorates')[0].reset();
      $('#rate_id').val('');
      showNotification('Success removed rate', "info");

      
    });

    $('#setrates').click(function(){

      var ratesform = $('#setratesform').serialize();
      var condo_id =  $('#condo_id').val();
      var rateName = $('#existingrates').val();
      if(rateName == "new"){
        return;
      }
      $.ajax({
        type: "GET",
        dataType: "json",
        url: "/admin/setratespricing/?" + ratesform + "&condo_id=" + condo_id + "&rate_name="+rateName,
        data: "",
        success: function (response) {
          console.log(response);
          showNotification('Success setting rates', "info");
        },
        error: function(XMLHttpRequest, textStatus, errorThrown){
          showNotification('Error setting rates '+ textStatus + errorThrown, "error");
        }

      });
      //loadRateTable(condo_id, rateName);
      
    });

    $('#unsetrates').click(function(){

      var ratesform = $('#setratesform').serialize();
      var condo_id =  $('#condo_id').val();
      var rateName = $('#existingrates').val();
      if(rateName == "new"){
        return;
      }
      $.ajax({
        type: "GET",
        dataType: "json",
        url: "/admin/unsetratespricing/?" + ratesform + "&condo_id=" + condo_id + "&rate_name="+rateName,
        data: "",
        success: function (response) {
          console.log(response);
          showNotification('Success unsetting rates', "info");
        },
        error: function(){
          showNotification('Error unsetting rates', "error");
        }

      });
      loadRateTable(condo_id, rateName);
      
    });

  function loadRateTable(condo_id, name){

    $.ajax({
      type: "GET",
      dataType: "json",
      url: "/admin/getratepricing/?condo_id=" + condo_id + "&name=" + name,
      data: "",
      success: function (response) {
        console.log(response);
        //loop here
        var temp = '<tr><td>Date</td> <td>Day</td> <td>Rate</td> <td>Price</td> </tr>';
        for(var a =0; a<response.length; a++ ){
          temp += '<tr><td>' + response[a].ratedate_date + '</td> <td>' + response[a].day + '</td> <td>' + response[a].rate_name + '</td> <td>' + response[a].price + '</td> </tr>';
        }
        $('#ratepricestable').html(temp);
      },
      error: function (){
        $('#ratepricestable').html('');
      }

    });
     
     

  }

  $('#deletereservation').click(function(){
    var id = $('#reservationid').val();
    if (window.confirm("Are you sure you want to delete this reservation?")) {
      $.ajax({
        type: "GET",
        dataType: "json",
        url: "/admin/deletereservation?id=" + id,
        data: "",
        success: function (response) {
          console.log(response);
          //loop here
          showNotification("Removed the Reservation", "info");
          //hide the reservation
          $('#reservationscreen').hide();
        },
        error: function (){
          showNotification(response.Error, "error");
        }
  
      });
        //
    }
  });

  $('.setratesform .input-daterange').datepicker({
    todayHighlight: true
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

    $('#dataTableCondos').DataTable({

        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : false,
        'info'        : false,
        'autoWidth'   : false
      });
  


});


function showNotification(message, type = "info"){

  $.notify({
    // options
    icon: 'glyphicon glyphicon-info-sign',
    title: '',
    message: message
  },{
    // settings
    element: 'body',
    position: null,
    type: type,
    allow_dismiss: true,
    newest_on_top: true,
    showProgressbar: false,
    placement: {
      from: "top",
      align: "right"
    },
    offset: 20,
    spacing: 10,
    z_index: 1031,
    delay: 5000,
    timer: 1000,
    url_target: '_blank',
    mouse_over: null,
    animate: {
      enter: 'animated fadeInDown',
      exit: 'animated fadeOutUp'
    },
    onShow: null,
    onShown: null,
    onClose: null,
    onClosed: null,
    icon_type: 'class',
    template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
      '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
      '<span data-notify="icon"></span> ' +
      '<span data-notify="title">{1}</span> ' +
      '<span data-notify="message">{2}</span>' +
      '<div class="progress" data-notify="progressbar">' +
        '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
      '</div>' +
    '</div>' 
  });

}

function btn_del_click(id) {
  if (window.confirm("Are you sure you want to delete this condo?")) {
    $.ajax({
      type: "GET",
      dataType: "json",
      url: "/admin/condos?delete=" + id,
      data: "",
      success: function (response) {
        console.log(response);
        //loop here
        showNotification("Removed the condo", "info");
      },
      error: function (){
        showNotification(response.Error, "error");
      }

    });

      location.reload();
  }
}