/**
 * AdminLTE Demo Menu
 * ------------------
 * You should not use this file in production.
 * This file is for demo purposes only.
 */
$(function () {
  'use strict'

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
      url: "/admin/charge/",
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
      url: "/admin/statusChange/",
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
      url: "/admin/seasonRatesChange/",
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
      url: "/admin/creditCardChange/",
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
      url: "/admin/guestChange/",
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
        url: "/admin/reservationChange/",
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

  function showNotification(message, type = "info"){

    $.notify({
      // options
      icon: 'glyphicon glyphicon-warning-sign',
      title: 'Notification',
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

})
