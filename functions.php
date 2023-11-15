<?php

function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

function wpdocs_set_comment_form_defaults( $defaults ) {
	//Here you are able to change the $defaults[]
	//For example: 
	$defaults['title_reply'] = __( '<h4>Leave a comment</h4>' );
	return $defaults;
}
add_filter( 'comment_form_defaults', 'wpdocs_set_comment_form_defaults' );

/**
 * Move the comment text field to the bottom.
 *
 * @see 	https://developer.wordpress.org/reference/hooks/comment_form_fields/
 * @param  	array  $fields 		The comment fields..
 * @return 	array
 */
function prefix_move_comment_field_to_bottom($fields)
{
    $commenter = wp_get_current_commenter();
    // What fields you want to control.
    $comment_field_cookies = $fields['cookies'];

    // The fields you want to unset (remove).
    unset($fields['author']);
    unset($fields['email']);
    unset($fields['url']);
    unset($fields['comment']);
    unset($fields['cookies']);

    // Display the fields to your own taste.
    // The order in which you place them will determine in what order they are displayed.
    $fields['author'] = '<p><input type="text" id="author" name="author" required="required" placeholder="Your Name *" value="'. esc_attr($commenter['comment_author']) .'">';
    $fields['email'] = '<input type="email" id="email" name="email" required="required" placeholder="Your Email *" value="'. esc_attr($commenter['comment_author_email']) .'"></p>';
    $fields['comment'] = '<p class="comment-form-comment"><textarea name="comment" id="comment" cols="30" rows="10" required="required" placeholder="Your Message *"></textarea></p>';
    $fields['cookies'] = $comment_field_cookies;
    return $fields;

}
add_filter('comment_form_fields', 'prefix_move_comment_field_to_bottom', 10, 1);

function modify_posts_per_page($query)
{
    if (!is_admin() && ($query->is_tax("category") || $query->is_tax("tag"))) {
        $query->set('posts_per_page', 2);
    }
}

add_action('pre_get_posts', 'modify_posts_per_page');

function my_theme_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    switch ($comment->comment_type):
        case 'pingback':
        case 'trackback':
            ?>
            <?php
            break;
        default:
            ?>
            <article id="comment-<?php comment_ID(); ?>" class="comment">
                <div class="single-comment-body">
                    <div class="comment-user-avater">
                        <img src="<?php echo get_avatar_url($comment); ?>" alt="">
                    </div>
                    <div class="comment-text-body">
                        <h4>
                            <?php echo comment_author_link(); ?> <span class="comment-date">
                                <?php echo get_comment_time('H:m:s') . " - " . get_comment_date("d F, y"); ?>
                                <?php
                                comment_reply_link(
                                    array_merge(
                                        $args,
                                        array(
                                            'reply_text' => __('Reply <span>&darr;</span>', 'my_theme'),
                                            'depth' => $depth,
                                            'max_depth' => $args['max_depth'],
                                        )
                                    )
                                );
                                ?>
                        </h4>
                        <?php comment_text(); ?>
                    </div>
                </div>
            </article><!-- #comment-## -->
            <?php
            break;
    endswitch;
}

function register_styles()
{
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style("google_font", "https://fonts.googleapis.com/css?family=Open+Sans:300,400,700", array(), '1.0', 'all');
    wp_enqueue_style("google_font_swap", "https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap", array(), '1.0', 'all');
    wp_enqueue_style("fontawesome", get_template_directory_uri() . "/assets/css/all.min.css", array(), '1.0', 'all');
    wp_enqueue_style("bootstrap", get_template_directory_uri() . "/assets/bootstrap/css/bootstrap.min.css", array(), '1.0', 'all');
    wp_enqueue_style("owl_carousel", get_template_directory_uri() . "/assets/css/owl.carousel.css", array(), '1.0', 'all');
    wp_enqueue_style("magnific_popup", get_template_directory_uri() . "/assets/css/magnific-popup.css", array(), '1.0', 'all');
    wp_enqueue_style("animate_css", get_template_directory_uri() . "/assets/css/animate.css", array(), '1.0', 'all');
    wp_enqueue_style("mean_menu_css", get_template_directory_uri() . "/assets/css/meanmenu.min.css", array(), '1.0', 'all');
    wp_enqueue_style("main_style", get_template_directory_uri() . "/assets/css/main.css", array(), '1.0', 'all');
    wp_enqueue_style("responsive", get_template_directory_uri() . "/assets/css/responsive.css", array(), '1.0', 'all');
    wp_enqueue_style("my_style", get_template_directory_uri() . "/style.css", array(), $version, 'all');
}

add_action('wp_enqueue_scripts', 'register_styles');

function register_scripts()
{
    wp_enqueue_script("jquery", get_template_directory_uri() . "/assets/js/jquery-1.11.3.min.js", array(), '1.11.3', true);
    wp_enqueue_script("bootstrap", get_template_directory_uri() . "/assets/bootstrap/js/bootstrap.min.js", array(), '1.0', true);
    wp_enqueue_script("count_down", get_template_directory_uri() . "/assets/js/jquery.countdown.js", array(), '1.0', true);
    wp_enqueue_script("isotope", get_template_directory_uri() . "/assets/js/jquery.isotope-3.0.6.min.js", array(), '1.0', true);
    wp_enqueue_script("waypoints", get_template_directory_uri() . "/assets/js/waypoints.js", array(), '1.0', true);
    wp_enqueue_script("owl_carousel", get_template_directory_uri() . "/assets/js/owl.carousel.min.js", array(), '1.0', true);
    wp_enqueue_script("magnific_popup", get_template_directory_uri() . "/assets/js/jquery.magnific-popup.min.js", array(), '1.0', true);
    wp_enqueue_script("mean_menu", get_template_directory_uri() . "/assets/js/jquery.meanmenu.min.js", array(), '1.0', true);
    wp_enqueue_script("sticker", get_template_directory_uri() . "/assets/js/sticker.js", array(), '1.0', true);
    wp_enqueue_script("main", get_template_directory_uri() . "/assets/js/main.js", array(), '1.0', true);
}

add_action('wp_enqueue_scripts', 'register_scripts');

?>