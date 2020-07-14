<?php 
$carbon = new \Carbon\Carbon();
?>
<div class="col-md-5">
        <div class="nav-tabs-custom">
          <h4><i class="fa fa-clock-o"></i> Winning Bid</h4>
          <div class="tab-content">
          <!-- /.tab-pane -->
            <div class="tab-pane active" id="winning_bid">
              <!-- The timeline -->
              <ul class="timeline timeline-inverse">
                <li>
                  <i class="fa fa-comments bg-yellow"></i>
                  <div class="timeline-item bids">
                    <div class="timeline-body">
                        <p class="stars starrr Delivered pull-right" data-rating="{{$data->average_stars}}"></p>
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="{{ url('img/photo.png') }}" alt="User Image" />
                        <div class="d-flex align-items-center ">
                          <span class="ml-3 username"> <a href="#">Unknown</a> </span>
                          @if(!empty($data->badge))
                          <h5 class="badge badge-success rounded-circle m-0 ml-2 ttooltip">
                            <i class="fa fa-check-circle"></i>
                          <span class="ttooltiptext">{{ config('constants.verified_user_msg') }}</span>
                          </h5>
                          @endif
                        </div>
                        <span class="description">Company - Unknown</span>
                        <span class="description">Bid On - {{$carbon->parse($data->created_at)->format('d M' )}}
                        </span>
                      </div>
                      <p class="wordwrap my-2">{{ $data->comment_on_bid }}</p>
                      <div class="bid-details">
                        <div class="latest-item col-md-12 pull-left">
                          <div class="title col-md-5">
                            Bid Amount
                          </div>
                          <div class="value col-md-7">Rs.
                            {{$data->amount}}
                          </div>
                        </div>
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