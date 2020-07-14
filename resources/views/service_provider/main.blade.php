<?php include(resource_path() . '/views/service_provider/header.blade.php');
?>
<?php
$latestPost = new \App\ServiceProvider\ServiceProviderBidPost();
$latestPost = $latestPost->getLatestPost(session('suserid'));
//print_r($latestPost);
//exit;
?>
<div class="content-wrapper">
  <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div id="post" class="box">
        <div class="box-header">
          <h3 class="box-title">Hello {{ $users->contact_name }} ,</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove" style="color:#fff;">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          Welcome to our bidding platform, If you want to supply any constructing material or any kind of services please kindly bid on Clients requirement here! Many Client Users were waiting for your service.
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="{{ url('/service-provider/new-bids') }}"><button class="btn btn-primary">Find new bids</button></a>
        </div>
        <!-- /.box-footer-->
      </div>

      <div class="col-md-7 latest">
        <div class="box">
          <div class="box-header">
            <h4>Latest Bid Won</h4>
          </div>
          <div class="box-body">
            @if(!empty($latestPost))
            <h4 class="timeline-header"><a href="#">You</a> bided for Rs. {{$latestPost->bid_amount }} on <b>{{ $latestPost->name }}'s</b> post</h4>
            <div class="user-block" style="margin-top: 25px;">
              <img class="img-circle img-bordered-sm" src="{{ url('img/photo.png') }}" alt="User Image">
              <span class="username" style="display:block;text-align:left">
                <a href="#">{{ $latestPost->name }}</a>
                <!-- <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a> -->
              </span>
              <span class="description" style="display:block;text-align:left">posted - {{ $carbon->parse($latestPost->created_at)->format('d M') }}</span>
            </div>
            <p style="margin-top:20px;float:left">{{ $latestPost->description }}</p>
            @else
            <img class="img-thumbnail" src="{{url('img/nopost2.jpg')}}" style="border:0px;float:left" />
            @endif
          </div>
          <div class="box-footer">
            @if(empty($latestPost))
            <a href="#" class="pull-right"> <u>Create Post</u></a>
            @else
            @if($latestPost->win_status == 0)
            <span class="win pull-left"> Congrats! you have won this bid</span>
            @endif
            <a href="{{url('service-provider/post').'/'.$latestPost->postid}}" class="pull-right"> <u>Read More</u></a>
            @endif
          </div>
        </div>
      </div>
      <div class="col-md-5 fund">
        <div class="box">
          <div class="box-header">
            <h4>Welcome {{ $users->contact_name }}</h4>
          </div>

          <div class="box-body">
            <p style="font-size: 23px;padding: 30px;"><i class="fa fa-money"></i> Balance Fund <a class="pull-right">Rs. 0.00</a></p>
            <!-- <blockquote>Your Post</blockquote>
              <p >- Service Provider</p> -->

          </div>
          <div class="box-footer">
            <a href="{{ url('service-provider/profile') }}" class="pull-left"> <u>View Profile</u></a>
            <a href="#" class="pull-right"> <u>Deposit Fund</u></a>
          </div>
        </div>
      </div>
      <div class="col-md-7">
        <div class="box pd-0">
          <div class="box-header">
            <h4><i class="fa fa-star"></i> Latest reviews</h4>
          </div>
          <div class="box-body pd-0" style="text-align: left">
            @if(!empty($reviewPost))
            <div class="col-md-12 pd-0">
              <div class="nav-tabs-custom">
                <div class="tab-content">
                  <!-- /.tab-pane -->

                  <div class="tab-pane active" id="timeline">
                    <!-- The timeline -->
                    <ul class="timeline timeline-inverse">
                      <li>
                        <i class="fa fa-comments bg-yellow"></i>

                        <div id="timeline_{{$reviewPost->id}}" class="timeline-item">

                          <div class="timeline-body">
                            <div class="user-block">
                              <img class="img-circle img-bordered-sm" src="{{ url('img/photo.png') }}" alt="User Image">
                              <span class="username">
                                <a href="#">{{ $reviewPost->name }}</a>
                                <span class="status pull-right {{($reviewPost->status==1)?'Delivered':'Expired'}}">{{($reviewPost->status==1)?'Delivered':'Delivery Expired'}}</span>
                              </span>
                              <span class="description">posted - {{ $carbon->parse($reviewPost->created_at)->format('d M') }}</span>
                            </div>

                            <p>{{ $reviewPost->description }}</p>
                          </div>
                          <div id="timeline-footer" class="timeline-footer">
                            <div class="card-body">
                              <div class="row m-0">
                                <div class="col-xs-12 col-md-2"></div>
                                <div class="col-xs-12 col-md-10 user-block">
                                  <div class="col-xs-4 col-sm-2 col-md-2 p-1 pr-2">
                                    <img class="profile-user-img img-responsive img-circle" src="{{ url('/img/vendor3.jpg') }}" width="40" height="40" class="img img-rounded img-fluid" />
                                  </div>
                                  <div class="col-xs-8 col-sm-5 col-md-5 p-1">
                                    <div class="d-flex align-items-center ">
                                      <p style="margin-bottom: 0px !important"><a href=""><strong>{{$users->contact_name}}</strong></a></p>
                                      @if(!empty($users->badge))
                                      <h5 class="badge badge-success rounded-circle m-0 ml-2 ttooltip">
                                        <i class="fa fa-check-circle"></i>
                                      <span class="ttooltiptext">{{ config('constants.verified_user_msg')}}</span>
                                      </h5>
                                    @endif
                                    </div>
                                    <p class="description" style="margin:0px !important;">Bided at - {{ $carbon->parse($reviewPost->bided_at)->format('d M') }}</p>
                                  </div>
                                  <div class="col-xs-12 col-sm-5 col-md-5 p-1 user-block">
                                    <p class="description" style="margin:0px !important; text-align:right">Rating: ({{$reviewPost->stars}}/5)</p>
                                    <p class="stars starrr Delivered" data-rating="{{$reviewPost->stars}}"></p>
                                    <!-- </div> -->
                                  </div>
                                  <div class="col-md-12 p-1">
                                    <p>{{$reviewPost->comment_on_bid}}</p>
                                    <p>Bid Amount: <span class="Delivered">Rs. {{$reviewPost->bid_amount}}</span></p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <!-- timeline time label -->
                    </ul>
                  </div>
                </div>
                <!-- /.tab-content -->
              </div>
              <!-- /.nav-tabs-custom -->
            </div>
            @else
            <img class="img-thumbnail" src="{{url('img/nopost2.jpg')}}" style="border:0px;" />
            @endif
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4 pull-right">
        <div class="box">
          <div class="box-header">
            <h4>Average Rating</h4>
          </div>

          <div class="box-body box-profile text-center">
              <img class="profile-user-img img-responsive img-circle" src="{{ url('/img/vendor3.jpg') }}" alt="User profile picture">                    
              <div class="d-flex align-items-center justify-contents-center">
              <h3 class="profile-username text-center mb-1">{{ $users->contact_name }}</h3>
              @if(!empty($users->badge))
                  <h5 class="badge badge-success rounded-circle m-0 ml-2 ttooltip">
                      <i class="fa fa-check-circle"></i>
                    <span class="ttooltiptext">{{ config('constants.verified_user_msg') }}</span>
                  </h5>
              @endif
              </div>
              <p class="text-muted text-center">{{ $users->vendor_type }}</p>
              @if(!empty($users->badge))
                  <!-- Badge -->
                  <div class="d-flex justify-contents-center mb-4">
                      <div class="ttooltip">
                          <div class="d-flex align-items-baseline">
                              @if($users->badge == 4)
                                <div class="ribbon  ribbon--purple">
                                    <i class="fas fa-gem"></i>
                                </div>
                              <b class="pl-2" style="color:#5C3292;text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.15);">{{$users->badge_name}}</b>
                              @elseif($users->badge == 3)
                                  <div class="ribbon  ribbon--blue">
                                      <i class="fas fa-crown"></i>
                                  </div>
                                  <b class="pl-2" style="color:#1C91C0;text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.15);">{{$users->badge_name}}</b>
                              @elseif($users->badge == 2)
                                  <div class="ribbon  ribbon--orange">
                                      <i class="fas fa-trophy"></i>
                                  </div>
                                  <b class="pl-2" style="color:#E7711B;text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.15);">{{$users->badge_name}}</b>
                              @elseif($users->badge == 1)
                                  <div class="ribbon  ribbon--gray">
                                      <i class="fas fa-award"></i>
                                  </div>
                                  <b class="pl-2" style="color:#8d8d8d;text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.15);">{{$users->badge_name}}</b>
                              @endif
                          </div>
                        <span class="ttooltiptext">{{ $users->badge_description }}</span>
                          <div class="arrow" style="left: 45px;"></div>
                      </div>
                  </div>                
              @endif
            <p class="stars starrr Delivered" style="text-align:center !important" data-rating="{{round($users->average_stars)}}"></p>
            <p class="description">Rating: ({{$users->average_stars}} / 5)</p>
            <p class="description"><a href="{{ url('service-provider/post/reviews') }}"><u>{{$users->total_reviews}} Reviews</u></a></p>
          </div>
          <!-- <div class="box-footer">
              <a href="{{ url('service-provider/post/reviews') }}" class="pull-left"> <u>View All reviews</u></a>
            </div> -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.container -->
</div>

<script type="text/javascript">
  // $(function(){
  $('span.glypicon').addClass('hello');
  // });
</script>
<?php
if (!request()->ajax()) :
  include(resource_path() . '/views/service_provider/footer.blade.php');
endif;
?>