<?php
$p = '';
$h = '';
if (isset($args)) {
    if (array_key_exists('p', $args)) {
        $p = $args['p'];
    }
    if (array_key_exists('h', $args)) {
        $h = $args['h'];
    }
}
?>

<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p><?php echo $p; ?></p>
                    <h1><?php echo $h; ?></h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb section -->