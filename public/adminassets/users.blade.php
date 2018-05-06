@include('adminassets.header')
<div class="wrapper">

  @include('adminassets.headeribbon')
    
    <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <h1>
                Users Edit
              </h1>
              <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Users Edit</li>
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

                                         <div class="btn-align"><h3>Add User</h3> </h3></div>

                                           <form id="adduser" action="" method="POST">
                                            <table class="table table-striped table-responsive">
                                            <tr>
                                                    <td><b>Username:</b></td>
                                                    <td><input type="text" name="usersname" value=""></td>
                                            </tr>
                                            <tr>
                                                    <td><b>Password:</b></td>
                                                    <td><input type="text" name="password" value=""></td>
                                            </tr>
                                            <tr>
                                            <td></td>    
                                            <td><input type="submit" name="change" id="change" value="Update"> </td>
                                            </tr>
                                            </table>
                                            </form>                                           

                                    </div>
                                    <div class="col-md-6">
                                        
                                                <h3>User List</h3>
                                                <table class="table table-striped table-responsive">
                                                @foreach($rows as $user)
                                                <tr>
                                                        <td><b>Username: {{$user->usersname}}</b></td>
                                                        <td><form name="deleteuser" action="" method="POST">
                                                            <input type="hidden" name="id" value="{{$user->id}}">
                                                            <input type="submit" name="delete" value="delete"></form></td>
                                                </tr>
                                                @endforeach 
                                                </table>     
                                                
                                    </div>
                              </div>

                            </div>
                            <!-- /.tab-content -->
  
              </div>
            </section>

        </div>



  @include('adminassets.footer')
