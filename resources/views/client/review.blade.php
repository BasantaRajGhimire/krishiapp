<?php include(resource_path() . '/views/client/header.blade.php');
$baseModel = new App\BaseModel();
// dd($posts);
?>
<style type="text/css">
  .nav-tabs-custom h4 {
    margin-left: 30px;
    font-size: 20px;
    padding-top: 20px;
  }
</style>
<section class="content">
  <div class="row">
    <h2 class="page-header px-3 mb-0">Your Review and Ratings</h2>

    <div class="col-md-10">
      <div class="nav-tabs-custom">
        <h4><i class="fa fa-star"></i> Review and Ratings</h4>
        <div class="tab-content">

          <!-- /.tab-pane -->

          <div class="tab-pane active" id="timeline">
            <!-- The timeline -->
            <ul class="timeline timeline-inverse">
              @if(!empty(count($posts)> 0))
              @foreach($posts as $k=>$p)
              <li>
                <i class="fa fa-comments bg-yellow"></i>

                <div id="timeline_{{$p->id}}" class="timeline-item">

                  <div class="timeline-body">
                    <div class="user-block">
                      <img class="img-circle img-bordered-sm" src="{{ url('img/photo.png') }}" alt="User Image">
                      <span class="username">
                        <a href="#">{{ $users->name }}</a>
                        <span class="status pull-right {{($p->status==1)?'Delivered':'Expired'}}">{{($p->status==1)?'Delivered':'Delivery Expired'}}</span>
                      </span>
                      <span class="description">posted - {{ $carbon->parse($p->created_at)->format('d M') }}</span>
                    </div>
                    <p class="my-2 pl-2">{{ $p->description }}</p>
                  </div>
                  <div id="timeline-footer" class="timeline-footer">
                    <!-- <a class="btn btn-warning btn-flat btn-xs" href="{{ url('/client/client-post').'/'.$p->id.'?post_token='.$users->remember_token }}">View more</a>
                            <div class="card card-inner"> -->
                    <div class="card-body">
                      <div class="row">

                        <div class="col-md-10 col-xs-offset-1">
                          <div class="d-flex align-items-center">
                            <img src="{{url('/img/vendor3.jpg')}}" width="50" height="50" class="img-circle img-bordered-sm mr-3" />
                            <div>
                              <div class="d-flex align-items-center ">
                                <p class="m-0"><a href=""><strong>{{$p->status==1?$p->contact_name:'Unknown Vendor'}}</strong></a></p>
                                @if(!empty($p->badge))
                                <h5 class="badge badge-success rounded-circle m-0 ml-2 ttooltip">
                                  <i class="fa fa-check-circle"></i>
                                <span class="ttooltiptext">{{config('constants.verified_user_msg') }}</span>
                                </h5>
                                @endif
                              </div>
                              <small class="description" style="margin:0px !important;"><b>Bided at - {{ $carbon->parse($p->bided_at)->format('d M') }}</b></small>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                              <div style="padding-left:60px">
                                <p class="my-2">{{$p->comment_on_bid}}</p>
                                <p>Bid Amount: <span class="Delivered">Rs. {{$p->bid_amount}}</span></p>
                              </div>
                            </div>
                          </div>
                          @if($p->stars == -1)
                          <div class="row m-0" style="margin-top:40px;">
                            <div class="col-md-12">
                              <div class="well well-sm">
                                <div id="review-show_{{$p->winid}}" class="text-right">
                                  <a class="btn btn-success btn-green" id="open-review-box_{{$p->winid}}" onclick="showReview('{{$p->winid}}')">Leave a Review</a>
                                </div>

                                <div class="row" id="post-review-box_{{$p->winid}}" style="display:none;">
                                  <div class="col-md-12">
                                    <form accept-charset="UTF-8" action="{{url('client/post/store-review')}}" id="review-form_{{$p->winid}}" method="post">
                                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                                      <input type="hidden" name="wd" value="{{$p->winid}}" />
                                      <input type="hidden" name="pd" value="{{$p->id}}" />
                                      <input class="ratings-hidden" name="rating" type="hidden">
                                      <textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." rows="10"></textarea>

                                      <div class="text-right">
                                        <div class="stars starrr mt-1" data-rating="0"></div>
                                        <a class="btn btn-danger btn-sm m-1" href="#" id="close-review-box_{{$p->winid}}" onclick="hideReview('{{$p->winid}}')" style="display:none; margin-right: 10px;">
                                          <span class="glyphicon glyphicon-remove mr-1"></span>Cancel</a>
                                        <button class="btn btn-success btn-sm m-1" type="submit">Save</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          @else
                          <p class="stars starrr Delivered" data-rating="{{$p->stars}}"></p>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              @endforeach
              @else
              <img class="img-thumbnail" src="{{url('img/nopost.jpg')}}" style="border:0px;" />
              @endif
              <!-- END timeline item -->
              <!-- timeline time label -->
            </ul>
          </div>
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
  </div>
</section>
<?php
include(resource_path() . '/views/client/footer.blade.php');
?>