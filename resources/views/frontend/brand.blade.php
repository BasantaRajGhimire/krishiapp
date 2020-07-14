<?php
$brand = new \App\Admin\FrontendBrandLogo();
$brandLogo = $brand->brandLogo();
?>
<div class="container">
    <div class="brands">
        <div class="row">
            <div class="col-12 mx-auto">
                <h1 class="text-center mt-5">Our Partners</h1>
            </div>
        </div>
        <div class="row mb-5">
            <?php foreach ($brandLogo as $b) { ?>
                <div class="img-col col-6 col-sm-3 col-md-2 col-lg-2">
                    <img src="<?php echo url($b->brand_logo); ?>" alt="" srcset="">
                </div>
            <?php } ?>
        </div>
    </div>
</div>