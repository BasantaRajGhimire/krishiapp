<?php include(resource_path() . '/views/service_provider/header.blade.php');
$baseModel = new App\BaseModel();
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
                        <a href="#">{{ $p->name }}</a>
                        <span class="status pull-right {{($p->status==1)?'Delivered':'Expired'}}">{{($p->status==1)?'Delivered':'Delivery Expired'}}</span>
                      </span>
                      <span class="description">posted - {{ $carbon->parse($p->created_at)->format('d M') }}</span>
                    </div>
                    <p class="my-2 pl-2">{{ $p->description }}</p>
                  </div>
                  <div id="timeline-footer" class="timeline-footer">
                    <div class="card-body" style="padding-left:10%">
                      <div class="row align-items-center">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="d-flex align-items-center flex-wrap">
                            <div class="d-flex align-items-center">
                              <img src="{{url('/img/vendor3.jpg')}}" width="50" height="50" class="img-circle img-bordered-sm mr-3" />
                              <div>
                                <div class="d-flex align-items-center ">
                                  <p style="margin-bottom: 0px !important"><a href=""><strong>{{$users->contact_name}}</strong></a></p>
                                  @if(!empty($users->badge))
                                  <h5 class="badge badge-success rounded-circle m-0 ml-2 ttooltip">
                                    <i class="fa fa-check-circle"></i>
                                    <span class="ttooltiptext">This is a trusted and verified accountThis is a trusted and verified accountThis is a trusted and verified account</span>
                                  </h5>
                                  @endif
                                </div>
                                <p class="description" style="margin:0px !important;">Bided at - {{ $carbon->parse($p->bided_at)->format('d M') }}</p>
                              </div>
                            </div>
                            <div class="pl-4 align-items-center">
                              <p class="stars starrr Delivered" style="text-align:left !important;" data-rating="{{$p->stars}}"></p>
                              <p class="description pd-10" style="margin:0px !important;text-align:left !important;">Rating: ({{$p->stars}}/5)</p>
                            </div>
                          </div>
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
include(resource_path() . '/views/service_provider/footer.blade.php');
?>