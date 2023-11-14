<?php if (have_comments()): ?>

    <div class="comments-list-wrap comments-list-wrap-cus">
        <h3 class="comment-count-title">
            <?php echo get_comments_number(); ?> Comments
        </h3>
        <div class="comment-list">
            <?php wp_list_comments(array('callback' => 'my_theme_comment')); ?>
        </div>
    </div>

    <div class="comment-template">
        <h4>Leave a comment</h4>
        <p>If you have a comment dont feel hesitate to send us your opinion.</p>
        <form action="index.html">
            <p>
                <input type="text" placeholder="Your Name">
                <input type="email" placeholder="Your Email">
            </p>
            <p><textarea name="comment" id="comment" cols="30" rows="10" placeholder="Your Message"></textarea></p>
            <p><input type="submit" value="Submit"></p>
        </form>
    </div>

<?php endif; // have_comments() ?>