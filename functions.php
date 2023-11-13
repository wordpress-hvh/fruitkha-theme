<?php

function modify_product_cat_query($query) {
	if(!is_admin() && $query->is_tax("category")) {
		$query->set('posts_per_page', 2);
	}
}

add_action('pre_get_posts', 'modify_product_cat_query');

function my_theme_comment($comment, $args, $depth)
{
    /*
    <div class="single-comment-body">
        <div class="comment-user-avater">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/avaters/avatar1.png" alt="">
        </div>
        <div class="comment-text-body">
            <h4>Jenny Joe <span class="comment-date">Aprl 26, 2020</span> <a href="#">reply</a>
            </h4>
            <p>Nunc risus ex, tempus quis purus ac, tempor consequat ex. Vivamus sem magna,
                maximus at est id, maximus aliquet nunc. Suspendisse lacinia velit a eros
                porttitor, in interdum ante faucibus Suspendisse lacinia velit a eros porttitor,
                in interdum ante faucibus.</p>
        </div>
        <div class="single-comment-body child">
            <div class="comment-user-avater">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/avaters/avatar3.png" alt="">
            </div>
            <div class="comment-text-body">
                <h4>Simon Soe <span class="comment-date">Aprl 27, 2020</span> <a href="#">reply</a></h4>
                <p>Nunc risus ex, tempus quis purus ac, tempor consequat ex. Vivamus sem magna,
                    maximus at est id, maximus aliquet nunc. Suspendisse lacinia velit a eros
                    porttitor, in interdum ante faucibus.</p>
            </div>
        </div>
    </div>
    */
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

/*
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- owl carousel -->
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <!-- magnific popup -->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <!-- animate css -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!-- mean menu css -->
    <link rel="stylesheet" href="assets/css/meanmenu.min.css">
    <!-- main style -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- responsive -->
    <link rel="stylesheet" href="assets/css/responsive.css">
*/

function my_theme_get_actual_link()
{
    $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    return $actual_link;
}

function my_theme_register_styles()
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

add_action('wp_enqueue_scripts', 'my_theme_register_styles');

function my_theme_register_scripts()
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

add_action('wp_enqueue_scripts', 'my_theme_register_scripts');


/*
    <!-- jquery -->
    <script src="assets/js/jquery-1.11.3.min.js"></script>
    <!-- bootstrap -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- count down -->
    <script src="assets/js/jquery.countdown.js"></script>
    <!-- isotope -->
    <script src="assets/js/jquery.isotope-3.0.6.min.js"></script>
    <!-- waypoints -->
    <script src="assets/js/waypoints.js"></script>
    <!-- owl carousel -->
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- magnific popup -->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <!-- mean menu -->
    <script src="assets/js/jquery.meanmenu.min.js"></script>
    <!-- sticker js -->
    <script src="assets/js/sticker.js"></script>
    <!-- main js -->
    <script src="assets/js/main.js"></script>
*/
?>

<?php
/**
 * Pagination generator
 */
class Pagination
{
    private $items_per_page = 0;
    private $items_total = 0;
    private $mid_range = 7;
    private $page_name = 'page';
    private $base_uri = null;

    private $start_range = 0;
    private $end_range = 0;
    private $range = [];

    // styling
    private $div_class = 'pagination';
    private $ul_class = '';
    private $link_class = 'paginate';
    private $link_active_class = '';

    public function __construct()
    {
        // nothing
    }

    public function base_uri($uri)
    {
        $this->base_uri = $uri;

        // chainability
        return $this;
    }

    public function total($total)
    {
        $this->items_total = $total;

        // chainability
        return $this;
    }

    public function mid_range($range)
    {
        $this->mid_range = $range;

        // chainability
        return $this;
    }

    public function per_page($n)
    {
        $this->items_per_page = $n;

        // chainability
        return $this;
    }

    public function page_name($name)
    {
        $this->page_name = $name;

        // chainability
        return $this;
    }

    public function div_class($class)
    {
        $this->div_class = $class;

        // chainability
        return $this;
    }

    public function ul_class($class)
    {
        $this->ul_class = $class;

        // chainability
        return $this;
    }

    public function link_class($class)
    {
        $this->link_class = $class;

        // chainability
        return $this;
    }

    public function link_active_class($class)
    {
        $this->link_active_class = $class;

        // chainability
        return $this;
    }

    public function paginate()
    {
        if ($this->items_total == 0 || $this->items_per_page == 0) {
            throw new Exception('total and per_page must be set');
        }

        $base_uri = $this->base_uri;
        // If the base_uri is not set, find it out!
        if (is_null($base_uri)) {
            $base_uri = explode('?', $_SERVER['REQUEST_URI']);
            $base_uri = $base_uri[0] . '?';

            $args = array();
            foreach ($_GET as $key => $value) {
                if ($key != $this->page_name) {
                    $args[$key] = $value;
                }
            }

            if (count($args) > 0) {
                $base_uri .= http_build_query($args, '', '&amp;') . '&amp;';
            }
        }

        $total_pages = ceil($this->items_total / $this->items_per_page);
        $current_page = (int) @$_GET[$this->page_name]; // must be numeric > 0
        $output = '<div class="' . $this->div_class . '"><ul class="' . $this->ul_class . '">';

        if ($current_page < 1) {
            $current_page = 1;
        } else if ($current_page > $total_pages) {
            $current_page = $total_pages;
        }

        $prev_page = $current_page - 1;
        $next_page = $current_page + 1;

        if ($total_pages > $this->items_per_page) {
            $output .= ($current_page != 1 && $this->items_total >= $this->items_per_page)
                ? '<li><a class="paginate ' . $this->link_class . ' prev" href="' . $base_uri . $this->page_name . '=' . $prev_page . '">«</a></li>'
                : '<li class="disabled"><a class="' . $this->link_class . ' prev">«</a></li>';

            $this->start_range = $current_page - floor($this->mid_range / 2);
            $this->end_range = $current_page + floor($this->mid_range / 2);

            if ($this->start_range <= 0) {
                $this->end_range += abs($this->start_range) + 1;
                $this->start_range = 1;
            }

            if ($this->end_range > $total_pages) {
                $this->start_range -= $this->end_range - $total_pages;
                $this->end_range = $total_pages;
            }

            $this->range = range($this->start_range, $this->end_range);
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($this->range[0] > 2 && $i == $this->range[0])
                    $output .= '<li class="disabled"><a class="' . $this->link_class . '"> ... </a></li>';

                if ($i == 1 || $i == $total_pages || in_array($i, $this->range)) {
                    $output .= ($i == $current_page)
                        ? '<li class="active"><a class="' . $this->link_class . ' ' . $this->link_active_class . '" title="Go to page ' . $i . ' of ' . $total_pages . '">' . $i . '</a></li>'
                        : '<li><a class="' . $this->link_class . '" title="Go to page ' . $i . ' of ' . $total_pages . '" href="' . $base_uri . $this->page_name . '=' . $i . '">' . $i . '</a></li>';
                }

                if ($this->range[$this->mid_range - 1] < $total_pages - 1 && $i == $this->range[$this->mid_range - 1])
                    $output .= '<li class="disabled"><a class="' . $this->link_class . '"> ... </a></li>';
            }

            $output .= (($current_page != $total_pages && $this->items_total >= $this->items_per_page) && (@$_GET[$this->page_name] != 'All'))
                ? '<li><a class="' . $this->link_class . ' next" href="' . $base_uri . $this->page_name . '=' . $next_page . '">»</a></li>'
                : '<li class="disabled"><a class="' . $this->link_class . ' next">»</a></li>';
        } else {
            $output .= '<li class="disabled"><a class="' . $this->link_class . ' prev">«</a></li>';
            for ($i = 1; $i <= $total_pages; $i++) {
                $output .= ($i == $current_page)
                    ? '<li class="active"><a class="' . $this->link_class . ' ' . $this->link_active_class . '">' . $i . '</a></li>'
                    : '<li><a class="' . $this->link_class . '" href="' . $base_uri . $this->page_name . '=' . $i . '">' . $i . '</a></li>';
            }
            $output .= '<li class="disabled"><a class="' . $this->link_class . ' next">»</a></li>';
        }

        return $output . '</ul></div>';
    }
}