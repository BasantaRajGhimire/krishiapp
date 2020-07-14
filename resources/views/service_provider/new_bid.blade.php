<?php include(resource_path() . '/views/service_provider/header.blade.php');
?>
<style type="text/css">
    .new-bids {
        min-height: 500px;
        height: auto;
    }

    .latest-item {
        /* padding: 10px; */
        margin-left: 10px;
        font-size: 15px;
        text-align: left;
    }

    .latest-item .title {
        font-weight: bold;
        color: #188c18e0;
        letter-spacing: 0.5px;
    }

    /* .latest-item .value {
        color: #d92424cc;
    } */

    .bid-post {
        background-color: #fff;
        padding: 20px;
        padding-left: 30px;
        padding-right: 30px;
        margin-bottom: 50px;
    }

    .amount-submit {
        margin-top: 19px;
    }

    .amount-submit .form-group input {
        height: 35px;
        border-radius: 9px;
        font-size: 15px;
    }

    .display-none {
        display: none;
    }

    .err {
        color: red;
    }

    .border-red:focus {
        border: 1px solid red;
    }

    .required {
        color: red;
    }

    .error {
        display: none;
        font-size: 11px;
        color: red;
        padding: 5px 10px 0px 20px;
    }

    /*.bid-post .bid-details{
      min-height:300px;
    }*/

    .content-footer {
        display: block;
        ;
    }
</style>

@if(!empty($err))
<div class="alert alert-danger">
    <strong>Hello <?php echo $users->contact_name; ?></strong>, {{$err}}.
</div>
@else
<section class="content">

    <div class="row" style="display:flex; justify-content:center">
        <div class="col-xs-11 col-sm-10 col-md-8 new-bids">
            <h2 class="page-header px-3">New Bids</h2>
            @if(count($posts)> 0)

            @foreach($posts as $p)
            <div id="bid-post_{{$p->postid}}" class="bid-post">
                <!-- Post -->
                <div class="post clearfix">
                    <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="{{ url('img/photo.png') }}" alt="User Image">
                        <span class="username">
                            <a href="#">{{ $p->client_name }}</a>
                            <span class="description pull-right"><i class="fa fa-clock-o"></i> {{$carbon->parse($p->expired_at)->gt($carbon->now())?'Expiring on':'Expired on'}} {{$carbon->parse($p->expired_at)->format('d M')}}</span>
                        </span>
                        <span class="description">posted - {{ $p->created_at }}</span>
                    </div>
                    <p>{{ $p->description }}
                    </p>
                    <!-- /.user-block -->
                    <div class="row" style="display:flex; justify-content:center">

                        <div class="bid-details col-md-11">
                            @foreach($p as $k=>$m)
                            @if( $k=="postid" || $k=="client_name" || $k=="description" || $k=="created_at" || $k=="file_attached" || $k =="expired_at" )
                            @continue;
                            @else
                            <div class="latest-item col-md-12 pull-left">
                                <div class="title col-md-4">
                                    {{ getName($k) }}
                                </div>
                                <div class="value col-md-8">{{ (empty($m))?'-': $m}}</div>
                            </div>
                            @endif
                            @endforeach
                            <div class="latest-item col-md-12 pull-left">
                                @if(isset($p->file_attached) && $p->file_attached !='')
                                <div class="col-md-12 m-0"><a target="_blank" class="btn btn-info btn-sm" href="{{url('/').'/client_posts/'.$p->file_attached}}">View File Attached</a></div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="content-footer px-3">
                        <button class="btn btn-danger m-1 pull-right" onclick="showModel('{{$p->postid}}')" href="#">Bid Post
                        </button>
                    </div>
                </div>
                <!-- /.post -->
            </div>
            @endforeach
            @else
            <img class="img-thumbnail" src="{{url('img/nopost.jpg')}}" style="border:0px;" />
            @endif
        </div>
    </div>

</section>
@if(count($posts)> 0)
<div id="bid-amount-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Bid Amount: <span id="subject-user"></span></h4>
            </div>
            <div class="modal-body">
                <form id="bid-form" role="form" action="{{url('/service-provider/bid-amount')}}" onsubmit="bidAmount(event)" method="post" id="form" class="">
                    <input type="hidden" value="" name="post_id" id="post_id">
                    <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="bid_amount"><span class="required">*</span> Bid Amount</label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" name='bid_amount' id='bid_amount' class="form-control">
                                <div id="bid_amount-err" class="error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="comment_on_bid"><span class="required">*</span> Comment</label>
                            </div>
                            <div class="col-md-8">
                                <textarea class="form-control" name="comment_on_bid" id="comment_on_bid"></textarea>
                                <div id="comment_on_bid-err" class="error"></div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-success" value="Submit">
                    <input type="reset" class="btn btn-success pull-right" value="Reset Form">
                </form>
            </div>
        </div>

    </div>
</div>
@endif
@endif
<script type="text/javascript">
    function bidAmount(e) {
        e.preventDefault();
        // console.log($('#bid_' + id + ' input#bid_amount').val());
        // if ($('#bid_' + id + ' input#bid_amount').val() == '') {
        //     $('#bid_' + id + ' input#bid_amount').focus();
        //     $('#bid_' + id + ' input#bid_amount').addClass('border-red');
        //     return false;
        // }
        var id = $('form #post_id').val();
        var url = $('#bid-form').attr('action');
        var data = $('#bid-form').serialize();
        var xhr = submitFormAjax(url, data);
        xhr.done(function(resp) {
            console.log(id);
            resetForm($('bid-form'));
            $('#bid-amount-modal').modal('hide');
           resetForm($('form'));
            $('#bid-post_' + id).remove();
            // toast(resp);

        }).fail(function(reason) {
            var resp = reason.responseJSON;
            console.log(resp);
            for (var i in resp) {
                $('#' + i + '-err').show();
                $('#' + i + '-err').text('*' + resp[i][0] + '*');
                console.log(resp[i]);
            }
            $('.error').show();
        });
    }

    function showBidDiv(id) {
        $('#bid_' + id).show();
        $('#a_' + id).hide();
    }

    function showModel(id) {
        $('form #post_id').val(id);
        $('#bid-amount-modal').modal('show');
    }
</script>
<?php
if (!request()->ajax()) :
    include(resource_path() . '/views/service_provider/footer.blade.php');
endif;
?>