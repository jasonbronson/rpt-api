@include('adminassets.header')
<div class="wrapper">

    @include('adminassets.headeribbon')

  
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-2 col-xs-3">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$new}}</h3>
              <p>New Order(s)</p>
            </div>
            <a href="/admin/reservations/" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
         
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <!--li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li-->
              <!--li><a href="#sales-chart" data-toggle="tab">Donut</a></li-->
              <li class="pull-left header"><i class="fa fa-inbox"></i> Sales Over Time</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
              <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success">
            
            
          <!-- TO DO List -->
          

          

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

          

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>

  @include('adminassets.footer')

  <script>
      var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

      var area = new Morris.Area({
        element   : 'revenue-chart',
        resize    : true,
        data      : [
          
          @foreach($data as $inner)
            { y: '{{$inner['month']}}', item1: {{$inner['item1']}}, item2: {{$inner['item2']}} },
          @endforeach
          
         
        ],
        xkey      : 'y',
        ykeys     : ['item1', 'item2'],
        labels    : ['2017', '2018'],
        xLabelFormat: function(x) { // <--- x.getMonth() returns valid index
          var month = months[x.getMonth()];
          return month;
        },
        dateFormat: function(x) {
          var month = months[new Date(x).getMonth()];
          return month;
        },
        lineColors: ['#a0d0e0', '#3c8dbc'],
        hideHover : 'auto'
      });
  
  </script>  