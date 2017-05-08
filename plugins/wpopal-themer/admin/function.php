<?php

function wpopal_themer_is_edit_page($new_edit = null){
    global $pagenow;
    //make sure we are on the backend
 


    if($new_edit == "edit")
        return in_array( $pagenow, array( 'post.php',  ) );
    elseif($new_edit == "new") //check for new post page
        return in_array( $pagenow, array( 'post-new.php' ) );
    else //check for either new or edit
        return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );
}


/**
 *
 */
function wpopal_themer_setup_admin_setting(){


  
  if( wpopal_themer_is_edit_page() ){   
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_style('jquery-ui-css', '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
    wp_enqueue_script( 'custom-admin-scripts', get_template_directory_uri() . '/js/custom-admin.js', array( 'jquery'  ), '20131022', true );
  }

  wp_enqueue_style( 'custom-admin-css', get_template_directory_uri() . '/css/custom-admin.css', array(), '3.0.3' ); 


}
add_action( 'init', 'wpopal_themer_setup_admin_setting'  );

/**
 *
 */
function wpopal_themer_setup_fontpicker_scripts(){

  // fontIconPicker core CSS -->
  wp_enqueue_style( 'fontpicker-core-css', WPOPAL_THEMER_PLUGIN_THEMER_URL . 'assets/css/fontpicker/jquery.fonticonpicker.min.css', null, '1.0');
  // required default theme -->
  wp_enqueue_style( 'fontpicker-default-css', WPOPAL_THEMER_PLUGIN_THEMER_URL . 'assets/css/fontpicker/themes/grey-theme/jquery.fonticonpicker.grey.min.css', null, '1.0');
  // optional themes -->
  wp_enqueue_style( 'fontpicker-bootstrap-theme-css', WPOPAL_THEMER_PLUGIN_THEMER_URL . 'assets/css/fontpicker/themes/bootstrap-theme/jquery.fonticonpicker.bootstrap.min.css', null, '1.0');
  wp_enqueue_script("fontpicker-core-scripts", WPOPAL_THEMER_PLUGIN_THEMER_URL . 'assets/js/jquery.fonticonpicker.min.js', array( 'jquery' ));
  // load font-awesome in theme
  wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '3.0.3' );
}
add_action( 'admin_enqueue_scripts', 'wpopal_themer_setup_fontpicker_scripts'  );

/**
 * add ajax url
 */
function initFontJson() {
    ?>
    <script type="text/javascript">
        var fnt_icons_categorized = {
        'Font Awesome' : ["fa fa-adjust", "fa fa-adn", "fa fa-align-center", "fa fa-align-justify", "fa fa-align-left", "fa fa-align-right", "fa fa-ambulance", "fa fa-anchor", "fa fa-android", "fa fa-angellist", "fa fa-angle-double-down", "fa fa-angle-double-left", "fa fa-angle-double-right", "fa fa-angle-double-up", "fa fa-angle-down", "fa fa-angle-left", "fa fa-angle-right", "fa fa-angle-up", "fa fa-apple", "fa fa-archive", "fa fa-area-chart", "fa fa-arrow-circle-down", "fa fa-arrow-circle-left", "fa fa-arrow-circle-o-down", "fa fa-arrow-circle-o-left", "fa fa-arrow-circle-o-right", "fa fa-arrow-circle-o-up", "fa fa-arrow-circle-right", "fa fa-arrow-circle-up", "fa fa-arrow-down", "fa fa-arrow-left", "fa fa-arrow-right", "fa fa-arrow-up", "fa fa-arrows", "fa fa-arrows-alt", "fa fa-arrows-h", "fa fa-arrows-v", "fa fa-asterisk", "fa fa-at", "fa fa-automobile", "fa fa-backward", "fa fa-ban", "fa fa-bank", "fa fa-bar-chart", "fa fa-bar-chart-o", "fa fa-barcode", "fa fa-bars", "fa fa-bed", "fa fa-beer", "fa fa-behance", "fa fa-behance-square", "fa fa-bell", "fa fa-bell-o", "fa fa-bell-slash", "fa fa-bell-slash-o", "fa fa-bicycle", "fa fa-binoculars", "fa fa-birthday-cake", "fa fa-bitbucket", "fa fa-bitbucket-square", "fa fa-bitcoin", "fa fa-bold", "fa fa-bolt", "fa fa-bomb", "fa fa-book", "fa fa-bookmark", "fa fa-bookmark-o", "fa fa-briefcase", "fa fa-btc", "fa fa-bug", "fa fa-building", "fa fa-building-o", "fa fa-bullhorn", "fa fa-bullseye", "fa fa-bus", "fa fa-buysellads", "fa fa-cab", "fa fa-calculator", "fa fa-calendar", "fa fa-calendar-o", "fa fa-camera", "fa fa-camera-retro", "fa fa-car", "fa fa-caret-down", "fa fa-caret-left", "fa fa-caret-right", "fa fa-caret-square-o-down", "fa fa-caret-square-o-left", "fa fa-caret-square-o-right", "fa fa-caret-square-o-up", "fa fa-caret-up", "fa fa-cart-arrow-down", "fa fa-cart-plus", "fa fa-cc", "fa fa-cc-amex", "fa fa-cc-discover", "fa fa-cc-mastercard", "fa fa-cc-paypal", "fa fa-cc-stripe", "fa fa-cc-visa", "fa fa-certificate", "fa fa-chain", "fa fa-chain-broken", "fa fa-check", "fa fa-check-circle", "fa fa-check-circle-o", "fa fa-check-square", "fa fa-check-square-o", "fa fa-chevron-circle-down", "fa fa-chevron-circle-left", "fa fa-chevron-circle-right", "fa fa-chevron-circle-up", "fa fa-chevron-down", "fa fa-chevron-left", "fa fa-chevron-right", "fa fa-chevron-up", "fa fa-child", "fa fa-circle", "fa fa-circle-o", "fa fa-circle-o-notch", "fa fa-circle-thin", "fa fa-clipboard", "fa fa-clock-o", "fa fa-close", "fa fa-cloud", "fa fa-cloud-download", "fa fa-cloud-upload", "fa fa-cny", "fa fa-code", "fa fa-code-fork", "fa fa-codepen", "fa fa-coffee", "fa fa-cog", "fa fa-cogs", "fa fa-columns", "fa fa-comment", "fa fa-comment-o", "fa fa-comments", "fa fa-comments-o", "fa fa-compass", "fa fa-compress", "fa fa-connectdevelop", "fa fa-copy", "fa fa-copyright", "fa fa-credit-card", "fa fa-crop", "fa fa-crosshairs", "fa fa-css3", "fa fa-cube", "fa fa-cubes", "fa fa-cut", "fa fa-cutlery", "fa fa-dashboard", "fa fa-dashcube", "fa fa-database", "fa fa-dedent", "fa fa-delicious", "fa fa-desktop", "fa fa-deviantart", "fa fa-diamond", "fa fa-digg", "fa fa-dollar", "fa fa-dot-circle-o", "fa fa-download", "fa fa-dribbble", "fa fa-dropbox", "fa fa-drupal", "fa fa-edit", "fa fa-eject", "fa fa-ellipsis-h", "fa fa-ellipsis-v", "fa fa-empire", "fa fa-envelope", "fa fa-envelope-o", "fa fa-envelope-square", "fa fa-eraser", "fa fa-eur", "fa fa-euro", "fa fa-exchange", "fa fa-exclamation", "fa fa-exclamation-circle", "fa fa-exclamation-triangle", "fa fa-expand", "fa fa-external-link", "fa fa-external-link-square", "fa fa-eye", "fa fa-eye-slash", "fa fa-eyedropper", "fa fa-facebook", "fa fa-facebook-f", "fa fa-facebook-official", "fa fa-facebook-square", "fa fa-fast-backward", "fa fa-fast-forward", "fa fa-fax", "fa fa-female", "fa fa-fighter-jet", "fa fa-file", "fa fa-file-archive-o", "fa fa-file-audio-o", "fa fa-file-code-o", "fa fa-file-excel-o", "fa fa-file-image-o", "fa fa-file-movie-o", "fa fa-file-o", "fa fa-file-pdf-o", "fa fa-file-photo-o", "fa fa-file-picture-o", "fa fa-file-powerpoint-o", "fa fa-file-sound-o", "fa fa-file-text", "fa fa-file-text-o", "fa fa-file-video-o", "fa fa-file-word-o", "fa fa-file-zip-o", "fa fa-files-o", "fa fa-film", "fa fa-filter", "fa fa-fire", "fa fa-fire-extinguisher", "fa fa-flag", "fa fa-flag-checkered", "fa fa-flag-o", "fa fa-flash", "fa fa-flask", "fa fa-flickr", "fa fa-floppy-o", "fa fa-folder", "fa fa-folder-o", "fa fa-folder-open", "fa fa-folder-open-o", "fa fa-font", "fa fa-forumbee", "fa fa-forward", "fa fa-foursquare", "fa fa-frown-o", "fa fa-futbol-o", "fa fa-gamepad", "fa fa-gavel", "fa fa-gbp", "fa fa-ge", "fa fa-gear", "fa fa-gears", "fa fa-genderless", "fa fa-gift", "fa fa-git", "fa fa-git-square", "fa fa-github", "fa fa-github-alt", "fa fa-github-square", "fa fa-gittip", "fa fa-glass", "fa fa-globe", "fa fa-google", "fa fa-google-plus", "fa fa-google-plus-square", "fa fa-google-wallet", "fa fa-graduation-cap", "fa fa-gratipay", "fa fa-group", "fa fa-h-square", "fa fa-hacker-news", "fa fa-hand-o-down", "fa fa-hand-o-left", "fa fa-hand-o-right", "fa fa-hand-o-up", "fa fa-hdd-o", "fa fa-header", "fa fa-headphones", "fa fa-heart", "fa fa-heart-o", "fa fa-heartbeat", "fa fa-history", "fa fa-home", "fa fa-hospital-o", "fa fa-hotel", "fa fa-html5", "fa fa-ils", "fa fa-image", "fa fa-inbox", "fa fa-indent", "fa fa-info", "fa fa-info-circle", "fa fa-inr", "fa fa-instagram", "fa fa-institution", "fa fa-ioxhost", "fa fa-italic", "fa fa-joomla", "fa fa-jpy", "fa fa-jsfiddle", "fa fa-key", "fa fa-keyboard-o", "fa fa-krw", "fa fa-language", "fa fa-laptop", "fa fa-lastfm", "fa fa-lastfm-square", "fa fa-leaf", "fa fa-leanpub", "fa fa-legal", "fa fa-lemon-o", "fa fa-level-down", "fa fa-level-up", "fa fa-life-bouy", "fa fa-life-buoy", "fa fa-life-ring", "fa fa-life-saver", "fa fa-lightbulb-o", "fa fa-line-chart", "fa fa-link", "fa fa-linkedin", "fa fa-linkedin-square", "fa fa-linux", "fa fa-list", "fa fa-list-alt", "fa fa-list-ol", "fa fa-list-ul", "fa fa-location-arrow", "fa fa-lock", "fa fa-long-arrow-down", "fa fa-long-arrow-left", "fa fa-long-arrow-right", "fa fa-long-arrow-up", "fa fa-magic", "fa fa-magnet", "fa fa-mail-forward", "fa fa-mail-reply", "fa fa-mail-reply-all", "fa fa-male", "fa fa-map-marker", "fa fa-mars", "fa fa-mars-double", "fa fa-mars-stroke", "fa fa-mars-stroke-h", "fa fa-mars-stroke-v", "fa fa-maxcdn", "fa fa-meanpath", "fa fa-medium", "fa fa-medkit", "fa fa-meh-o", "fa fa-mercury", "fa fa-microphone", "fa fa-microphone-slash", "fa fa-minus", "fa fa-minus-circle", "fa fa-minus-square", "fa fa-minus-square-o", "fa fa-mobile", "fa fa-mobile-phone", "fa fa-money", "fa fa-moon-o", "fa fa-mortar-board", "fa fa-motorcycle", "fa fa-music", "fa fa-navicon", "fa fa-neuter", "fa fa-newspaper-o", "fa fa-openid", "fa fa-outdent", "fa fa-pagelines", "fa fa-paint-brush", "fa fa-paper-plane", "fa fa-paper-plane-o", "fa fa-paperclip", "fa fa-paragraph", "fa fa-paste", "fa fa-pause", "fa fa-paw", "fa fa-paypal", "fa fa-pencil", "fa fa-pencil-square", "fa fa-pencil-square-o", "fa fa-phone", "fa fa-phone-square", "fa fa-photo", "fa fa-picture-o", "fa fa-pie-chart", "fa fa-pied-piper", "fa fa-pied-piper-alt", "fa fa-pinterest", "fa fa-pinterest-p", "fa fa-pinterest-square", "fa fa-plane", "fa fa-play", "fa fa-play-circle", "fa fa-play-circle-o", "fa fa-plug", "fa fa-plus", "fa fa-plus-circle", "fa fa-plus-square", "fa fa-plus-square-o", "fa fa-power-off", "fa fa-print", "fa fa-puzzle-piece", "fa fa-qq", "fa fa-qrcode", "fa fa-question", "fa fa-question-circle", "fa fa-quote-left", "fa fa-quote-right", "fa fa-ra", "fa fa-random", "fa fa-rebel", "fa fa-recycle", "fa fa-reddit", "fa fa-reddit-square", "fa fa-refresh", "fa fa-remove", "fa fa-renren", "fa fa-reorder", "fa fa-repeat", "fa fa-reply", "fa fa-reply-all", "fa fa-retweet", "fa fa-rmb", "fa fa-road", "fa fa-rocket", "fa fa-rotate-left", "fa fa-rotate-right", "fa fa-rouble", "fa fa-rss", "fa fa-rss-square", "fa fa-rub", "fa fa-ruble", "fa fa-rupee", "fa fa-save", "fa fa-scissors", "fa fa-search", "fa fa-search-minus", "fa fa-search-plus", "fa fa-sellsy", "fa fa-send", "fa fa-send-o", "fa fa-server", "fa fa-share", "fa fa-share-alt", "fa fa-share-alt-square", "fa fa-share-square", "fa fa-share-square-o", "fa fa-shekel", "fa fa-sheqel", "fa fa-shield", "fa fa-ship", "fa fa-shirtsinbulk", "fa fa-shopping-cart", "fa fa-sign-in", "fa fa-sign-out", "fa fa-signal", "fa fa-simplybuilt", "fa fa-sitemap", "fa fa-skyatlas", "fa fa-skype", "fa fa-slack", "fa fa-sliders", "fa fa-slideshare", "fa fa-smile-o", "fa fa-soccer-ball-o", "fa fa-sort", "fa fa-sort-alpha-asc", "fa fa-sort-alpha-desc", "fa fa-sort-amount-asc", "fa fa-sort-amount-desc", "fa fa-sort-asc", "fa fa-sort-desc", "fa fa-sort-down", "fa fa-sort-numeric-asc", "fa fa-sort-numeric-desc", "fa fa-sort-up", "fa fa-soundcloud", "fa fa-space-shuttle", "fa fa-spinner", "fa fa-spoon", "fa fa-spotify", "fa fa-square", "fa fa-square-o", "fa fa-stack-exchange", "fa fa-stack-overflow", "fa fa-star", "fa fa-star-half", "fa fa-star-half-empty", "fa fa-star-half-full", "fa fa-star-half-o", "fa fa-star-o", "fa fa-steam", "fa fa-steam-square", "fa fa-step-backward", "fa fa-step-forward", "fa fa-stethoscope", "fa fa-stop", "fa fa-street-view", "fa fa-strikethrough", "fa fa-stumbleupon", "fa fa-stumbleupon-circle", "fa fa-subscript", "fa fa-subway", "fa fa-suitcase", "fa fa-sun-o", "fa fa-superscript", "fa fa-support", "fa fa-table", "fa fa-tablet", "fa fa-tachometer", "fa fa-tag", "fa fa-tags", "fa fa-tasks", "fa fa-taxi", "fa fa-tencent-weibo", "fa fa-terminal", "fa fa-text-height", "fa fa-text-width", "fa fa-th", "fa fa-th-large", "fa fa-th-list", "fa fa-thumb-tack", "fa fa-thumbs-down", "fa fa-thumbs-o-down", "fa fa-thumbs-o-up", "fa fa-thumbs-up", "fa fa-ticket", "fa fa-times", "fa fa-times-circle", "fa fa-times-circle-o", "fa fa-tint", "fa fa-toggle-down", "fa fa-toggle-left", "fa fa-toggle-off", "fa fa-toggle-on", "fa fa-toggle-right", "fa fa-toggle-up", "fa fa-train", "fa fa-transgender", "fa fa-transgender-alt", "fa fa-trash", "fa fa-trash-o", "fa fa-tree", "fa fa-trello", "fa fa-trophy", "fa fa-truck", "fa fa-try", "fa fa-tty", "fa fa-tumblr", "fa fa-tumblr-square", "fa fa-turkish-lira", "fa fa-twitch", "fa fa-twitter", "fa fa-twitter-square", "fa fa-umbrella", "fa fa-underline", "fa fa-undo", "fa fa-university", "fa fa-unlink", "fa fa-unlock", "fa fa-unlock-alt", "fa fa-unsorted", "fa fa-upload", "fa fa-usd", "fa fa-user", "fa fa-user-md", "fa fa-user-plus", "fa fa-user-secret", "fa fa-user-times", "fa fa-users", "fa fa-venus", "fa fa-venus-double", "fa fa-venus-mars", "fa fa-viacoin", "fa fa-video-camera", "fa fa-vimeo-square", "fa fa-vine", "fa fa-vk", "fa fa-volume-down", "fa fa-volume-off", "fa fa-volume-up", "fa fa-warning", "fa fa-wechat", "fa fa-weibo", "fa fa-weixin", "fa fa-whatsapp", "fa fa-wheelchair", "fa fa-wifi", "fa fa-windows", "fa fa-won", "fa fa-wordpress", "fa fa-wrench", "fa fa-xing", "fa fa-xing-square", "fa fa-yahoo", "fa fa-yelp", "fa fa-yen", "fa fa-youtube", "fa fa-youtube-play", "fa fa-youtube-square"]
        };
    </script>
    <?php
  }
add_action( 'admin_head', 'initFontJson');




function wpopal_themer_fnc_megamenu_item_config_toplevel( $item ) {
	
      $item_id = esc_attr( $item->ID );
?>
       	<p class="field-class_icon description description-wide">   
	        <label for="edit-menu-item-class_icon-<?php echo esc_attr($item_id); ?>"><?php esc_html_e( 'Icon Class:', "wpopal-themer" ); ?> <br>
	            <input class="menu-item-class_icon_<?php echo esc_attr($item_id); ?>" type="text" name="menu-item-class_icon[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item->class_icon); ?>">
	        </label>
       	</p>
        <script type="text/javascript">
          jQuery(document).ready(function($){
              jQuery('.menu-item-class_icon_<?php echo esc_attr($item_id); ?>').fontIconPicker({
                source: fnt_icons_categorized,
                useAttribute: false,
                theme: 'fip-bootstrap',
                emptyIconValue: 'none'
              }).on('change', function() {
                console.log($(this));
              });
            });
        </script>

        <p class="field-class_name description description-wide">   
          <label for="edit-menu-item-class_name-<?php echo esc_attr($item_id); ?>"><?php esc_html_e( 'Class Name:', "wpopal-themer" ); ?> <br>
            <input type="text" name="menu-item-class_name[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item->class_name); ?>">
          </label>
      </p>
<?php 
}
add_action( 'wpopal_megamenu_item_config_toplevel', 'wpopal_themer_fnc_megamenu_item_config_toplevel' );


if (!function_exists('wpopal_themer_fnc_custom_nav_update')) {
    add_action('wp_update_nav_menu_item', 'wpopal_themer_fnc_custom_nav_update',10, 3);
    function wpopal_themer_fnc_custom_nav_update($menu_id, $menu_item_db_id, $args ) {
      	$fields = array( 'class_icon','class_name' );
      	foreach( $fields as $field ){
	        if(!isset($_POST['menu-item-'.$field][$menu_item_db_id])){
	            $_POST['menu-item-'.$field][$menu_item_db_id] = "";
	        }
	        $custom_value = $_POST['menu-item-'.$field][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, $field, $custom_value );
      	}
    }
}