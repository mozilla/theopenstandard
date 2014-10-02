<div class="comments">
    <?php

        if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
            die ('Please do not load this page directly. Thanks!');

        if (post_password_required()) { ?>
            <?php _e('This post is password protected. Enter the password to view comments.','html5reset'); ?>
        <?php
            return;
        }
    ?>

    <?php if (comments_open()): ?>

        <h2 class="text-center">Get in on the conversation</h2>
        <p class="text-center">Lorem ipsum dolor sit amet, consectur adipiscing elit.</p>

        <div class="cancel-comment-reply">
            <?php cancel_comment_reply_link(); ?>
        </div>

        <?php if (get_option('comment_registration') && !is_user_logged_in()): ?>
            <p><?php _e('You must be','html5reset'); ?> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('logged in','html5reset'); ?></a> <?php _e('to post a comment.','html5reset'); ?></p>
        <?php endif; ?>

        <div class="comments-item">
            <div class="comments-item-pic">
                <?php echo get_wp_user_avatar(wp_get_current_user(), 60); ?>
            </div>
            <div class="comments-item-comment">
                <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
                    <input type="hidden" name="form-name" value="form 2">
                    
                    <input placeholder="Your Name" type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />

                    <input placeholder="Your Email" type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />

                    <textarea placeholder="Your Comment" name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea>
                    <input class="button" name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment','html5reset'); ?>" />
                    <?php comment_id_fields(); ?>
                </form>

                <?php do_action('comment_form', $post->ID); ?>

            </div>
        </div>
    <?php endif; ?>

    <?php if (have_comments()): ?>
        <ul>
            <?php wp_list_comments(); ?>
        </ul>

        <?php paginate_comments_links(); ?>
     <?php else: // this is displayed if there are no comments so far ?>

        <?php if (comments_open()): ?>
            <!-- If comments are open, but there are no comments. -->

         <?php else : // comments are closed ?>
            <p><?php _e('Comments are closed.','html5reset'); ?></p>

        <?php endif; ?>
        
    <?php endif; ?>
</div>