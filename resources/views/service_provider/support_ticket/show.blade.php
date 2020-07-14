<?php
include(resource_path() . '/views/service_provider/header.blade.php');
?>
<style type="text/css">
    .content{
        background-color: #fff;
    }
    section div.parent-div{
        border-bottom: 0px !important;
    }
    section div.parent-div .nav-tabs-custom{
        box-shadow: 0 0 0 !important;
    }
    section div#first-div .timeline::before{
        background-color: #fafafa;
    }
    .tab-content{
        padding:0px !important;
    }
    .main{
        background-color: #eeeeee50;
        padding: 20px;
    }
    .timeline-inverse > li > .timeline-item{
        background-color :#fff;
        border:0px !important;
    }
    .nav-tabs-custom > .tab-content{
        background-color: #fafafa;
    }
    .description .row{
        padding:3px;
        margin-left:20px;
        font-size:14px;
    }
    .row.description{
        margin-top:20px !important;
    }
</style>

<section class="content">
<div class="col-md-9 main">
    <div id="first-div" class="row col-md-11 parent-div">
                    <div class="nav-tabs-custom">
                        <div class="tab-content">
                            <!-- /.tab-pane -->
                            <div class="tab-pane active" id="winning_bid">
                                <!-- The timeline -->
                                <ul class="timeline timeline-inverse">

                                    <li>

                                        <div class="timeline-item bids">
                                            <h3 class="timeline-header">
                                                
                                            <span>Your Ticket is 
                                                <span style="color: {{($ticket->status == 'Processing')?'green': 'red'}}">{{$ticket->status}}
                                                </span>
                                            </span>
                                            </h3>
                                            <div class="timeline-body">
                                                <div class="user-block">
                                                    <img class="img-circle img-bordered-sm"
                                                         src="{{ url('img/photo.png') }}" alt="User Image">
                                                    <span class="username">
                                                        <a href="#">{{$users->contact_name}}</a>
                                                    </span>
                                                    <div class="row description">
                                                        <div class="row">
                                                            <span class="col-md-3">Ticket Id :</span> <span class="col-md-8">{{$ticket->ticket_id}}</span>
                                                        </div>
                                                        <div class="row">
                                                            <span class="col-md-3">Opened Date :</span> <span class="col-md-8"> {{$ticket->created_at}}</span>
                                                        </div>
                                                        <div class="row">
                                                            <span class="col-md-3">Username :</span> <span class="col-md-8"> {{$users->contact_name}}</span>
                                                        </div>
                                                        <div class="row">
                                                            <span class="col-md-3">Problem Category :</span> <span class="col-md-8"> {{$ticket->category}}</span>
                                                        </div>
                                                        <div class="row">  
                                                            <span class="col-md-3">Problem Title :</span> <span class="col-md-8"> {{$ticket->title}}</span>
                                                        </div>
                                                        <div class="row">
                                                            <span class="col-md-3">Priority:</span> <span class="col-md-8"> {{$ticket->priority}}</span>
                                                        </div>
                                                        @if($ticket->status != 'Open')
                                                            <div class="row"> <span class="col-md-3">{{$ticket->status}} By :</span> <span class="col-md-8">E-thekka Admin</span></div>
                                                            <div class="row"> <span class="col-md-3">{{$ticket->status}} On :</span> <span class="col-md-8"> {{$ticket->updated_at}}</span></div>
                                                        @endif
                                                        <div class="row">
                                                            <span class="col-md-3">Remarks :</span> <span class="col-md-8">{{ $ticket->message }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="bid-details">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
    </div>
    <div class="row pull-left col-md-12">
        <div class="col-md-1">
            
        </div> 
        @if(in_array($ticket->status,['Processing', 'Closed']))
        <div class="col-md-9 parent-div">
                        <div class="nav-tabs-custom">
                            <div class="tab-content">
                                <!-- /.tab-pane -->
                                <div class="tab-pane active" id="winning_bid">
                                    <!-- The timeline -->
                                    <ul class="timeline timeline-inverse">

                                        <li>
                                            <i class="fa fa-comments bg-yellow"></i>

                                            <div class="timeline-item bids">
                                                <h3 class="timeline-header"><i class="fa fa-clock-o"></i>Comments
                                                </h3>
                                                <div class="timeline-body">
                                                    <div class="user-block">
                                                        <img class="img-circle img-bordered-sm"
                                                             src="{{ url('img/photo.png') }}" alt="User Image">
                                                        <span class="username">
                                                            <a href="#">Support Team</a>
                                                        </span>
                                                        <span class="description">Ticket Updated On - {{$ticket->updated_at}}</span>
                                                    </div>
                                                    <span class="title" style="color: {{($ticket->status == 'Processing')?'green': 'red'}}">{{$ticket->status}}</span>
                                                    <p>{{$ticket->remarks}}</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.nav-tabs-custom -->
        </div>
        @else
        <div class="col-md-9 parent-div">
            No any reply from support team.
        </div>
        @endif
    </div>
</div>
</section>

<?php
include(resource_path() . '/views/service_provider/footer.blade.php');
?>