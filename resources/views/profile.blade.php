@extends('layouts.app')

@section('content')
<div class="container">
      <div class="row">
    
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"> {{ ucwords($user->name) }}</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="{{ url('/images') }}/{{ $user->details->gender }}.png" class="img-circle img-responsive"> </div>
                
                <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
                  <dl>
                    <dt>DEPARTMENT:</dt>
                    <dd>Administrator</dd>
                    <dt>HIRE DATE</dt>
                    <dd>11/12/2013</dd>
                    <dt>DATE OF BIRTH</dt>
                       <dd>11/12/2013</dd>
                    <dt>GENDER</dt>
                    <dd>Male</dd>
                  </dl>
                </div>-->
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Profile Created:</td>
                        <td> {{ date('d/m/Y',strtotime($user->created_at)) }} </td>
                      </tr>
                      <tr>
                        <td>Date of Birth</td>
                        <td> {{ date('d/m/Y',strtotime($user->details->dob )) }} </td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td>Gender</td>
                        <td> {{ ($user->details->gender=='M')?'Male':'Female' }} </td>
                      </tr>
                        <tr>
                        <td>Religion</td>
                        <td> {{ $user->details->religion->name }} </td>
                      </tr>
                        <tr>
                        <td>Mother Tounge</td>
                        <td> {{ $user->details->mother_tongue }} </td>
                      </tr>
                        <tr>
                        <td>Country</td>
                        <td> {{ $user->details->country->name }}</td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><a href="{{ url('/profile') }}/{{ $user->email }}"> {{ $user->email }} </a></td>
                      </tr>
                        <td>Phone Number</td>
                        <td>
                         {{ $user->details->mobile_number }} (Mobile)
                        </td>
                           
                      </tr>
                     
                    </tbody>
                  </table>
                  
                </div>
              </div>
            </div>
          
          @if($user->id != Auth::user()->id)
          <div class="panel-footer">
                            <a href="{{ url('send_request_email/').'/'.$user->id }}" data-original-title="Send Email" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-email"></i></a>

                  <a href="{{ url('send_request/').'/'.$user->id }}" data-original-title="Send Request" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning pull-right"><i class="glyphicon glyphicon-edit"></i></a>
          </div>
          @endif

          </div>
        </div>
      </div>


    <div class="row">
      
      @if(!$user->friends()->count())
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >     
            <div class="panel panel-info">
              <div class="panel-heading">
                <h3 class="panel-title">  No Friend's  </h3>
              </div>
           </div>         
         </div>   
      @else


        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"> Friend's list  </h3>
            </div>
            <div class="panel-body">
   
        @foreach($user->friends() as $user)
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="{{ url('/images') }}/{{ $user->details->gender }}.png" class="img-circle img-responsive" style="height: 50px;width: 50px"> </div> 
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information" width="100%">
                    <tbody>
                      <tr>
                        <td width="50%"> <a href="{{ url('profile/').'/'.$user->id }}"> {{ ucwords($user->name) }} </a> </td>
                        <td> {{ date('d/m/Y', strtotime($user->updated_at)) }} </td>
                      </tr>
                    </tbody>  
                  </table>
                 </div>   
                </div>
                <hr>               
        @endforeach
            </div>
          </div>
        </div>
      @endif  


    </div>

    </div>


    <style type="text/css">
        .user-row {
        margin-bottom: 14px;
    }
    
    .user-row:last-child {
        margin-bottom: 0;
    }
    
    .dropdown-user {
        margin: 13px 0;
        padding: 5px;
        height: 100%;
    }
    
    .dropdown-user:hover {
        cursor: pointer;
    }
    
    .table-user-information > tbody > tr {
        border-top: 1px solid rgb(221, 221, 221);
    }
    
    .table-user-information > tbody > tr:first-child {
        border-top: 0;
    }
    
    
    .table-user-information > tbody > tr > td {
        border-top: 0;
    }
    .toppad
    {margin-top:20px;
    }

    </style>

    <script type="text/javascript">
        $(document).ready(function() {
    var panels = $('.user-infos');
    var panelsButton = $('.dropdown-user');
    panels.hide();

    //Click dropdown
    panelsButton.click(function() {
        //get data-for attribute
        var dataFor = $(this).attr('data-for');
        var idFor = $(dataFor);

        //current button
        var currentButton = $(this);
        idFor.slideToggle(400, function() {
            //Completed slidetoggle
            if(idFor.is(':visible'))
            {
                currentButton.html('<i class="glyphicon glyphicon-chevron-up text-muted"></i>');
            }
            else
            {
                currentButton.html('<i class="glyphicon glyphicon-chevron-down text-muted"></i>');
            }
        })
    });


    $('[data-toggle="tooltip"]').tooltip();

    $('button').click(function(e) {
        e.preventDefault();
        alert("This is a demo.\n :-)");
    });
});
    </script>
@endsection
