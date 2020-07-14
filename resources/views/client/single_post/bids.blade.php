<?php
$carbon = new \Carbon\Carbon();
?>
<div class="col-md-5" >
  <div class="nav-tabs-custom" >
    <h4><i class="fa fa-clock-o"></i> Bids</h4>
    <div class="tab-content">
      <!-- /.tab-pane -->
      <div class="tab-pane active bided" id="comments">
        <!-- The timeline -->
        @if(count($comments)>0)
        @foreach($comments as $i=>$comment)
        <ul class="timeline timeline-inverse">
          <li>
            <i class="fa fa-comments bg-yellow"></i>
            <div id="comment_{{$i}}" class="timeline-item bids">
              <div class="timeline-body">
                <p class="stars starrr Delivered pull-right" data-rating="{{round($comment->average_stars)}}"></p>
                <div class="user-block">
                  <img class="img-circle img-bordered-sm" src="{{ url('img/photo.png') }}" alt="User Image">
                  <div class="d-flex align-items-center ">
                    <span class="ml-3 username"> <a href="#">Unknown</a> </span>
                    @if(!empty($comment->badge))
                      <h5 class="badge badge-success rounded-circle m-0 ml-2 ttooltip">
                        <i class="fa fa-check-circle"></i>
                      <span class="ttooltiptext">{{ config('constants.verified_user_msg') }}</span>
                      </h5>
                    @endif
                </div>
                  <span class="description">Bid On - {{$carbon->parse($comment->created_at)->format('d M')}}
                  </span>
                </div>
                <p>{{ $comment->comment_on_bid }}</p>
                <div class="bid-details">
                  <div class="latest-item col-md-12 pull-left m-0 p-0">
                   <div class="row m-1 d-flex align-items-center">
                      <div class="title col-md-4 p-2">
                        Bid Amount
                      </div>
                      <div class="value col-md-5 p-2">
                        Rs.{{$comment->bid_amount}}
                      </div>
                      <div class="value col-md-3 p-2">
                        <form id="{{'form-award-'.$comment->bid_id}}" class="form-award" action="{{url('/client/client-post/award/'.$comment->bid_id)}}">
                          {{csrf_field()}}
                          @if($status == 'Approved')
                          <button type="submit" class="btn btn-primary form-submit">
                            Award
                          </button>
                          @endif
                        </form>
                      </div>
                   </div>
                  </div>
                </div>
                {{--<div class="bid-amount">
                        <h5>Bid Amount: </h5>
                        <p>{{$comment->bid_amount}}</p>
              </div>--}}
            </div>
      </div>
      </li>
      </ul>
      @endforeach
      @else
      <ul id="no-bid" class="timeline timeline-inverse">
        <li>
          <div id="no_bids" class="timeline-item" style="background:#fff">
            <img src="{{url('img/nobid.jpg')}}" class="img-responsive" />
          </div>
        </li>
      </ul>
      @endif
    </div>
  </div>
  <!-- /.tab-content -->
</div>
<!-- /.nav-tabs-custom -->
</div>