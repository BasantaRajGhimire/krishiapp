<?php if(!request()->ajax()):
    include(resource_path().'/views/header.php');
    include(resource_path().'/views/admin/leftmail-aside.php');
 endif; ?>
<div class="index row">
    <div id="first-content-section" class="col-md-5" data-page-part="create"></div>
    <div id="second-content-section" class="col-md-7" data-page-part="list"></div>
</div>
<script type="text/javascript">
	baseUrl = '<?php echo url('/').'/admin/material-brand'; ?>';
</script>
<?php if(!request()->ajax()):
 include(resource_path().'/views/footer.php');
endif;?>




