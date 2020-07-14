<?php include(resource_path() . '/views/client/header.blade.php');
// @dd($data);
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

    .nav-tabs-custom {
        box-shadow: 0 0 0 !important;
    }

    .nav-tabs-custom h4 {
        margin-left: 30px;
        font-size: 20px;
    }

    .user-block {
        margin-bottom: 15px;
    }

    .latest-item {
        padding: 8px;
        margin-left: 10px;
        font-size: 15px;
        text-align: left;
    }

    .latest-item .title {
        font-weight: bold;
        color: #188c18e0;
        letter-spacing: 0.5px;
        padding-top: 8px;
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

    .Completed {
        font-size: 12px;
        font-weight: normal;
        color: green;
    }

    .Rejected,
    .required {
        font-size: 12px;
        font-weight: normal;
        color: red;
    }

    .Pending {
        font-size: 12px;
        font-weight: normal;
        color: red;
    }

    .Expired {
        color: red;
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

    .win-msg {
        font-size: 14px;
        font-weight: bold;
        color: #d72020eb;
    }

    .content {
        background-color: #fff;
    }

    div.timeline-item.bids {
        min-height: 200px;
    }

    .bided {
        height: 500px;
        overflow-y: scroll;
    }

    .post {
        border-bottom: 0px !important;
    }

    .post .timeline::before {
        background-color: #fff;
    }

    #no-bid.timeline::before {
        background-color: #fff;
    }

    #win-footer .timeline-header {
        padding: 0px !important;
        margin: 0px !important;
        border-bottom: 1px solid red !important;
        padding-bottom: 4px !important;
    }

    .custom {
        color: #123b77ad;
        font-style: italic;
    }
</style>
<div class="alert-success hidden " style="height: auto;margin-top:20px; padding: 0px;">
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove" style="color:#fff;">
            <i class="fa fa-times"></i></button>
    </div>
    <div class="box-body text-center">

    </div>
</div>
<section class="content">
    <div class="row">
        <!-- /.col -->
        <div class="col-md-7 post">
            <div class="nav-tabs-custom">
                <div class="tab-content">
                    <!-- /.tab-pane -->
                    <div class="tab-pane active" id="timeline">
                        <!-- The timeline -->
                        @if(isset($err))
                        <div class="err">
                            {{$err}}
                        </div>
                        @else
                        @foreach($data['post'] as $k=>$p)
                        @if($k==0)
                        <ul class="timeline timeline-inverse">
                            <li>
                                <div id="timeline_{{$p->postid}}" class="timeline-item m-0">
                                    <h3 class="timeline-header">
                                        @if(isset($data['bid_count']))
                                        <i class="fa fa-thumbs-up"></i>
                                        {{ $data['bid_count']==0?'No':$data['bid_count'] }}
                                        vendor Bided on your post.
                                        @if($carbon->parse($p->expired_at)->gt($carbon->now()))
                                        <span class="expire pull-right">Expiring on
                                            <a>
                                                {{$carbon->parse($p->expired_at)->format('d M')}}
                                            </a>
                                        </span>
                                        @else
                                        <span class="expire pull-right">Expired on
                                            <a>
                                                {{$carbon->parse($p->expired_at)->format('d M')}}
                                            </a>
                                        </span>
                                        @endif
                                        @endif
                                        @if(isset($data['wins_details']))
                                        @if(isset($data['escrow_activate']))
                                        <span class="Delivered">{{config('constants.single-post-client.escrow_system_activated')}}</span>
                                        @else
                                        @if($data['status'] !='Delivered')
                                        <span class="win-msg">
                                            {!! config('constants.single-post-client.win_status') !!}
                                        </span>
                                        @else
                                        <span class="Delivered">{{ Session::get('msg') ?? config('constants.single-post-client.delivered_status')}}</span>
                                        @endif
                                        @endif
                                        @endif
                                    </h3>
                                    <!-- <h3 class="timeline-header"></h3> -->
                                    <div class="timeline-body">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="{{ url('img/photo.png') }}" alt="User Image">
                                            <span class="username">
                                                <a href="#">{{$p->client_name}}</a>
                                                <span class="status pull-right {{ $data['status'] }}">{{ $data['status'] }}
                                                </span>
                                            </span>
                                            <span class="description">posted - {{$carbon->parse($p->created_at)->format('d M' )}}
                                            </span>
                                        </div>
                                        <p class="wordwrap m-0">{{ $p->description }}</p>
                                        <div id="bid-details" class="bid-details row">
                                            <div class="latest-item col-sm-12 col-md-12 pull-left">
                                                @foreach($p as $k=>$m)
                                                <div class="row px-2 px-md-5">
                                                    @if($k !="description" && $k !="created_at" && $k != "postid" && $k!="client_name" && $k!="expired_at" && $k !="file_attached")
                                                    <div class="title col-sm-3 col-md-4">
                                                        {{getName($k)}}
                                                    </div>
                                                    <div class="value col-sm-9 col-md-8">
                                                        {{$m ?? '-'}}
                                                    </div>
                                                    @endif
                                                </div>
                                                @endforeach
                                                @if(isset($p->file_attached) && $p->file_attached != '')
                                                <div class="timeline-footer pull-left px-2 px-md-5 pt-3">
                                                    <a target="_blank" class="btn btn-info pull-right" href="{{url('/').'/client_posts/'.$p->file_attached}}">View File Attached</a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if($data['status'] =='Delivered' && !isset($data['escrow_activate']))
                                    <div id="win-footer" class="box-footer" style=" border-top: 1px solid #ccc">
                                        <span class="description" style="font-size: 16px;">Do you want to activate Escrow System for payment? </span><br>
                                        <button type="submit" class="btn btn-success m-1" onclick="activateEscrowSystem(event,'ON');">Yes</button>
                                        <button class="btn btn-danger m-1" onclick="activateEscrowSystem(event,'OFF')">No</button>
                                        <i class="fa fa-question-circle pull-right" style="color:#0000caf2; font-size: 30px;" title="Help"></i>
                                    </div>
                                    @endif
                                </div>
                            </li>
                        </ul>
                        @endif
                        @endforeach
                        @endif
                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->

        {{-- Winning Bid  --}}
        @if(isset($data['wins_details']))

        <?php echo view('client.single_post.wining_bid')->with('data', $data['wins_details'])->render(); ?>
        @else

        <?php echo view('client.single_post.bids', ['comments' => $comments, 'status' => $data['status']])->render(); ?>
        @endif


        {{-- Escrow Details --}}
        @if(isset($data['escrow_activate']))
        <?php echo view('client.single_post.escrow_details')->with('data', $data['payment_details'])->with('reqAmount', $data['request-amount'])->with('escrowActivate', $data['escrow_activate'])->withFirstPhasePending($data['firstPhasePending'])->render(); ?>
        @endif
    </div>

    @if(!empty($data['request-amount']))
    <div id="request-amount" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="request-amount" aria-hidden="true" id="mi-modal">
        <div class="modal-dialog modal-md modal-dialog-centered" style="align-items: center;display: flex;">
            <div class="modal-content">
                <div class="modal-header" style="padding:10px 0px 5px 15px;">
                    <input type="hidden" id="form-id">
                    <h4 class="modal-title " id="myModalLabel" style="color:#109b10; font-size: 20px">Request for Payment</h4>
                </div>
                <div class="modal-body ">
                    <p>Your service provider has completed <b>{{$data['request-amount']->phase}} Phase</b>.
                        @if($data['escrow_activate']->phase =='Final' && $data['escrow_activate']->status == 'Completed')
                        Your Payment has been completed
                        @else
                        At first, You have to pay for <b>Next Phase</b>.
                        @endif
                    </p>
                    <h4 class="text-center" style="margin-top: 25px;"> Are you sure to <b>release amount?</b></h4>
                </div>
                <div class="modal-footer" style="border:0px;margin-top: 20px;">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-success pull-right" id="modal-btn-yes" style="width:120px;" onclick="requestAmountAprrove(event)">Yes</button>
                    </div>
                    <div class="col-md-4 pull-right">
                        <button type="button" class="btn btn-danger pull-left w-50" id="modal-btn-no" style="width:120px;" onclick="cancelAmountRequest(event)">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <input type="hidden" id="form-id">
                    <h4 class="modal-title" id="myModalLabel">Confirm?</h4>
                </div>
                <div class="modal-body">
                    <span>{{config('constants.messages.confirm-award')}}</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="modal-btn-yes">Yes</button>
                    <button type="button" class="btn btn-primary" id="modal-btn-no">No</button>
                </div>
            </div>
        </div>
    </div>

    @if(isset($data['escrow_activate']))
    @if( !empty($data['nextPaymentPhase']))
    <div id="paymentSlipModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    @if($data['firstPhasePending'] == false)
                    <button type="button" class="close" data-dismiss="modal" onclick="@if($data['nextPaymentPhase']->phase == 'First')$('#cancelEscrowSystem').submit(); @endif">&times;</button>
                    @endif
                    <form id="cancelEscrowSystem" action="{{url('client/client-post').'/'.$data['payment_details'][0]->post_id.'/cancel-escrow'}}" method="post">
                        @csrf
                        <input type="hidden" name="phase" value="{{$data['payment_details'][0]->phase}}" />
                        <input type="hidden" name="escrow_id" value="{{$data['payment_details'][0]->id}}" />
                    </form>
                    <h4 class="modal-title">Upload Payment Details:
                        <span id="subject-user" style="font-size: 14px; color:red">
                            {{-- @if($data['payment_details'][0]->status == 'Pending') --}}
                            {{$data['nextPaymentPhase']->phase}} Phase (Payment should be at least Rs. {{$data['nextPaymentPhase']->remaining_amount}})
                            {{-- @endif --}}
                        </span></h4>
                </div>
                <div class="modal-body">
                    <form id="payment-form" role="form" method="post" onsubmit="paymentSlipForm(event)" enctype="multipart/form-data">
                        <input type="hidden" value="" name="post_id" id="post_id">
                        <input type="hidden" value="" name="win_id" id="win_id">
                        <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="voucher_id"><span class="required">*</span> Voucher/Transaction Id</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name='voucher_id' id='voucher_id' class="form-control">
                                    <div id="voucher_id-err" class="error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="amount_deposit"><span class="required">*</span> Deposit Amount</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name='amount_deposit' id='amount_deposit' placeholder="At least Rs. {{$data['nextPaymentPhase']->remaining_amount}}" class="form-control" oninput="checkFullAmount(this.value, this)">
                                    <div id="amount_deposit-err" class="error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="deposit_from"><span class="required">*</span> Deposit From</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="deposit_from" id="deposit_from" />
                                    <div id="deposit_from-err" class="error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="payment_slip"><span class="required">*</span> Upload Payment Slip</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="file" name="payment_slip" id="payment_slip">
                                    <div id="payment_slip-err" class="error"></div>
                                </div>
                            </div>
                        </div>
                        <input id="submit-payment" type="submit" class="btn btn-success" value="Submit">
                        <input type="reset" class="btn btn-success pull-right" value="Reset Form">
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="alert" role="alert" id="result"></div>
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
                            <th>Status</th>
                            <th>Payment Document</th>
                        </thead>
                        <tbody>
                            @foreach($data['payment_info'] as $d)
                            <tr>
                                <td>{{ $d->voucher_id}}</td>
                                <td>{{ $d->deposit_from }}</td>
                                <td>Rs. {{ $d->amount_deposit }} /-</td>
                                <td class="{{ $d->status }}">{{ $d->status }}</td>
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

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="cancel-modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <input type="hidden" id="form-id">
                    <h4 class="modal-title" id="myModalLabel">Give Your Comment</h4>
                </div>
                <div class="modal-body" style="height: 200px;">
                    <form id="cancel-payment-form" role="form" method="post" onsubmit="cancelPaymentForm(event)">
                        <input type="hidden" name="phaseid" id="phaseid" />
                        <input type="hidden" name="postid" id="postid" />
                        <input type="hidden" name="phase" id="phase" />
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="client_comment"><span class="required">*</span> Why did you cancel payment?</label>
                                </div>
                                <div class="col-md-7">
                                    <textarea class="form-control" name="client_comment" id="client_comment" rows="4"></textarea>
                                    <div id="client_comment-err" class="error"></div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</section>

<script type="text/javascript">
    var postid = "{{$data['post'][0]->postid}}";
    var remainAmount = $('#remain_amt').val() || "{{$data['nextPaymentPhase']->remaining_amount ?? ''}}";
    $(function() {
        var phase = "{{$data['payment_details'][0]->phase ?? ''}}";
        var status = "{{$data['payment_details'][0]->status ?? ''}}";
        var firstPhasePending = "{{$data['firstPhasePending'] ?? ''}}";
        var depoStatus = ""
        // console.log(firstPhasePending);
        // console.log(phase+'-'+status)
        if (phase == 'First' && status == 'Pending'  && firstPhasePending!=true ) {
            // console.log(phase);
            $('#paymentSlipModal').modal({
                backdrop: 'static',
                keyboard: false
            });
            showPaymentSlipModal(event);
        }
        $('#request-amount').modal({
            backdrop: 'static',
            keyboard: false
        });
    });
    $('input').focus(function(e) {
        $(this).css('border', '1px solid #d2d6de')
        $('#' + this.id + '-err').empty()
    });
    $(function() {
        if ($('#no_bids').length) {
            $('.bided').css('overflow', 'hidden');
            $('.timeline:before').addRule({
                width: "0px"
            });

        }
    });

    function checkFullAmount(value, elm) {
        // console.log(value + '' + remainAmount);
        if (parseInt(value) < parseInt(remainAmount)) {
            $(elm).css('border', '1px solid red');
        } else {
            $(elm).css('border', '1px solid green');
        }
    }

    function showPaymentDetailsInfo(e) {
        $('#payment_details-modal').modal('show');
    }

    function showDiv(id) {
        $('.bid-details').hide();
        $('#bid-details_' + id).show();
        $('#timeline-footer_' + id + ' a').attr('onclick', 'hideDiv("' + id + '")');
        $('#timeline-footer_' + id + ' a').text('View less');
    }

    function hideDiv(id) {
        $('#bid-details_' + id).hide();
        $('#timeline-footer_' + id + ' a').attr('onclick', 'showDiv("' + id + '")');
        $('#timeline-footer_' + id + ' a').text('View more');
    }

    function activateEscrowSystem(e, status) {
        e.preventDefault();
        var id = "<?php echo isset($data['wins_details']) ? $data['wins_details']->winid : ''; ?>";
        var data = {
            'id': id,
            'postid': postid,
            'status': status
        };
        var url = "activate-escrow-system";
        var xhr = ajaxPostObj(url, data);
        xhr.done(function(response) {
            console.log(response);
            location.reload();
        }).fail(function(reason) {
            console.log('not ok');
        })
    }

    function requestAmountAprrove(e) {
        e.preventDefault();
        $('#request-amount').modal('hide');
        console.log("{{$rqtPhase ??''}}")
        var phase = $('#phase').val() || '';
        var remainAmt = $('#remain_amt').val() || '';
        // console.log(remainAmt);
        var requestPhaseNumber = "{{config('constants.escrow_system.phase_reverse.$rqtPhase')}}";
        console.log(requestPhaseNumber);
        if ($('#should_pay').length == 1) {
            // console.log($('#should_pay').length);
            var espid = "{{$data['request-amount']->id??''}}";
            $('#paymentSlipModal').modal('hide');
            var url = 'direct-releasepayment-order';
            var data = {
                'postid': postid,
                'espid': espid
            };
            var xhr = ajaxPostObj(url, data);
            xhr.done(function(resp) {
                toast(resp);
                $('#paymentSlipModal').modal('hide');
                $('.alert-success').show().text(resp);
            }).fail(function(reason) {
                toast()
            });
        } else {
            if (phase != '' && remain_amt != '') {
                console.log('sorry')
                $('#subject-user').text(phase + ' Phase (Payment should be at least Rs.' + remainAmt + ')');
            }
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", 'status');
            hiddenField.setAttribute("value", "Request");
            $('#payment-form').append(hiddenField);
            $('#paymentSlipModal').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#paymentSlipModal .close').remove();
            showPaymentSlipModal(e);
        }
    }

    function cancelAmountRequest(e) {
        e.preventDefault();
        var id = "{{ $data['request-amount']->id ?? ''}}";
        var phase = "{{$data['request-amount']->phase ?? ''}}";
        $('#cancel-modal #phaseid').val(id);
        $('#cancel-modal #postid').val(postid);
        $('#cancel-modal #phase').val(phase);
        $('#cancel-modal').modal({
            backdrop: 'static',
            keyboard: false
        });
        // $('#request-amount').modal('hide');

    }

    function cancelPaymentForm(e) {
        e.preventDefault();
        var data = $('#cancel-payment-form').serialize();
        var url = "<?php echo url('client/post/cancel-payment-request'); ?>";
        var xhr = ajaxPostObj(url, data);
        xhr.done(function(resp) {
            $('.alert-success .box-body').show().text(resp);
            resetForm($('#cancel-payment-form'))
            $('#cancel-modal').modal('hide');
            $('#request-amount').modal('hide');
        }).fail(function(reason) {
            var rsp = reason.responseJSON;
            // console.log(rsp.errors.remarks[0]);
            $('#client_comment-err').show().text("* " + rsp.client_comment[0]);
            $('#client_comment').focus();
            $('#client_comment').css('border', '1px solid red');
        });
    }

    function paymentSlipForm(e) {
        e.preventDefault();
        // $('.error').hide().text(''); 
        var inputAmount = $('#amount_deposit').val() || 0;
        if (parseInt(inputAmount) < parseInt(remainAmount)) {
            console.log('here');
            // $('#amount_deposit-err').show().text('* Amount should be at least ');
            $('#amount_deposit').focus();
            $('#amount_deposit').css('border', '1px solid red');
            return false;
        }
        var formData = new FormData($('form#payment-form')[0]);
        var url = "payment-for-escrow";
        var xhr = submitFormAjaxWithFile(url, formData);
        xhr.done(function(resp) {
            resetForm($('form#payment-form'));
            $('#paymentSlipModal').modal('hide');
            $('#upload-payment').remove();
            // $('h3.timeline-header span.Delivered').text(resp);
            $('div.alert-success').removeClass('hidden').show().children('.box-body').html(resp + ' <a class="custom" onclick="showPaymentDetails"><u>View Payment Details</u></a>');
        }).fail(function(reason) {
            console.log(reason.responseJSON.message);
            for (var i in reason.responseJSON.message) {
                $('input#' + i).css('border', '1px solid red');
                $('#' + i + '-err').show().text('*' + reason.responseJSON.message[i][0]);
            }
        });
    }

    function showPaymentSlipModal(e = null) {
        $('#paymentSlipModal').modal('show');
        // var postid = "{{$data['post'][0]->postid}}";
        $('#payment-form #post_id').val(postid);
        // $('#payment-form #win_id').val(winid);

    }
    $(document).on("click", ".form-submit", function(e) {
        e.preventDefault();
        $("#mi-modal").find('#form-id').val($(this).closest('form').attr('id'));
        $("#mi-modal").modal('show');
    });

    $(document).on("click", "#modal-btn-yes", function() {
        let form_id = '#' + $('#mi-modal').find('#form-id').val();
        $(form_id).submit();
        $("#mi-modal").modal('hide');
    });

    $(document).on("click", "#modal-btn-no", function() {
        $("#mi-modal").modal('hide');
    });
</script>
<?php
include(resource_path() . '/views/client/footer.blade.php');
?>