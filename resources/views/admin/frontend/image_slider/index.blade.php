<?php if(!request()->ajax()):
    include(resource_path().'/views/header.php');
    include(resource_path().'/views/admin/leftmail-aside.php');
 endif; ?>
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
<div class="index row">
    <div id="second-content-section" class="col-md-12" data-page-part="list"></div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    setTimeout(function(){$('#success-msg .close').click();}, 3000)
})
	baseUrl = '<?php echo url('/').'/admin/image-slider'; ?>';

</script>
<?php if(!request()->ajax()):
 include(resource_path().'/views/footer.php');
endif;?>




