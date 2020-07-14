<div class="nav-tabs-custom">
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
                  <a href="#">{{ $users->name }}</a>
                  <!-- <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a> -->
                  <span class="status pull-right {{($p->status ==1 || $p->status ==3)?'green':'red'}}">
                    {{$p->status==0?'Pending':($p->status==1?'Approved':($p->status==2?'Rejected':($p->status == 3 ? 'Completed' : 'Expired')))}}
                  </span>
                </span>
                <span class="description">posted - {{ $carbon->parse($p->created_at)->format('d M') }}</span>
              </div>
              <p class="wordwrap my-2">{{ $p->description }}</p>
            </div>
            <div id="timeline-footer" class="timeline-footer">
              @if($p->status==1)
              <h5 class="timeline-header"><i class="fa fa-thumbs-up"></i> {{$cbid->getBidCount($p->id)==0?'No':$cbid->getBidCount($p->id)}} vendor Bided on your post.
                <span class="expire pull-right">Expiring on <a>{{$carbon->parse($p->expired_at)->format('d M')}}</a></span>
              </h5>
              @endif
              <a class="btn btn-warning btn-flat btn-xs" href="{{ url('/client/client-post').'/'.$p->id.'?post_token='.$users->remember_token }}">View more</a>
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