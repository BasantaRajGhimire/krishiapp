<?php 
    include(resource_path() . '/views/header-index.blade.php');
?>
<div class="about_heading">
    <div class="container">
        <div class="row pt-5 pb-5">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
              <div class="about_title">  <h1>About our Company</h1></div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6"></div>
        </div>
    </div>
</div>


<div class="about_content">
    <div class="container">
        <div class="row mt-5 mb-5">
            <div class="col-12 about-us">
                @php 
                    $pageDom->loadHTML($data->content);
                    echo $pageDom->saveHTML();
                @endphp
            </div>
        </div>
    </div>
</div>

<div class="about_features">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 bg-light pl-5">
                <h3 class="pt-5 feature_title">Features that do work</h3>
                <ul class="mt-5 mb-5 pl-0 features_listing">
                    <li>
                        <h4>
                            <i class="fas fa-chevron-right mr-2"></i>
                            Easy UI
                        </h4>
                        <ul>
                            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum, illo.</li>
                        </ul>
                    </li>
                    <li>
                        <h4>
                            <i class="fas fa-chevron-right mr-2"></i>
                            Easy UI
                        </h4>
                        <ul>
                            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur, fugiat.</li>
                        </ul>
                    </li>
                    <li>
                        <h4>
                            <i class="fas fa-chevron-right mr-2"></i>
                            Easy UI
                        </h4>
                        <ul>
                            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur, fugiat.</li>
                        </ul>
                    </li>
                    <li>
                        <h4>
                            <i class="fas fa-chevron-right mr-2"></i>
                            Easy UI
                        </h4>
                        <ul>
                            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur, fugiat.</li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-sm-12 col-md-8 col-lg-8 about_background"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    //var data = "{{$data->content}}";
    //$('.about-us').html(data);
</script>
<?php 
include(resource_path() . '/views/frontend/contactus.blade.php');
?>
<?php 
include(resource_path() . '/views/frontend/bottom-bar.blade.php');
?>
<?php 
    include(resource_path() . '/views/footer-index.blade.php');
?>