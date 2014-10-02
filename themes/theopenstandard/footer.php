        <footer class="footer">
            <div class="row upper-footer">
                <div class="medium-8 columns">
                    <ul class="medium-block-grid-5">
                        <?php
                        $featured_term_id = get_category_by_slug('featured')->term_id;
                        $uncategorized_term_id = get_category_by_slug('uncategorized')->term_id;
                        $sponsored_term_id = get_category_by_slug('sponsored')->term_id;

                        $categories = get_terms('category', array('hide_empty' => false, 'exclude' => array($featured_term_id, $uncategorized_term_id, $sponsored_term_id)));
                        foreach ($categories as $category) { ?>
                            <li class="footer-item">  
                                <div class="topics-tag-normal <?php echo $category->slug; ?>">
                                    <a href="#"><?php echo $category->name; ?></a>
                                </div>
                                <p><?php echo $category->description; ?></p>
                            </li>
                        <?php
                        } ?>
                    </ul>
                </div>
                <!-- NEWSLETTER SIGN-UP -->
                <div class="medium-4 columns">
                    <h6>Newsletter Sign-up</h6>
                    <form method="post"><input type="hidden" name="form-name" value="form 2">
                        <div class="row collapse">
                            <div class="small-8 columns">
                                <input type="text" placeholder="Enter Email Address">
                            </div>
                            <div class="small-4 columns">
                                <a href="#" class="button postfix">Sign-up</a>
                            </div>
                        </div>
                    </form>
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
                        <li><a href="#"><img src="http://5c4cf848f6454dc02ec8-c49fe7e7355d384845270f4a7a0a7aa1.r53.cf2.rackcdn.com/assets/images/a2e1b1fb30d095212b505fbc74e7ff6e9fa47c06/social-twitter.svg"></a></li>
                        <li><a href="#"><img src="http://5c4cf848f6454dc02ec8-c49fe7e7355d384845270f4a7a0a7aa1.r53.cf2.rackcdn.com/assets/images/8930e95d705cd0669eb01ee3d53552220d521513/social-facebook.svg"></a></li>
                        <li><a href="#"><img src="http://5c4cf848f6454dc02ec8-c49fe7e7355d384845270f4a7a0a7aa1.r53.cf2.rackcdn.com/assets/images/2269641b25f1cb8652c7219f66d53accb3fb80d6/social-google-plus.svg"></a></li>
                    </ul>
                </div>
                <div class="medium-10 columns">
                    <?php wp_nav_menu(array('name' => 'Footer Menu', 'menu_class' => 'inline-list')); ?>
                    <p class="disclaimer">Portions of this content are ©<?php echo date('Y'); ?> by individual mozilla.org contributors. Content available under Creative Commons licence.</p>
                </div>
            </div>
        </footer>

        <a class="exit-off-canvas"></a>
    </div>
</div>

<?php wp_footer(); ?>
<script src='http://5c4cf848f6454dc02ec8-c49fe7e7355d384845270f4a7a0a7aa1.r53.cf2.rackcdn.com/js/1ea3de023f49f2fb0ce7bf13cb499969cb222fca/assets/js/all.js'></script>
</body>
</html>
