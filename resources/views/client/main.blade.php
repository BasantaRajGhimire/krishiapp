<?php include(resource_path() . '/views/client/header.blade.php');
?>
<?php
$latestPost = new \App\Buyer\ClientPost();
$latestPost = $latestPost->latestPost();
?>

<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        @if(empty($users->email_verified_at))
            <div id="verification" class="box">
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title=""
                            data-original-title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
                <div class="box-body">  
                    Hello <b>{{ $users->name }}</b>, Verify Your Email Address first. Go to your mail and verify it!! or
                    <button class="btn btn-danger">Resend For Verification</button>
                </div>
            </div>
        @endif
        <section class="content-header">
            <h1>
                DASHBAORD
                <small>- Client</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        

            <div id="post" class="box">
                <div class="box-header">
                    <h3 class="box-title">Hello {{ $users->name }}, </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                                title="" data-original-title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    Welcome to our bidding platform, If you want any constructing materials or any kind of services,
                    please kindly post your requirements here! Many service providers are waiting for you.
                </div>
                <div class="box-footer">
                    <a href="{{url('/client/post')}}" class="btn btn-primary">Post Your Requirement</a>
                </div>
            </div>

            <div class="col-md-7 latest">
                <div class="box">
                    <div class="box-header">
                        <h4>Latest Post</h4>
                    </div>

                    <div class="box-body">
                        @if(!empty($latestPost))
                            <blockquote>Hey
                                 <span> {{ $users->name }} </span>, Your latest
                                post details are listed here.
                            </blockquote>
                            <div class="latest-item row">
                                <div class="title col-sm-3 col-md-4">
                                    Post Category
                                </div>
                                <div class="value col-sm-9 col-md-8">
                                    {{$latestPost->category == 'M' ? 'Material' : 'Serivce'}}
                                </div>
                            </div>
                            <div class="latest-item row">
                                <div class="title col-sm-3 col-md-4">
                                    Estimated Cost
                                </div>
                                <div class="value col-sm-9 col-md-8">
                                    Rs. {{ $latestPost->estimated_cost ?? '-' }}
                                </div>
                            </div>
                            <div class="latest-item row">
                                <div class="title col-sm-3 col-md-4">
                                    Bid Duration
                                </div>
                                <div class="value col-sm-9 col-md-8">
                                    {{ $latestPost->duration_days ?? '5' }} days
                                </div>
                            </div>
                            <div class="latest-item row">
                                <div class="title col-sm-3 col-md-4">
                                    District
                                </div>
                                <div class="value col-sm-9 col-md-8">
                                    {{ $latestPost->district }}
                                </div>
                            </div>
                            <div class="latest-item row">
                                <div class="title col-sm-3 col-md-4">
                                    Full Address
                                </div>
                                <div class="value col-sm-9 col-md-8">
                                    {{ $latestPost->address }}
                                </div>
                            </div>
                            <div class="latest-item row">
                                <div class="title col-sm-3 col-md-4">
                                    Post Description
                                </div>
                                <div class="value col-sm-9 col-md-8">
                                    {{ $latestPost->description }}
                                </div>
                            </div>
                            <div class="latest-item row">
                                <div class="title col-sm-3 col-md-4">
                                    Status
                                </div>
                                <div class="value col-sm-9 col-md-8">
                                    {{ $latestPost->status }}
                                </div>
                            </div>
                        @else
                            <img class="img-thumbnail" src="{{url('img/nopost2.jpg')}}" style="border:0px;"/>
                        @endif
                    </div>
                    <div class="box-footer">
                        @if(empty($latestPost))
                            <a href="{{url('client/post')}}" class="pull-right"> <u>Create Post</u></a>
                        @else
                            <a href="{{url('client/client-post/').'/'.$latestPost->id.'?post_token='.$users->remember_token}}"
                               class="pull-right"> <u>Read More</u></a>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="col-md-5 fund">
                <div class="box">
                    <div class="box-header">
                        <h4>Welcome {{ $users->name }}</h4>
                    </div>

                    <div class="box-body">
                        <p><i class="fa fa-money"></i> Balance Fund <a
                                    class="pull-right">Rs. 0.00</a></p>
                        <!-- <blockquote>Your Post</blockquote>
                        <p >- Service Provider</p> -->

                    </div>
                    <div class="box-footer">
                        <a href="{{url('client/profile')}}" class="pull-left"> <u>View Profile</u></a>
                        <a href="#" class="pull-right"> <u>Deposit Fund</u></a>
                    </div>
                </div>
            </div>
            
            <?php echo view('client.leave_review',['reviewPost' => $reviewPost,'users'=> $users,'carbon'=> $carbon])->render();?>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.container -->
</div>

<?php
if (!request()->ajax()):
    include(resource_path() . '/views/client/footer.blade.php');
endif;
?>
