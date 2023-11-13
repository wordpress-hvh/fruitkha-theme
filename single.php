<?php
get_header();
?>

<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg breadcrumb-section-cus">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <h1>Single Article</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb section -->

<!-- single article section -->
<div class="mt-80 mb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="single-article-section">

                    <?php
                    while (have_posts()):
                        the_post();
                        ?>
                        <div class="single-article-text">
                            <p class="blog-meta">
                                <span class="author"><i class="fas fa-user"></i>
                                    <?php echo get_the_author(); ?>
                                </span>
                                <span class="date"><i class="fas fa-calendar"></i> <?php echo get_the_date("d F, y") ?></span>
                            </p>
                            <h2>
                                <?php echo the_title(); ?>
                            </h2>
                            <?php echo wpautop(the_content()) ?>
                        </div>

                    <?php endwhile; // End of the loop. ?>
                    <?php comments_template( '', true ); ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar-section">
                    <div class="recent-posts">
                        <h4>Recent Posts</h4>
                        <?php 
                        $posts_per_page = SINGLE_POSTS_PER_PAGE;
                        $args_query = array(
                            'post_type' => 'post',
                            'orderby' => 'ID',
                            'post_status' => 'publish',
                            'order' => 'DESC',
                            'posts_per_page' => $posts_per_page,
                            'tax_query' => array('relation' => 'OR')
                        );
                        $result = new WP_Query($args_query);
                        if ($result->have_posts()):
                            ?>
                            <ul>
                            <?php
                            while ($result->have_posts()): $result->the_post();
                            ?>

<li><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></li>
                            
                        <?php endwhile; ?> </ul>
                        <?php endif;?>
                    </div>
                    <div class="archive-posts">
                        <h4>Archive Posts</h4>
                        <ul>
                            <?php
                            $categories = get_categories(
                                array(
                                    'orderby' => 'name',
                                    'order' => 'ASC',
                                    'number' => 5,
                                    'fields' => 'all'
                                )
                            );
                            foreach ($categories as $category) {
                                ?>
                                <li><a href="<?php echo get_category_link($category->term_id) ?>">
                                        <?php echo $category->name . " (" . $category->count . ")"; ?>
                                    </a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="tag-section">
                        <h4>Tags</h4>
                        <?php
                        $posttags = get_the_tags(get_the_ID());
                        if ($posttags) {
                            ?>
                            <ul>
                                <?php
                                foreach ($posttags as $tag) {
                                    ?>
                                    <li><a href="<?php echo get_tag_link($tag) ?>"><?php echo $tag->name; ?></a></li>
                                    <?php
                                }
                                ?>
                            </ul>
                            <?php

                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end single article section -->

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

<?php
get_footer();
?>