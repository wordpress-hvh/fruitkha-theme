<?php
$tag_query_name = TAG_QUERY_NAME;
$page_new_name = PAGE_NEW_NAME;
$term = get_queried_object();
$slug = $term->slug;
get_template_part("page", $page_new_name, array($tag_query_name => $slug));
?>