<?php
/**
 * Template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header();
?>
<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg breadcrumb-section-cus">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>Fresh adn Organic</p>
                    <h1>404 - Not Found</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb section -->
<!-- error section -->
<div class="full-height-section error-section">
    <div class="full-height-tablecell">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="error-text">
                        <i class="far fa-sad-cry"></i>
                        <h1>Oops! Not Found.</h1>
                        <p>The page you requested for is not found.</p>
                        <a href="<?php echo get_bloginfo('wpurl') ?>" class="boxed-btn">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end error section -->
<!-- logo carousel -->
<div class="logo-carousel-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="logo-carousel-inner">
                    <div class="single-logo-item">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/company-logos/1.png" alt="">
                    </div>
                    <div class="single-logo-item">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/company-logos/2.png" alt="">
                    </div>
                    <div class="single-logo-item">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/company-logos/3.png" alt="">
                    </div>
                    <div class="single-logo-item">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/company-logos/4.png" alt="">
                    </div>
                    <div class="single-logo-item">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/company-logos/5.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end logo carousel -->
<?php get_footer();
?>