<?php
$actual_link = my_theme_get_actual_link();
$parts = parse_url($actual_link);
$page = 1;
$posts_per_page = POSTS_PER_PAGE;
$category = "";
$tag = "";
$posts_per_page_name = POSTS_PER_PAGE_NAME;
$page_num_name = PAGE_NUM_NAME;
$query_name = QUERY_NAME;
$category_name = CATEGORY_QUERY_NAME;
$tag_query_name = TAG_QUERY_NAME;
if (array_key_exists($query_name, $parts)) {
    parse_str($parts[$query_name], $arr_query);
    if (array_key_exists($page_num_name, $arr_query)) {
        $page = intval($arr_query[$page_num_name]);
    }
    if (array_key_exists($posts_per_page_name, $arr_query)) {
        $posts_per_page = intval($arr_query[$posts_per_page_name]);
    }
}
if (isset($args)) {
    if (array_key_exists($tag_query_name, $args)) {
        $tag = $args[$tag_query_name];
    }
    if (array_key_exists($category_name, $args)) {
        $category = $args[$category_name];
    }
}
$args_query = array(
    'post_type' => 'post',
    'orderby' => 'ID',
    'post_status' => 'publish',
    'order' => 'DESC',
    'tax_query' => array('relation' => 'OR')
);
if (!empty($category)) {
    array_push(
        $args_query['tax_query'],
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => array($category),
        )
    );
}
if (!empty($tag)) {
    $args_query['tag'] = $tag;
}

$result_count = new WP_Query($args_query);
$count_post_publish = $result_count->post_count;

$args_query['posts_per_page'] = $posts_per_page;
$args_query['offset'] = ($posts_per_page * ($page - 1));
$result = new WP_Query($args_query);
if ($result->have_posts() == false): {
        get_template_part("404");
    }
else: {
        ?>
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
                    <?php while ($result->have_posts()):
                        $result->the_post(); ?>
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
                    <?php
                    wp_reset_postdata(); ?>
                </div>

                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <?php
                                $pagination = new Pagination();
                                $pagination->total($count_post_publish);
                                $pagination->per_page($posts_per_page);
                                $pagination->page_name($page_num_name);
                                $pagination->link_active_class("active");
                                $pagination->div_class("pagination-wrap");
                                echo $pagination->paginate();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end latest news -->


        <?php get_footer();
    ?>
    <?php
    }
endif;
?>