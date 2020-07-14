<div class="col-md-5">
  <div class="box pd-0">
    <div class="box-header">
      <h4><i class="fa fa-star"></i> Review and Ratings</h4>
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

                    <div class="timeline-body pb-0">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="{{ url('img/photo.png') }}" alt="User Image">
                        <span class="username">
                          <a href="#">{{ $users->name }}</a>
                          <span class="status pull-right {{($reviewPost->status==1)?'Delivered':'Expired'}}">{{($reviewPost->status==1)?'Delivered':'Delivery Expired'}}</span>
                        </span>
                        <span class="description">posted - {{ $carbon->parse($reviewPost->created_at)->format('d M') }}</span>
                      </div>
                      <p>{{ $reviewPost->description }}</p>
                    </div>
                    <div id="timeline-footer" class="timeline-footer">
                      <div class="card-body">
                        <div class="row m-0">
                          <div class="col-xs-9 col-md-10 p-1" style="margin-left:10%">

                            <div class="row">
                              <!-- <div class="col-xs-2 col-md-2">
                              </div> -->

                              <div class="col-xs-10 col-md-12 user-block">
                               <div class="d-flex align-items-center">
                                  <img src="{{url('/img/photo.png')}}" width="40" height="40" class="img-circle img-bordered-sm" />
                                  <div class="ml-2">
                                    <span class="username m-0">
                                      <div class="d-flex align-items-center ">
                                        <p style="margin-bottom: 0px !important"> <a href="#">{{ $reviewPost->status==1?$reviewPost->contact_name:'Unknown Vendor' }}</a></p>
  
                                        @if(!empty($reviewPost->badge))  
                                        <h5 class="badge badge-success rounded-circle m-0 ml-2 ttooltip">
                                          <i class="fa fa-check-circle"></i>
                                        <span class="ttooltiptext">{{ config('constants.verified_user_msg') }}</span>
                                        </h5>
                                        @endif
                                      </div>
                                    </span>
                                    <p class="description m-0">Bided at - {{ $carbon->parse($reviewPost->bided_at)->format('d M') }}</p>
                                  </div>
                               </div>
                              </div>

                              <div class="col-xs-12 col-md-12 pt-2">
                                <p class="m-0">{{$reviewPost->comment_on_bid}}</p>
                                <p>Bid Amount: <span class="Delivered">Rs. {{$reviewPost->bid_amount}}</span></p>
                                @if($reviewPost->stars == -1)
                                <div class="row" style="margin-top:40px;">
                                  <div class="col-md-12">
                                    <div class="well well-sm">
                                      <div id="review-show_{{$reviewPost->winid}}" class="text-right">
                                        <a class="btn btn-success btn-green" id="open-review-box_{{$reviewPost->winid}}" onclick="showReview('{{$reviewPost->winid}}')">Leave a Review</a>
                                      </div>

                                      <div class="row" id="post-review-box_{{$reviewPost->winid}}" style="display:none;">
                                        <div class="col-md-12">
                                          <form action="{{url('client/post/store-review')}}" accept-charset="UTF-8" id="review-form_{{$reviewPost->winid}}" method="post">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input type="hidden" name="wd" value="{{$reviewPost->winid}}" />
                                            <input type="hidden" name="pd" value="{{$reviewPost->id}}" />
                                            <input id="ratings-hidden" name="rating" type="hidden">
                                            <textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." rows="10"></textarea>

                                            <div class="text-right">
                                              <div class="stars starrr mt-1" data-rating="0"></div>
                                              <a class="btn btn-danger btn-sm m-1" href="#" id="close-review-box_{{$reviewPost->winid}}" onclick="hideReview('{{$reviewPost->winid}}')" style="display:none; margin-right: 10px;">
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
                                <div class="stars starrr Delivered" data-rating="{{$reviewPost->stars}}"></div>
                                @endif
                              </div>
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
    <div class="box-footer">
      {!! !empty($reviewPost)?
      '<a href="#" class="pull-right"><i class="fa fa-star"> </i> <u>All Reviews</u></a>':'<a href="#" class="pull-right"><u>Create Post</u></a>'
      !!}
    </div>
  </div>
</div>