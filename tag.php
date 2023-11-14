<?php
get_header();
$tag = get_the_tags();
get_template_part("breadcrumb", "", array("p"=> $tag[0]->description, "h" => $tag[0]->name));
get_template_part("blogs-grid");
get_footer();
?>