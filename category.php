<?php
get_header();
$category = get_the_category();
get_template_part("breadcrumb", "", array("p"=> $category[0]->description, "h" => $category[0]->name));
get_template_part("blogs-grid");
get_footer();
?>