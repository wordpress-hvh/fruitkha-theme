<!-- latest news -->
<div class="latest-news mt-150 mb-150">
    <div class="container">
        <div class="row">
            <?php while (have_posts()):
                the_post(); ?>
                <div class="col-lg-4 col-md-6">
                    <div class="single-latest-news">
                        <a href="<?php echo the_permalink(); ?>">
                            <img class="latest-news-bg" src="<?php echo get_the_post_thumbnail_url(); ?>" />
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
                                    'prev_text' => __('«'),
                                    'next_text' => __('»'),
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