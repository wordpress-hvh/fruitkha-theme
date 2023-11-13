<?php
get_header();
?>

<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg breadcrumb-section-cus">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <h1>News Article</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb section -->
<!-- latest news -->
<div class="latest-news mt-80 mb-80">
    <div class="container">
        <div class="row">
            <?php while (have_posts()):
                the_post(); ?>
                <div class="col-lg-4 col-md-6">
                    <div class="single-latest-news">
                        <?php
                        global $post;
                        $first_img = '';
                        ob_start();
                        ob_end_clean();
                        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
                        if (array_key_exists(0, $matches[1])) {
                            $first_img = $matches[1][0];
                        }
                        ?>
                        <a href="<?php echo the_permalink(); ?>">
                            <?php if (!empty($first_img)): ?>
                                <img class="" src="<?php echo $first_img ?>" />
                            <?php endif ?>
                        </a>
                        <div class="news-text-box">
                            <h3><a href="<?php echo the_permalink(); ?>">
                                    <?php echo the_title() ?>
                                </a></h3>
                            <p class="blog-meta">
                                <span class="author"><i class="fas fa-user"></i>
                                    <?php echo get_the_author() ?>
                                </span>
                                <span class="date"><i class="fas fa-calendar"></i>
                                    <?php echo get_the_date("d F, y") ?>
                                </span>
                            </p>
                            <p class="excerpt">
                                <?php echo get_the_excerpt() ?>
                            </p>
                            <a href="<?php echo the_permalink(); ?>" class="read-more-btn">read more <i
                                    class="fas fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="pagination-wrap">
                            <?php
                            echo paginate_links(
                                array(
                                    'prev_text' => __('Prev'),
                                    'next_text' => __('Next'),
                                    'type' => 'list'
                                )
                            );
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end latest news -->
<?php get_footer();
?>