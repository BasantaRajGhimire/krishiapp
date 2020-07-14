<?php if(!request()->ajax()):
    include(resource_path().'/views/header.php');
    include(resource_path().'/views/admin/leftmail-aside.php');
 endif; ?>
<div class="row">
    <div id="first-content-section" class="col-md-5" data-page-part="menusetup/create"></div>
    <div id="second-content-section" class="col-md-7" data-page-part="menusetup/list"></div>
</div>
<?php if(!request()->ajax()):
 include(resource_path().'/views/footer.php');
endif;?>