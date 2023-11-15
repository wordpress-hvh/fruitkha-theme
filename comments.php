<?php if (!post_password_required()): ?>

    <?php
    if (comments_open()):
        ?>
        <?php if (have_comments()) ?>
        <div class="comments-list-wrap comments-list-wrap-cus">
            <h3 class="comment-count-title">
                <?php echo get_comments_number(); ?> Comments
            </h3>
            <div class="comment-list">
                <?php wp_list_comments(array('callback' => 'my_theme_comment')); ?>
            </div>
        </div>

        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="pagination-wrap mt-0">
                            <?php
                            echo paginate_comments_links(
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

    <?php endif; ?>

    <div class="comment-template">
        <?php comment_form(); ?>
    </div>
<?php endif; ?>

<?php ?>