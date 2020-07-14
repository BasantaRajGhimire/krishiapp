<?php include(resource_path() . '/views/service_provider/header.blade.php');
?>
<style type="text/css">
  .content {
    min-height: 500px;
  }

  div.timeline-item {
    min-height: 400px;
  }

  .nav-tabs-custom>.nav-tabs>li {
    border: 0px;
  }

  .nav-tabs-custom h4 {
    margin-left: 30px;
    font-size: 20px;
    padding-top: 20px;
  }

  /* .user-block {
    margin-bottom: 15px;
  } */

  .latest-item {
    padding: 8px;
    margin-left: 10px;
    font-size: 15px;
    text-align: left;
  }

  .latest-item .title {
    color: #188c18e0;
    letter-spacing: 0.5px;
    padding-top: 8px;
    font-weight: bold;
  }

  .latest-item .value {
    padding-top: 8px;
  }

  .err {
    text-align: center;
    font-size: 25px;
    color: red;
  }

  .Approved {
    font-size: 12px;
    font-weight: normal;
    color: green;
  }

  .Reject {
    font-size: 12px;
    font-weight: normal;
    color: red;
  }

  .Pending,
  .required {
    font-size: 12px;
    font-weight: normal;
    color: red;
  }

  .border-red {
    border: 1px solid red;
  }

  .fa-thumbs-up {
    color: #7474fb;
    font-size: 20px;
  }

  span.expire {
    font-size: 14px;
  }

  span.expire a {
    margin-left: 5px;
    margin-right: 10px;
  }

  span.expired {
    color: #e12424;
  }

  .white {
    background: #fff;
  }

  .white .sr-only {
    color: red !important;
  }

  .font-12 {
    font-size: 12px;
  }

  .progress.progress-striped {
    border: 1px solid #9f9c9c;
  }

  .content-header .header {
    margin-bottom: 20px;
    color: #28a745 !important;
    padding: 8px;
    text-align: center;
    line-height: 1.4em;
  }

  .Pending {
    background-color: #dc3545 !important;
    color: #fff;
  }

  .Request {
    background-color: #ffc107 !important;
    color: #fff;
  }

  .Released {
    background-color: #28a745 !important;
    color: #fff;
  }

  .font-9 {
    font-size: 9px;
  }

  .pd-0 {
    margin-left: -10px;
    margin-top: -2px;
  }
</style>
@if(Session::has('msg'))
<div class="alert alert-success mt-5">
  <strong>Hello <?php echo $users->contact_name; ?></strong>, {{ Session::get('msg')}}
</div>
@endif
@if(Session::has('err'))
<div class="alert alert-error mt-5">
  <strong>Hello <?php echo $users->contact_name; ?></strong>, {{ Session::get('err')}}
</div>
@endif
<section class="content">

  <div class="row">
    <!-- /.col -->
    <div class="col-md-7">
      <div class="nav-tabs-custom">
        <h4><i class="fa fa-clock-o"></i> Timeline</h4>
        <div class="tab-content">
          <!-- /.tab-pane -->
          <div class="tab-pane active" id="timeline">
            <!-- The timeline -->
            @if(isset($err))
            <div class="err">
              {{$err}}
            </div>
            @else
            @foreach($data['post'] as $p)
            <ul class="timeline timeline-inverse">

              <li>
                <i class="fa fa-comments bg-yellow"></i>

                <div id="timeline_{{$p->postid}}" class="timeline-item">
                  @if(!isset($data['win']))
                  <span class="time"><i class="fa fa-clock-o"></i> {!! $carbon->parse($p->expired_at)->gt($carbon->now())?'<span class="expiring">Expiring on</span>':'<span class="expired">Expired </span>' !!} <a>{{ $carbon->parse($p->expired_at)->format('d M') }}</a></span>
                  @elseif(isset($data['win']))
                  <span class="time"><i class="fa fa-clock-o"></i> {!! $carbon->parse($data['win']->expired_at)->gt($carbon->now())?'<span class="expiring">Expiring on</span>':'<span class="expired">Expired </span>' !!} <a>{{ $carbon->parse($data['win']->expired_at)->format('d M') }}</a></span>
                  @endif
                  <h3 class="timeline-header"><a href="#">You</a> bided for Rs. {{$p->bid_amount }} on <b>{{ $p->client_name }}'s</b> post</h3>
                  <!-- <h3 class="timeline-header"></h3> -->
                  <div class="timeline-body">
                    <div class="user-block">
                      <img class="img-circle img-bordered-sm" src="{{ url('img/photo.png') }}" alt="User Image">
                      <span class="username">
                        <a href="#">{{$p->client_name}}</a>
                        <!-- <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a> -->
                      </span>
                      <span class="description">posted - {{$carbon->parse($p->created_at)->format('d M' )}}</span>
                    </div>
                    <p class="wordwrap py-2">{{ $p->description }}</p>
                    <div id="bid-details" class="bid-details row">
                      <div class="latest-item col-sm-12 col-md-12 pull-left">
                        @foreach($p as $k=>$m)
                        <div class="row m-0">
                          @if($k !="description" && $k !="created_at" && $k != "postid" && $k!="client_name" && $k!="expired_at" && $k!="filename")
                          <div class="title col-sm-3 col-md-4">
                            {{getName($k)}}
                          </div>
                          <div class="value col-sm-9 col-md-8">
                            {{$m ?? '-'}}
                          </div>
                          @endif
                        </div>
                        @endforeach
                        <div class="row m-0 py-1 px-4">
                          @if(!empty($p->filename))
                          <a target="_blank" class="btn btn-info pull-left" href="{{url('/client_posts').'/'.$p->filename}}">View File Attached</a>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row m-0 pb-4 pb-md-0">
                    <div class="row m-0 pt-1 pb-4 px-4">
                      @if(isset($data['win']))
                      <div id="timeline-footer_{{$p->postid}}" class="timeline-footer">
                        @if($data['win']->status == 0)
                        <button id="payment-button" class="btn btn-danger pull-right"><a href="{{url('service-provider/pay-for-details/').'/'.$data['win']->winid}}" style="color:#fff;">Pay for Client Details</a></button>
                        <span class="text-center pull-right p-2" style="color: #df3838;font-size: 16px;font-weight: bold;">Congrats! You have won this bid.</span>
                        @elseif($data['win']->status == 1)
                        <button class="btn btn-success pull-right"><a target="_blank" href="{{url('service-provider/client-details/').'/'.$data['win']->winid}}" style="color:#fff;">View Client Details</a></button>
                        @endif
                      </div>
                      @endif
                    </div>
                  </div>
                </div>
              </li>
            </ul>
            @endforeach
            @endif
          </div>
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    @if(isset($data['escrow_system']) && count($data['escrow_system']) > 0)
    <div class="col-md-5 work-details mt-3">
      <div class="well well-sm p-0">
        <div class="box box-header with-border">
          <h3 class="box-title">Working Details and Payment</h3>
        </div>
        <div class="p-2">
          <div class="content-header">
            <h3 class="header mb-20">Your client has activated Escrow System. You have to follow certain rules and procedures. <i class="fa fa-help"></i></h3>
          </div>
          <div class="row">
            <div class="col-xs-12 col-md-4 text-center">
              <h4 class="text-center" style="font-weight: bolder; color:#4c53b3 !important;">Received Amount</h4>
              <span><i style="color:green;" class="fa fa-dollar fa-3x"></i></span>
              <p class="money">Rs. {{$data['escrow_system'][0]->withdraw_amount + $data['escrow_system'][1]->withdraw_amount +  $data['escrow_system'][2]->withdraw_amount +  $data['escrow_system'][3]->withdraw_amount}}/{{ $data['escrow_system'][0]->total_amount + $data['escrow_system'][1]->total_amount +  $data['escrow_system'][2]->total_amount +  $data['escrow_system'][3]->total_amount }}</p>
              <a class="btn btn-link btn-xs" onclick="$('#payment_details-modal').modal('show')"><u>Payment Details</u></a>
              <div>
              </div>
            </div>
            <div class="col-xs-12 col-md-8" style="border-left:1px solid burlywood;">
              <div class="row rating-desc">
                <?php $pending = 0; ?>
                @foreach($data['escrow_system'] as $k => $v)
                <?php
                if ((!isset($status)) && $pending == 0) :
                  if ($v->status == 'Released') :
                    $phase = $k + 2;
                  elseif ($v->status == 'Pending') :
                    $phase = $k + 1;
                    $pending = 1;
                  elseif ($v->status == 'Request') :
                    $phase = $k + 1;
                    $status = "Request";
                    $approved = $v->is_approved;
                  endif;
                endif;
                ?>
                <div class="col-xs-3 col-sm-2 col-md-4 text-left font-12">
                  {{config('constants.escrow_system.phase.'.($k+1)) }} Phase</span>
                </div>
                <div class="col-xs-7 col-sm-9 col-md-6 ">
                  <div class="progress progress-striped">
                    <div class="progress-bar progress-bar-success" role="progressbar {{ $v->status == 'Released'?'progress-bar-success text-success':($v->status=='Requested'?'progress-bar-warning text-warning':'progress-bar-danger') }}" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:{{ ($v->withdraw_amount/$v->total_amount) * 100 }}%">
                      <span class="{{$v->withdraw_amount ==0?'text-danger':''}}">{{($v->withdraw_amount / $v->total_amount) * 20}}%
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-xs-1 col-md-1 pd-0">
                  <span class="{{$v->status}} font-9" style="padding: 3px;border-radius: 5px;">{{$v->status}}
                  </span>
                </div>
                @endforeach
              </div>
              <!-- end row -->
            </div>
          </div>
          <div class="box-footer text-center" style="background-color: #f5f5f5;">
            @if(isset($status))
            @if($approved == 0)
            <span class="text-warning">You have requested amount for {{config('constants.escrow_system.phase.'.$phase)}} phase. </span><br>
            <button class="btn btn-warning">Amount Requested</button>
            @elseif($approved == 1)
            <span class="text-success">Your Payment phase has been approved by client and will be released soon.</span>
            @else
            <span class="text-warning">Your {{config('constants.escrow_system.phase.'.$phase)}} phase requested amount is send to admin</span><br>
            <button class="btn btn-danger">Rejected by Client</button>
            @endif
            @else
            @if($phase <5) <span class="text-danger">Do you completed your {{config('constants.escrow_system.phase.'.$phase)}} Phase? Request amount here, </span><br>
              <button class="btn btn-info btn-xs" onclick="requestForAmount(event)">Request</button>
              @else
              <span class="text-success">Your Payment phase has been completed.</span>
              @endif
              @endif

          </div>
        </div>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" id="payment_details-modal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <input type="hidden" id="form-id">
          <h4 class="modal-title" id="myModalLabel">Payment Details</h4>
        </div>
        <div class="modal-body">

          <table class="table table-striped" style="margin-top:10px !important;">
            <thead>
              <th>Voucher Id</th>
              <th>From</th>
              <th>Deposit Amount</th>
              <th>Payment Document</th>
            </thead>
            <tbody>
              @foreach($data['payment_info'] as $d)
              <tr>
                <td>{{ $d->voucher_id}}</td>
                <td>{{ $d->deposit_from }}</td>
                <td>Rs. {{ $d->deposit_amount }} /-</td>
                <td><a target="_blank" href="{{url('/').'/payment-slip/'.$d->payment_slip }}">{{ $d->payment_slip }}</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Close</button>
        </div>
      </div>
    </div>
  </div>
  @if(isset($data['request_cancel']))
  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" id="request-cancel-modal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <input type="hidden" id="form-id">
          <h4 class="modal-title" id="myModalLabel">Give your Comment</h4>
        </div>
        <div class="modal-body">
          <form id="cancel-payment-form" role="form" method="post" action="{{url('service-provider/post/comment-on-request-cancel')}}">
            @csrf
            <input type="hidden" name="comment_id" id="comment_id" value="{{$data['request_cancel']->id}}" />
            <input type="hidden" name="phaseid" id="phaseid" value="{{$data['request_cancel']->espid}}" />
            <input type="hidden" name="postid" id="postid" value="{{$data['request_cancel']->post_id}}" />
            <input type="hidden" name="phase" id="phase" value="{{$data['request_cancel']->phase}}" />
            <div class="form-group">
              <div class="row">
                <div class="col-md-5">
                  <label for="client_comment"><span class="required">*</span> Why did you request payment?</label>
                </div>
                <div class="col-md-7">
                  <textarea class="form-control" name="serviceprovider_comment" id="serviceprovider_comment" rows="4"></textarea>
                  <div id="serviceprovider_comment-err" class="error {{Session::has('validation')?'show':'hide'}}">* {{Session::has('validation')?Session::get('validation'): ''}}</div>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
  @endif
  @endif
</section>
<script>
  @if(Session::get('validation'))
  $('#serviceprovider_comment').focus();
  $('#serviceprovider_comment').css('border', '1px solid red');
  @endif
  $(function() {
    $('#request-cancel-modal').modal('show');
    $('#request-cancel-modal').modal({
      backdrop: 'static',
      keyboard: false
    });
  });
  var postid = "{{$data['post'][0]->postid}}";

  function requestForAmount(e) {
    e.preventDefault();
    var url = "<?php echo url('service-provider/post/request-for-amount'); ?>";
    var data = {
      'post_id': postid,
      '_token': "{{csrf_token()}}"
    };
    var xhr = ajaxPostObj(url, data);
    xhr.done(function(resp) {
      location.reload();
    }).fail(function(reason) {
      console.log(reason);
    });
  }
</script>
<?php
include(resource_path() . '/views/service_provider/footer.blade.php');
?>