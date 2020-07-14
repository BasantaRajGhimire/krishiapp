<?php 
include(resource_path() . '/views/client/header.blade.php'); 
$baseModel = new App\BaseModel();
?>
<style type="text/css">
	
  .nav-tabs-custom h4{
    margin-left: 30px;
    font-size: 20px;
    padding-top: 20px;
  }
</style>
<section class="content">
	<div class="row">

        <div class="col-md-10">          
          <h4><i class="fa fa-clock-o"></i> Your Post</h4>
          <?php echo view('client.timeline_content',['posts' => $posts,'users' => $users,'carbon'=> $carbon,'cbid'=> $cbid])->render(); ?>
          <!-- /.nav-tabs-custom -->
        </div>
	</div>
</section>