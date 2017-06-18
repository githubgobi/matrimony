@extends('layouts.app')

@section('content')

<div class="container">
  
   <div class="row">
        <div class="col-xs-0 col-sm-0 col-md-2 col-lg-2" >

        </div>

        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7" >

   <?php $profiles = App\User::whereNotIn('id', [$user->id])->orderBy('id','desc')->get(); ?>
    @foreach($profiles as $profile)

        <?php 
        if(Auth::user()->isFriends($profile)){
            continue;
        }
        ?>

      <div class="row">      

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"> {{ ucwords($profile->name) }}</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="{{ url('/images') }}/{{ $profile->details->gender }}.png" class="img-circle img-responsive" > </div>                
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Gender</td>
                        <td> {{ ($profile->details->gender=='M')?'Male':'Female' }} </td>
                      </tr>
                      <tr>
                        <td>Date of Birth</td>
                        <td> {{ date('d/m/Y',strtotime($profile->details->dob )) }} </td>
                      </tr>                  
                         <tr>
                        <td>Religion</td>
                        <td> {{ $profile->details->religion->name }} </td>
                          </tr>
                          <tr>
                        <td>Country</td>
                        <td> {{ $profile->details->country->name }} ({{ $profile->details->country->short_name }})</td>
                      </tr>
                    </tbody>
                  </table>
                  
                </div>
              </div>
            </div>
                 <div class="panel-footer ">

                        <a href="{{ url('profile/').'/'.$profile->id }}" data-original-title="View Profile " data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-user"></i> </a>

                         @if(Auth::user()->hasFriendRequestPending($profile))
                        <span class="pull-right">
                            <a class="btn btn-sm btn-info" disabled>Request Sent</a>
                        </span>
                        @elseif(Auth::user()->hasFriendRequestReceived($profile))
                        <span class="pull-right">
                            <a href="{{ url('send_request/').'/'.$profile->id }}" data-original-title="Accept Request" data-toggle="tooltip" type="button" class="btn btn-sm btn-success">Accept Request</a>
                        </span>
                        @else
                        <span class="pull-right">
                            <a href="{{ url('send_request/').'/'.$profile->id }}" data-original-title="Send Request" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger">Send Request</a>
                        </span>
                        
                        @endif

                    </div>
            
          </div>
        </div>
      </div>

    @endforeach
    <span class="pull-right">                        
    
    </span>



    
    </div>  


            <div class="col-xs-0 col-sm-0 col-md-3 col-lg-3" >

    <div class="row">
      
      @if(!$user->friends()->count())
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >     
            <div class="panel panel-info">
              <div class="panel-heading">
                <h3 class="panel-title">  No Friend's  </h3>
              </div>
           </div>         
         </div>   
      @else


        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"> Friend's list  </h3>
            </div>
            <div class="panel-body">
   
        @foreach($user->friends() as $user)
              <div class="row">
                <div class="col-md-4 col-lg-4 " align="center"> <img alt="User Pic" src="{{ url('/images') }}/{{ $user->details->gender }}.png" class="img-circle img-responsive" style="height: 45 px;width: 50px">
                </div>
                <div class="col-md-7 col-lg-7 " > <a href="{{ url('profile/').'/'.$user->id }}">
                 {{ ucwords($user->name) }} </a> </div >
                       
                </div>
                <hr>               
        @endforeach
            </div>
          </div>
        </div>
      @endif  


    </div>


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
  