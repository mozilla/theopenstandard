        <footer class="footer">
            <div class="row upper-footer">
                <div class="medium-8 columns">
                    <ul class="medium-block-grid-5">
                        <?php
                        $categories = array(
                            get_term_by('slug', 'live', 'category'),
                            get_term_by('slug', 'learn', 'category'),
                            get_term_by('slug', 'innovate', 'category'),
                            get_term_by('slug', 'engage', 'category'),
                            get_term_by('slug', 'opinion', 'category')
                        );
                        foreach ($categories as $category) { ?>
                            <li class="footer-item">
                                <div class="topics-tag-normal <?php echo $category->slug; ?>">
                                    <a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->name; ?></a>
                                </div>
                                <p><?php echo $category->description; ?></p>
                            </li>
                        <?php
                        } ?>
                    </ul>
                </div>
                <!-- NEWSLETTER SIGN-UP -->
                <div class="medium-4 columns">
      <!--               <h6>Newsletter Sign-up</h6>
                    <form method="post"><input type="hidden" name="form-name" value="form 2">
                        <div class="row collapse">
                            <div class="small-8 columns">
                                <input type="text" placeholder="Enter Email Address">
                            </div>
                            <div class="small-4 columns">
                                <a href="#" class="button postfix">Sign-up</a>
                            </div>
                        </div>
                    </form> -->
                </div>
            </div>
            <div class="row">
                <div class="medium-12 columns">
                    <hr>
                </div>
            </div>
            <div class="row lower-footer">
                <div class="medium-2 columns">
                    <ul class="social-icon-links inline-list">
                        <li><a href="https://twitter.com/TheOpenStandard"><img src="<?php theme_image_src('icons/social-twitter-grey.svg'); ?>"></a></li>
                        <li><a href="https://www.facebook.com/theopenstandard"><img src="<?php theme_image_src('icons/social-facebook-grey.svg'); ?>"></a></li>
                        <li><a href="https://plus.google.com/101433152788587086227"><img src="<?php theme_image_src('icons/social-google-plus-grey.svg'); ?>"></a></li>
                    </ul>
                </div>
                <div class="medium-10 columns">
                    <?php wp_nav_menu(array('menu' => 'Footer Menu', 'menu_class' => 'inline-list')); ?>
                    <p class="disclaimer">
                        <em>
                            Hosted by Mozilla. Views expressed here represent the author's perspective, not Mozilla's opinion.
                        </em>
                    </p>
                    <p class="disclaimer">
                    Except where otherwise <a href="https://www.mozilla.org/foundation/licensing/website-content/">noted</a>,
                    content on Mozilla websites is available under a Creative Commons Attribution Share-Alike 3.0 license.
                    </p>
                </div>
            </div>
        </footer>

        <a class="exit-off-canvas"></a>
    </div>
</div>

<?php wp_footer(); ?>
<script src='<?php echo get_template_directory_uri(); ?>/_/zurb_src/dist/assets/js/all.js'></script>
<script src='<?php echo get_template_directory_uri(); ?>/_/js/vendor/moment.min.js'></script>
<script src='<?php echo get_template_directory_uri(); ?>/_/js/vendor/URI.js'></script>
<script src='<?php echo get_template_directory_uri(); ?>/_/js/vendor/jquery.history.js'></script>

<?php include 'templates/modals.php'; ?>

</body>
</html>
