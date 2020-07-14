<?php
include(resource_path() . '/views/header-index.blade.php');
$sliders = App\Admin\ImageSlider::orderBy('updated_at','desc')->limit(6)->get();
?>
@if(Session::has('msg'))
<div id="success-msg" class="alert alert-success float-right" role="alert" style="position:fixed; top:70px;z-index:5;right:10px;">
  <button type="button" class="close btn btn-outline-success" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true" style="color:#000">&times;</span>
  </button>
  <p class="mb-0">
    {{ Session::get('msg') }}
  </p>
</div>
@endif
<div class="intro_slider">
  <div class="owl-carousel owl-theme">
    @foreach($sliders as $s)
    <div>
      <div class="container-fluid">
        <div class="s-row row">
          <div class="col-img col-12 col-sm-12 col-md-12 col-lg-12" style="background:radial-gradient(circle at top left, rgba(40, 40, 40, 0.2) 0%, rgba(40, 40, 40, 0.2) 100%), url({{url($s->banner_image) }});background-size: cover;background-repeat: no-repeat; background-position: center;">
            <div class="for-container container" >
             <div class="for-box">
                <h1 class="for dashed wordwrap">
                  {{$s->title}}
                </h1>
                <span class="for-text">{!! $s->description !!}</span>
             </div>
            </div>
          </div>
          <!-- <div class="col-list col-12 col-sm-12 col-md-4 col-lg-4">
            <div class="list-fluid container-fluid">
              <h2>
                Our Services
              </h2>
              <div class="list-serv">
                <div class="row">
                  <div class="col-6 col-sm-6 col-md-12">
                    <div class="list-item-row">
                      <div class="list-item-icon">
                        <img src="https://www.elegantthemes.com/layouts/wp-content/uploads/2018/07/construction-icon-2-white.png" alt="" srcset="">
                      </div>
                      <div class="list-item-text">
                        <p>
                          Hello Hello Mic Testing tesing
                        </p>
                      </div>
                    </div>
                  </div>

                  <div class="col-6 col-sm-6 col-md-12">
                    <div class="list-item-row">
                      <div class="list-item-icon">
                        <img src="https://www.elegantthemes.com/layouts/wp-content/uploads/2018/07/construction-icon-1-white.png" alt="" srcset="">
                      </div>
                      <div class="list-item-text">
                        <p>
                          Hello Hello Mic Testing tesing
                        </p>
                      </div>
                    </div>
                  </div>

                  <div class="col-6 col-sm-6 col-md-12">
                    <div class="list-item-row">
                      <div class="list-item-icon">
                        <img src="https://www.elegantthemes.com/layouts/wp-content/uploads/2018/07/construction-icon-3-white.png" alt="" srcset="">
                      </div>
                      <div class="list-item-text">
                        <p>
                          Hello Hello Mic Testing tesing
                        </p>
                      </div>
                    </div>
                  </div>

                  <div class="col-6 col-sm-6 col-md-12">
                    <div class="list-item-row">
                      <div class="list-item-icon">
                        <img src="https://www.elegantthemes.com/layouts/wp-content/uploads/2018/07/construction-icon-4-white.png" alt="" srcset="">
                      </div>
                      <div class="list-item-text">
                        <p>
                          Hello Hello Mic Testing tesing
                          </b>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

<div class="get_a_quote">
  <div class="container px-md-5">
    <div class="d-flex flex-wrap align-items-center justify-content-center pt-4 pb-3">
      <div class="">
        <h4 class="free_quote m-0 pr-4" style="font-family: 'Rubik',Helvetica,Arial,Lucida,sans-serif">GET A QUOTE FOR YOUR
          PROJECT</h4>
      </div>
      <div class="">
        <a class="btn btn-warning rounded-0" data-toggle="modal" data-target="#exampleModal" style="cursor: pointer;" data-target=".bd-example-modal-lg">FREE QUOTE</a>
        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg getafreequotemodal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-body m-0 p-0">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-6 modalbackground d-flex">
                      <div class="align-self-center">
                        <h3 class="modaltitle">Get a free quote</h3>
                      </div>
                    </div>
                    <div class="col-6 freequoteform">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <form action="{{ url('quote/store') }}" style="padding-top: 100px;padding-bottom:100px;" method="post">
                        @csrf
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="Product Name *" name="product_name" value="{{ old('product_name') }}" required>
                          @if($errors->first('product_name'))
                          <span class="text text-danger">{{ $errors->first('product_name') }}</span>
                          @endif
                        </div>
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="Your Name *" name="user_name" value="{{ old('user_name') }}" required>
                          @if($errors->first('user_name'))
                          <span class="text text-danger">{{ $errors->first('user_name') }}</span>
                          @endif
                        </div>
                        <div class="form-group">
                          <input type="number" class="form-control" placeholder="Mobile No *" name="mobile" value="{{ old('mobile') }}" required>
                          @if($errors->first('mobile'))
                          <span class="text text-danger">{{ $errors->first('mobile') }}</span>
                          @endif
                        </div>
                        <div class="form-group">
                          <input type="email" class="form-control" placeholder="Email address *" name="email_address" value="{{ old('email_address') }}" required>
                          @if($errors->first('email_address'))
                          <span class="text text-danger">{{ $errors->first('email_address') }}</span>
                          @endif
                        </div>
                        <div class="form-group">
                          <textarea class="form-control" placeholder="Describe yourself" name="description" required>{{ old('description') }}</textarea>
                          @if($errors->first('description'))
                          <span class="text text-danger">{{ $errors->first('description') }}</span>
                          @endif
                        </div>
                        <button class="btn btn-warning btn-block rounded-0" type="submit">Submit</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="our_experience container">
  <div class="row">
    <div class="col-4" style="background-image: radial-gradient(circle at top left,rgba(12,12,12,0.4) 0%,rgba(12,12,12,0) 100%),url(https://www.elegantthemes.com/layouts/wp-content/uploads/2018/07/construction-13.jpg)!important;background-repeat: no-repeat;background-size: cover;">
    </div>
    <div class="col-8">
      <div class="container p-0">
        <div class="row p-3">
          <div class="col-12 mt-5">
            <h5 class="no_project" style="font-family: 'Rubik',Helvetica,Arial,Lucida,sans-serif;font-weight: 700;font-size: 42px;
              line-height: 1.2em;">No Project Too Big Or Too Small</h5>
            <p class="mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta totam deleniti iste
              blanditiis quae dolor eius voluptatem veniam hic recusandae reprehenderit reiciendis suscipit ipsa at
              voluptas magni, libero laboriosam. Pariatur nulla delectus molestias, facilis numquam dolore autem
              voluptates cupiditate. Perspiciatis tempora dolor soluta provident animi assumenda, atque quis
              deserunt pariatur nulla, esse rem adipisci voluptatum est in numquam tempore totam molestiae ab eos?
              Voluptatibus, corrupti optio natus culpa facilis at quas omnis! Dicta voluptas iste officiis laborum
              eos fuga quam veritatis nostrum nesciunt expedita, hic ullam. Placeat, cum exercitationem labore
              ducimus sapiente corrupti magnam illo accusamus totam excepturi recusandae! Minus.</p>
            <button class="mt-2 btn btn-warning rounded-0"> Learn more <i class="fas fa-arrow-right ml-3"></i>
            </button>
          </div>
        </div>
        <div class="row mp-0 mt-3">
          <div class="col-6" style="background: #ffb400;">
            <div class="text-center p-2">
              <span class="count" style="font-size: 30px;font-family: 'Rubik';">{{(new \App\Admin\AdminUsers())->serviceProviderRegisteredCount()}}</span> <span style="display: block;">suppliers</span>
            </div>
          </div>
          <div class="col-6" style="background: #2a2a2a;">
            <div class="text-center text-white p-2">
              <span class="count" style="font-size: 30px;font-family: 'Rubik';">{{(new \App\Admin\AdminUsers())->completedBidPostCount()}}</span> <span style="display: block;">completed projects</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include(resource_path() . '/views/frontend/testimonial.blade.php');
include(resource_path() . '/views/frontend/brand.blade.php');
include(resource_path() . '/views/frontend/contactus.blade.php');
include(resource_path() . '/views/frontend/bottom-bar.blade.php');
include(resource_path() . '/views/footer-index.blade.php');
?>
<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> -->
@if(Session::has('errors'))
{{-- @dd($errors) --}}
<script>
  $('#exampleModal').modal('show')
</script>
@endif
<script>

</script>
{{-- @dd($errors->default) --}}
