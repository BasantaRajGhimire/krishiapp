<?php include(resource_path() . '/views/service_provider/header.blade.php'); 
?>

<style type="text/css">
  
  .nav-tabs-custom > .nav-tabs > li{
    border:0px;
  }
  .nav-tabs-custom h4{
    margin-left: 30px;
    font-size: 20px;
    padding-top: 20px;
  }
  .user-block{
    margin-bottom: 15px;
  }
  .latest-item{
    padding:8px;
    margin-left:10px;
    font-size:15px;
    text-align: left;
  }
  .latest-item .title{
    font-weight: bold;
    color: #188c18e0;
    letter-spacing: 0.5px;
  }
  .latest-item .value{
    color:#d92424cc;
  }
  span.expired{
    color:#e12424;
  }
</style>
<section class="content">

      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <h4><i class="fa fa-clock-o"></i> Timeline</h4>
            <div class="tab-content">
              <!-- /.tab-pane -->
              <div class="tab-pane active" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  @if(count($posts) > 0)
                    @foreach($posts as $k=>$p)
                      <li>
                        <i class="fa fa-comments bg-yellow"></i>

                        <div id="timeline_{{$p->postid}}" class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> {!! $carbon->parse($p->expired_at)->gt($carbon->now())?'<span class="expiring">Expiring on</span>':'<span class="expired">Expired </span>' !!} <a>{{ $carbon->parse($p->expired_at)->format('d M') }}</a></span>
                          <h3 class="timeline-header"><a href="#">You</a> bided for Rs. {{$p->bid_amount }} on <b>{{ $p->client_name }}'s</b> post</h3>

                          <div class="timeline-body">
                            <div class="user-block">                     
                              <img class="img-circle img-bordered-sm" src="{{ url('img/photo.png') }}" alt="User Image">                         
                              <span class="username">
                                <a href="#">{{ $p->client_name }}</a>
                                <!-- <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a> -->
                              </span>                          
                              <span class="description">posted - {{ $carbon->parse($p->created_at)->format('d M') }}</span>
                            </div>
                            <p >{{ $p->description }}</p>
                            <div id="bid-details_{{$p->postid}}" class="bid-details" style="display: none;"> 
                              @foreach($p as $k=>$m)
                              @if( $k=="postid" || $k=="client_name" || $k=="description" || $k=="created_at" )
                                @continue;
                              @else
                              <div class="latest-item col-md-12 pull-left">
                                <div class="title col-md-6">
                                    {{ getName($k) }}
                                </div>
                                <div class="value col-md-6">{{ $m }}</div>
                              </div>
                              @endif
                              @endforeach
                            </div>
                          </div>
                          <div id="timeline-footer_{{$p->postid}}" class="timeline-footer">
                            <a class="btn btn-warning btn-flat btn-xs" onclick="showDiv('{{$p->postid}}')">View more</a>
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
        <!-- /.col -->
      </div>
      <!-- /.row -->

</section>

<script type="text/javascript">
  function showDiv(id){
    $('.bid-details').hide();
    $('#bid-details_'+ id).show();
    $('#timeline-footer_'+ id + ' a').attr('onclick','hideDiv("'+id+'")');
    $('#timeline-footer_'+ id + ' a').text('View less');
  }
  function hideDiv(id){
    $('#bid-details_'+ id).hide();
    $('#timeline-footer_'+ id + ' a').attr('onclick','showDiv("'+id+'")');
    $('#timeline-footer_'+ id + ' a').text('View more');    
  }
</script>
<?php
    include(resource_path() . '/views/service_provider/footer.blade.php');
?>