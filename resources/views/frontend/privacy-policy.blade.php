<!doctype html>
<html lang="en">

<?php 
include(resource_path() . '/views/header-index.blade.php');
?>
<div class="about_heading">
    <div class="container">
        <div class="row pt-5 pb-5">
            <div class="col-6 about_title">
                <h1>Privacy Policy</h1>
            </div>
            <div class="col-6"></div>
        </div>
    </div>
</div>

<div class="privacypolicy">
    <div class="container">
        <div class="row">
            <div class="col-12"  style="padding: 10px 8%">
                <div class="card mt-3 mb-3">
                    <div class="card-body">
                        @php 
                            $pageDom->loadHTML($data->content);
                            echo $pageDom->saveHTML();
                        @endphp
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
include(resource_path() . '/views/frontend/contactus.blade.php');
?>
<?php 
include(resource_path() . '/views/frontend/bottom-bar.blade.php');
?>
<?php 
    include(resource_path() . '/views/footer-index.blade.php');
?>