<?php include(resource_path().'/views/header-index.blade.php'); ?>
    <div class="about_heading">
        <div class="container">
            <div class="row pt-5 pb-5">
                <div class="col-6 about_title">
                    <h1>Frequently Asked Question (FAQ)</h1>
                </div>
                <div class="col-6"></div>
            </div>
        </div>
    </div>

    <div class="faq_content">
        <div class="container">
            <div class="row">
                <div class="col-12" style="padding: 10px 8%">
                    <div class="card mt-3 mb-3 faq_container">
                        <div class="card-body m-0 p-0">
                            @foreach($data as $d)
                            <div class="card m-3">
                                <a class="headerlink" data-toggle="collapse" href="#collapse-{{$d->id}}" style="outline: none;">
                                    <div class="card-header d-flex align-items-center">
                                        <span class="question mr-2">Q:</span>
                                        <div>
                                            {{$d->question}}
                                        </div>
                                        <i class="fas fa-chevron-down ml-auto"></i>
                                    </div>

                                </a>
                                <div class="card-body collapse" id="collapse-{{$d->id}}">
                                    <div class="d-inline-flex">
                                        <span class="answer mr-2">A:</span>
                                        <p class="text-justify">{{$d->answer}}</p>

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
  
</script>
    <?php include(resource_path().'/views/frontend/testimonial.blade.php'); ?>
    <?php include(resource_path().'/views/frontend/brand.blade.php'); ?>
    <?php include(resource_path().'/views/frontend/contactus.blade.php'); ?>
    <?php include(resource_path().'/views/frontend/bottom-bar.blade.php'); ?>

    <?php include(resource_path().'/views/footer-index.blade.php'); ?>
</body>

</html>