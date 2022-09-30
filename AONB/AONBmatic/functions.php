<?php

//
//  Custom Child Theme Functions
//

// I've included a "commented out" sample function below that'll add a home link to your menu
// More ideas can be found on "A Guide To Customizing The Thematic Theme Framework" 
// http://themeshaper.com/thematic-for-wordpress/guide-customizing-thematic-theme-framework/

// Adds a home link to your menu
// http://codex.wordpress.org/Template_Tags/wp_page_menu
//function childtheme_menu_args($args) {
//    $args = array(
//        'show_home' => 'Home',
//        'sort_column' => 'menu_order',
//        'menu_class' => 'menu',
//        'echo' => true
//    );
//	return $args;
//}
//add_filter('wp_page_menu_args','childtheme_menu_args');

// Unleash the power of Thematic's dynamic classes
// 
// define('THEMATIC_COMPATIBLE_BODY_CLASS', true);
// define('THEMATIC_COMPATIBLE_POST_CLASS', true);

// Unleash the power of Thematic's comment form
//
// define('THEMATIC_COMPATIBLE_COMMENT_FORM', true);

// Unleash the power of Thematic's feed link functions
//
// define('THEMATIC_COMPATIBLE_FEEDLINKS', true);

// Add a custom post footer
function childtheme_postfooter() {
    global $post; 
 
    if (is_single()) { ?>
        <div class="entry-utility">
            <?php printf(__('Bookmark the <a href="%1$s" title="Permalink to %2$s" rel="bookmark">permalink</a>.', 'thematic'),
                get_permalink(),
                wp_specialchars(get_the_title(), 'double') ) ?>
 
    <?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) : // Comments and trackbacks open ?>
            <?php printf(__('<a class="comment-link" href="#respond" title="Post a comment">Post a comment</a> or leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'thematic'), get_trackback_url()) ?>
    <?php elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) : // Only trackbacks open ?>
            <?php printf(__('Comments are closed, but you can leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'thematic'), get_trackback_url()) ?>
    <?php elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) : // Only comments open ?>
            <?php printf(__('Trackbacks are closed, but you can <a class="comment-link" href="#respond" title="Post a comment">post a comment</a>.', 'thematic')) ?>
    <?php elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) : // Comments and trackbacks closed ?>
            <?php _e('Both comments and trackbacks are currently closed.') ?>
    <?php endif; ?>
    <?php edit_post_link(__('Edit', 'thematic'), "\n\t\t\t\t\t<span class=\"edit-link\">", "</span>"); ?>
 
        </div><!-- .entry-utility -->
    <?php } else { ?>
        <?php if ( $post->post_type == 'post' ) { // Hide entry utility on searches ?>
            <div class="entry-utility">
                <span class="comments-link"><?php comments_popup_link(__('Leave a comment', 'thematic'), __('1 Comment', 'thematic'), __('% Comments', 'thematic')) ?></span>
                <?php edit_post_link(__('Edit', 'thematic'), "\t\t\t\t\t<span class=\"meta-sep\">|</span>\n<span class=\"edit-link\">", "</span>\t\t\t\t\t"); ?>
            </div><!-- .entry-utility -->
        <?php } ?>
    <?php }
}
add_filter ('thematic_postfooter', 'childtheme_postfooter');


?>