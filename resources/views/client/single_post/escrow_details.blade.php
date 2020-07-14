<style type="text/css">
    .work-details .sr-only { color:#fff !important;overflow: visible;clip: auto; }
    p.money{margin-top: 10px;letter-spacing: 1.2px;color: #4b994b;font-weight: bold;}
    .progress.progress-striped{border:1px solid #9f9c9c;}
    .white{background:#fff;}
    .white .sr-only{color:red !important;}
    .font-12{font-size: 12px;}
</style>
<div class="col-md-5 work-details">         
            <div class="box box-header with-border">
              <h3 class="box-title">Working Details and Payment</h3>

            </div>
            <div class="well well-sm">
                <div class="row">
                    <div class="col-xs-12 col-md-4 text-center">
                        <h4 class="text-center" style="font-weight: bolder; color:#4c53b3 !important;">Paid Amount</h4>
                        <span ><i style="color:green;" class="fa fa-dollar fa-3x"></i></span>
                        <p class="money">Rs.{{$data[0]->deposit_amount + $data[1]->deposit_amount +  $data[2]->deposit_amount +  $data[3]->deposit_amount}}/{{ $data[0]->total_amount + $data[1]->total_amount +  $data[2]->total_amount +  $data[3]->total_amount }}</p>
                        <a class="btn btn-link btn-xs" onclick="showPaymentDetailsInfo(event)"><u>Payment Details</u></a>
                        <div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-8" style="border-left:1px solid burlywood;">
                        <div class="row rating-desc">
                            <?php $d =0 ; ?>
                            @foreach($data as $k => $v)
                                @if(!empty($reqAmount))
                                    @if($reqAmount->phase == $v->phase)
                                        <input type="hidden" id="rqtPhase" value="{{$k + 1}}" />
                                        <?php $d = $k + 2;?>
                                        @if($d > 4 )
                                            <input type="hidden" id="should_pay" value = "{{$v->phase}}" />
                                        @endif
                                    @endif
                                    @if($k == $d-1)
                                        <input type="hidden" id="phase" value ="{{$v->phase}}" />
                                        <input type="hidden" id="remain_amt" value = "{{$v->remaining_amount}}" />
                                        <?php $phase = config('constants.escrow_system.phase.'.($d)) ;?>
                                        @if($v->phase == $phase  && $v->status == 'Completed')
                                            <input type="hidden" id="should_pay" value = "{{$v->phase}}" />
                                        @endif
                                    @endif
                                @endif
                                <div class="col-xs-4 col-md-4 text-left font-12">
                                    {{config('constants.escrow_system.phase.'.($k+1)) }} Phase</span>
                                </div>
                                <div class="col-xs-6 col-md-6 ">
                                    <div class="progress progress-striped ">
                                        <div class="progress-bar {{ $v->status == 'Completed'?'progress-bar-success text-success':($v->status=='Processing'?'progress-bar-warning text-warning':'progress-bar-danger') }}" role="progressbar" aria-valuenow="20"
                                            aria-valuemin="0" aria-valuemax="100" style="width:{{($v->deposit_amount/$v->total_amount) * 100}}%">
                                            <span class="{{$v->deposit_amount ==0?'text-danger':''}}">{{($v->deposit_amount/$v->total_amount) * 25}}%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-1 col-md-1">
                                    <span>
                                        <i class="fa {{$v->status == 'Completed'?'fa-check text-success':($v->status=='Processing'?'fa-check text-warning':'fa-close text-danger')}}"></i>
                                    </span>
                                </div>
                            @endforeach
                        </div>
                        <!-- end row -->
                    </div>
                </div>                
                <div class="box-footer text-center" style="background-color: #f5f5f5;">
                    @if($escrowActivate->phase =='Final' && $escrowActivate->status == 'Completed')

                        <div class="alert alert-info">Your Payment has been completed</div>
                    @else
                        <button class="btn btn-info" @if($firstPhasePending == false) onclick="showPaymentSlipModal(event)" @else onclick="alert('Payment denied, Your previous payment request is on pending.')" @endif>Pay Now</button>
                    @endif

                </div>
            </div>
	  	</div>