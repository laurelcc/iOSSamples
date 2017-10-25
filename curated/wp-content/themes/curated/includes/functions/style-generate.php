<?php

// init
$curated = get_option('curated');

// photo
if ( isset( $curated['photo_style'] ) && $curated['photo_style'] !== 'circle' ) :
echo '.meta-author .author-thumb img, .comment-list li.comment > div img.avatar { border-radius: 0; }';
endif; 

// profile
if ( isset( $curated['profile_style'] ) && $curated['profile_style'] !== 'left' ) :
	echo '.meta-author .author-info { text-align: center; }'.
	'.meta-author .author-info, .meta-author .author-thumb { margin: 0 auto; }'.
	'.meta-author .author-thumb img { float:none; margin-bottom: 15px; }';
endif;

// boxed wrap
if ( $curated['boxed_on'] == true ) :

	$bg_boxed = '';
	if ( !empty( $curated['body_background']['background-color'] ) && $curated['body_background']['background-color'] != '#212121' ) :
		$bg_boxed .= 'background-color: '. $curated['body_background']['background-color'] .';';
	endif;

	if ( !empty( $curated['body_background']['background-repeat'] ) ) :
		$bg_boxed .= 'background-repeat: '. $curated['body_background']['background-repeat'] .';';
	endif;

	if ( !empty( $curated['body_background']['background-size'] ) ) :
		$bg_boxed .= 'background-size: '. $curated['body_background']['background-size'] .';';
	endif;

	if ( !empty( $curated['body_background']['background-attachment'] ) ) :
		$bg_boxed .= 'background-attachment: '. $curated['body_background']['background-attachment'] .';';
	endif;

	if ( !empty( $curated['body_background']['background-image'] ) ) :
		$bg_boxed .= 'background-image: url("'. $curated['body_background']['background-image'] .'");';
	endif;

	if ( isset( $bg_boxed ) && !empty( $bg_boxed ) ) :
	echo '#body-maha {'.$bg_boxed.'}';
	endif;

	echo '#body-background { margin: 0 auto;}'.
	'@media (min-width: 1200px){#body-background, #main-nav-bar.on-stuck { width: 1200px; } }'.
	'@media (max-width: 1199px) and (min-width: 992px) {#body-background, #main-nav-bar.on-stuck { width: 997px; } }'.
	'@media (max-width: 991px) and (min-width: 768px) {#body-background, #main-nav-bar.on-stuck { width: 773px; } }';

endif;

// font 2
if ( is_array( $curated['font_2'] ) ) :
	$font_2 = '';
	if ( !empty( $curated['font_2']['font-family'] ) && $curated['font_2']['font-family'] != 'Roboto' ) :
		$font_2 .= 'font-family: '. $curated['font_2']['font-family'].';';
	endif;

	if ( !empty( $curated['font_2']['font-weight'] ) && $curated['font_2']['font-weight'] != '400' ) :
		$font_2 .= 'font-weight: '. $curated['font_2']['font-weight'].';';
	endif;

	if ( !empty( $curated['font_2']['font-style'] ) ) :
		$font_2 .= 'font-style: '. $curated['font_2']['font-style'].';';
	endif;
	
	if ( isset( $font_2 ) && !empty( $font_2 ) ) :
	echo 'body, .i-slide .meta-info .entry-date, .comment-list .comment-meta {'.$font_2.'}';
	endif;

	$font_2 = '';
	if ( !empty( $curated['font_2']['font-size'] ) && $curated['font_2']['font-size'] != '15px' ) :
		$font_2 .= 'font-size: '. $curated['font_2']['font-size'].';';
	endif;

	if ( isset( $font_2 ) && !empty( $font_2 ) ) :
	echo 'body {'.$font_2.'}';
	endif;
endif; 


// font 1
if ( is_array( $curated['font_1'] ) ) :

	$font_1 = '';
	if ( !empty( $curated['font_1']['font-family'] ) && $curated['font_1']['font-family'] != 'Poppins' ) :
		$font_1 .= 'font-family :'. $curated['font_1']['font-family'].';';
	endif;

	if ( !empty( $curated['font_1']['font-weight'] ) && $curated['font_1']['font-weight'] != '600' ) :
		$font_1 .= 'font-weight :'. $curated['font_1']['font-weight'].';';
	endif;

	if ( !empty( $curated['font_1']['font-style'] ) ) :
		$font_1 .= 'font-style :'. $curated['font_1']['font-style'].';';
	endif;

	if ( isset( $font_1 ) && !empty( $font_1 ) ) :
	echo 'h1, h2, h3, h4, h5, h6,'.
	'.widget_popular_post .nav-popular-post li a, .social_subscribe .social-network .social-network-count,'.
	'.thumb-runtext a, .lwa-status-confirm, .lwa-status-invalid, .i-review, .meta-info, .meta-info .entry-author a, .count-data, .maha-progress-bar, .meta-tags, .meta-review .review-visual .visual-value, .nf404-text, .nf404-title, .i-divider span, .i-message-box .i-mb-title, .comment-list .reply, .comment-list .comment-author, #respond #submit,'.
	'.wpcf7-submit, .woocommerce .shop_table .actions .button, .woocommerce .shipping-calculator-form .button, .woocommerce .single_add_to_cart_button, .woocommerce #review_form_wrapper .form-submit #submit, .track_order .button, .maha-woo .button, #place_order,.woo-button, .i-button, .mh-button,'.
	'.pagination, .content-pagination, .woocommerce-pagination ul li .page-numbers, .i-toggle .toggle-nav, .i-tabs .tab-nav li a, .dropcap,'.
	'#bbpress-forums li.bbp-header ul.forum-titles, li.bbp-topic-title > .bbp-topic-permalink, li.bbp-topic-title > .bbp-topic-permalink, .bbp-reply-content .bbp_author_name > a:first-child, li.bbp-forum-info .bbp-forum-title {'.$font_1.'}';
	endif;
endif;


// font 3
if ( is_array( $curated['font_3'] ) ) :
	$font_3 = '';
	if ( !empty( $curated['font_3']['font-family'] ) && $curated['font_3']['font-family'] != 'Poppins' ) :
		$font_3 .= 'font-family :'. $curated['font_3']['font-family'].';';
	endif;

	if ( !empty( $curated['font_3']['font-weight'] ) && $curated['font_3']['font-weight'] != '600' ) :
		$font_3 .= 'font-weight :'. $curated['font_3']['font-weight'].';';
	endif;

	if ( !empty( $curated['font_3']['font-style'] ) ) :
		$font_3 .= 'font-style :'. $curated['font_3']['font-style'].';';
	endif;

	if ( isset( $font_3 ) && !empty( $font_3 ) ) :
	echo '.main-ul-nav ul li a, .mobile-bar ul li, .ul-nav ul li, .top-bar .top-user {'.$font_3.'}';
	endif;
endif;

// accent 1
if ( isset( $curated['accent_1'] ) && $curated['accent_1'] != '#31bb89' ) :
	echo '.mobile-bar #close-mobile-bar:hover, .mobile-bar ul li a:hover, .mobile-bar ul li.current-menu-item > a'.
	'{color:'.$curated['accent_1'].';}';
endif;


// accent 2
if ( isset( $curated['accent_2'] ) && $curated['accent_2'] != '#e55234' ) :
	echo '.woo-maha ul.products li.product .price,'.
	'.woo-maha div.product div.summary .product_meta .posted_in a,'.
	'.woo-maha label .required,'.
	'.shop_table.order_details .order_item .product-name a,'.
	'.order-number a,'.
	'.order-actions a,'.
	'{ color: '.$curated['accent_2'].'}';

	// woo
	echo '.woo-button,'.
	'.woo-maha ul.products li.product a.button:hover,'.
	'.woo-maha div.product form.cart .button,'.
	'.woocommerce .shop_table .actions .button,'.
	'.woocommerce .shipping-calculator-form .button,'.
	'#place_order,'.
	'.woocommerce #review_form_wrapper .form-submit #submit,'.
	'.maha-woo .button,'.
	'.woo-maha .track_order input.button,'.
	'.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,'.
	'{ background-color:'.$curated['accent_2'].'}';

	// buddy
	echo '#buddypress table.profile-fields .data,'.
	'#buddypress table.profile-fields .data a{ color:'. $curated['accent_2'].'}';
endif;


// top nav
if ( isset( $curated['th_bg_color'] ) && $curated['th_bg_color'] != '#212121' ) :
	echo '#top-bar-sticky, .ul-nav ul li ul, .mobile-bar { background-color: '.$curated['th_bg_color'].'}';
	echo '@media (max-width: 767px) { #body-maha{background-color: '.$curated['th_bg_color'].' !important;} }';
endif;

if ( isset( $curated['th_txt_color']['regular'] ) && $curated['th_txt_color']['regular'] != '#eaeaea' ) :
	echo '#top-bar-sticky, #top-bar-sticky a,'.
	'.mobile-bar ul li a, .mobile-bar ul li .navmob-sub-menu:hover, .mobile-bar ul li .navmob-sub-menu .tm-up-open-mini, .mobile-bar #close-mobile-bar'.
	'{ color: '.$curated['th_txt_color']['regular'].'}';
endif;

if ( isset( $curated['th_txt_color']['hover'] ) && $curated['th_txt_color']['hover'] != '#31bb89' ) :
	echo '#top-bar-sticky a:hover, #top-bar-sticky .current-menu-item a'.
	'{ color:'.$curated['th_txt_color']['hover'].'}';
endif;

// main nav
if ( isset( $curated['mh_txt_color']['regular'] ) && $curated['mh_txt_color']['regular'] != '#333333' ) :
	echo '.main-ul-nav ul li a, .open-cart-form, .open-search-form, #main-search .close-search-form { color: '.$curated['mh_txt_color']['regular'].'}';
	echo '#main-nav-bar.on-stuck, #main-nav-bar:not(.on-stuck) .main-ul-nav {'.
		'-webkit-box-shadow: 0 -4px 0'. $curated['mh_txt_color']['regular']. 'inset;'.
		'-moz-box-shadow: 0 -4px 0'. $curated['mh_txt_color']['regular'].' inset;'.
		'box-shadow: 0 -4px 0'. $curated['mh_txt_color']['regular'].' inset; }';
endif;

if ( isset( $curated['mh_txt_color']['hover'] ) && $curated['mh_txt_color']['hover'] != '#31bb89' ) :
	echo '.main-ul-nav ul li:hover a { color: '.$curated['mh_txt_color']['hover'].'}';
endif;

if ( isset( $curated['mh_sub_txt_color'] ) && $curated['mh_sub_txt_color'] != '#333333' ) :
	echo '.main-ul-nav .nav-sub-wrap .nav-sub-menus ul li a,'.
	'.main-ul-nav .nav-sub-wrap .nav-sub-posts .entry-title { color: '.$curated['mh_sub_txt_color'].'}';
endif;

if ( isset( $curated['mh_sub_bg_color']['regular'] ) && $curated['mh_sub_bg_color']['regular'] != '#ffffff' ) :
	echo '.main-ul-nav ul li .nav-sub-wrap .nsw { background-color: '.$curated['mh_sub_bg_color']['regular'].'}';
endif;

if ( isset( $curated['mh_sub_bg_color']['hover'] ) && $curated['mh_sub_bg_color']['hover'] != '#ebebeb' ) :
	echo '.main-ul-nav .nav-sub-wrap .nav-sub-menus ul li:hover { background-color: '.$curated['mh_sub_bg_color']['hover'].'}';
endif;

if ( isset( $curated['mh_search_background_color'] ) && $curated['mh_search_background_color'] != '#f6f6f6' ) :
	echo '#con-search{ background-color: '. $curated['mh_search_background_color'].' }';
endif;

if ( isset( $curated['mh_search_text_color'] ) && $curated['mh_search_text_color'] != '#bebebe' ) :
	echo '#main-search .search-field { color:'.$curated['mh_search_text_color'].' }';
endif;


// Heading color
if ( isset( $curated['co_txt_color_1'] ) && $curated['co_txt_color_1'] != '#333333' ) :
	
	if ( isset( $curated['color_scheme'] ) && $curated['color_scheme'] != true ) :

	echo '.mh-body.dark .page-wrapper h1, .mh-body.dark .page-wrapper h1 a,'.
	'.mh-body.dark .page-wrapper h2, .mh-body.dark .page-wrapper h2 a,'.
	'.mh-body.dark .page-wrapper h3, .mh-body.dark .page-wrapper h3 a,'.
	'.mh-body.dark .page-wrapper h4, .mh-body.dark .page-wrapper h4 a,'.
	'.mh-body.dark .page-wrapper h5, .mh-body.dark .page-wrapper h5 a,'.
	'.mh-body.dark .page-wrapper h6, .mh-body.dark .page-wrapper h6 a,'.
	'.mh-body.dark .page-wrapper .meta-tags,'.
	'.mh-body.dark .page-wrapper .next-prev i,'.
	'.mh-body.dark .page-wrapper .meta-info .entry-author a,'.
	'.mh-body.dark .page-wrapper .comment-list .comment-author .fn,'.
	'.mh-body.dark .page-wrapper .widget_popular_post .nav-popular-post li a,'.
	'.mh-body.dark .page-wrapper .i-divider span,'.
	'.mh-body.dark .page-wrapper .i-message-box .i-mb-title,'.
	'.mh-body.dark .dropcap.square, .mh-body.dark .dropcap.circle, .mh-body.dark .dropcap.normal,'.
	'.mh-body.dark .i-toggle .toggle-nav,'.
	'.mh-body.dark .i-tabs .tab-nav li a,'.
	'.mh-body.dark .maha-progress-bar,'.
	'.mh-body.dark .nf404-title,'.
	'.mh-body.dark .social_subscribe .social-network .social-network-count,'.
	'.mh-body.dark .page-wrapper .thumb-runtext a,'.
	'.mh-body.dark .timeline-cap,'.
	'.mh-body.dark .comment-list .comment-author .fn,'.
	'.mh-body.dark strong,'.
	'.mh-body.dark mark { color: '.$curated['co_txt_color_1'].'}';

	echo '.mh-body.dark #bbpress-forums li.bbp-header ul.forum-titles,'.
	'.mh-body.dark li.bbp-topic-title > .bbp-topic-permalink,'.
	'.mh-body.dark .bbp-reply-content .bbp_author_name > a:first-child,'.
	'.mh-body.dark li.bbp-forum-info .bbp-forum-title,'.
	'.mh-body.dark #bbpress-forums #bbp-single-user-details #bbp-user-navigation a,'.
	'.mh-body.dark #bbpress-forums div.bbp-reply-content .bbp-author-name a { color: '.$curated['co_txt_color_1'].' }';

	echo '.mh-body.dark li.bbp-topic-post.maha-heading-font { color: '.$curated['co_txt_color_1'].' !important; }';

	echo '.mh-body.dark .search-result .search-result-content h3,'.
	'.mh-body.dark .search-result .search-result-content h3 a,'.
	'.mh-body.dark .search-result .search-result-content .meta-info .entry-author a'.
	'{ color: '.$curated['co_txt_color_1'].'}';

	echo '.mh-body.dark .widget_popular_post .nav-popular-post li a:hover,'.
	'.mh-body.dark .widget_popular_post .nav-popular-post li a.popular-active {'.
	'-webkit-box-shadow: 0 -4px 0 '.$curated['co_txt_color_1'].' inset;'.
	'-moz-box-shadow: 0 -4px 0 '. $curated['co_txt_color_1'].' inset;'.
	'box-shadow: 0 -4px 0 '. $curated['co_txt_color_1'].' inset; }';

	else :

	echo 'h1, h1 a, h2, h2 a, h3, h3 a, h4, h4 a, h5, h5 a, h6, h6 a,'.
	'.widget_popular_post .nav-popular-post li a,'.
	'.meta-info .entry-author a,'.
	'.social_subscribe .social-network .social-network-count,'.
	'.next-prev i,'.
	'.thumb-runtext a,'.
	'.dropcap.square, .dropcap.circle, .dropcap.normal,'.
	'.i-divider span, .i-toggle .toggle-nav, .i-tabs .tab-nav li a,'.
	'.i-message-box .i-mb-title,'.
	'.timeline-cap,'.
	'.meta-tags,'.
	'.comment-list .comment-author .fn,'.
	'.nf404-title { color:'.$curated['co_txt_color_1'].'}';

	echo '.pagination a { color:' .$curated['co_txt_color_1'].' }';

	echo '#bbpress-forums li.bbp-header ul.forum-titles,'.
	'li.bbp-topic-title > .bbp-topic-permalink,'.
	'.bbp-reply-content .bbp_author_name > a:first-child,'.
	'li.bbp-forum-info .bbp-forum-title,'.
	'li.bbp-topic-post.maha-heading-font,'.
	'#bbpress-forums div.bbp-reply-content .bbp-author-name a,'.
	'#bbpress-forums #bbp-single-user-details #bbp-user-navigation a'.
	'{ color:'.$curated['co_txt_color_1'].'}';

	echo 'mark, strong { color: '. $curated['co_txt_color_1'] . '}';

	// Buddy
	echo '#buddypress ul.item-list li div.item-title > a,'.
	'#buddypress .activity-list .new_blog_post .activity-header p a:first-child,'.
	'#buddypress .activity-list .activity_update .activity-header p a:first-child,'.
	'#buddypress div.item-list-tabs ul li a,'.
	'#buddypress div.item-list-tabs ul li span,'.
	'#buddypress .mini .activity-header p a:first-child { color:'.$curated['co_txt_color_1'].'}';

	echo '.widget_popular_post .nav-popular-post li a:hover,'.
	'.widget_popular_post .nav-popular-post li a.popular-active {'.
	'-webkit-box-shadow: 0 -4px 0 '. $curated['co_txt_color_1'].' inset;'.
	'-moz-box-shadow: 0 -4px 0 '. $curated['co_txt_color_1'].' inset;'.
	'box-shadow: 0 -4px 0 '. $curated['co_txt_color_1'].' inset; }';

	endif;

	echo '#buddypress div.item-list-tabs ul li.selected a,'.
	'#buddypress div.item-list-tabs ul li.current a { border-color: '. $curated['co_txt_color_1'] .'}';

endif;


// Content color
 if ( isset( $curated['co_txt_color_2'] ) && $curated['co_txt_color_2'] != '#595858' ) :
	
	if ( isset( $curated['color_scheme'] ) && $curated['color_scheme'] != true ) :
	
	echo '.mh-body.dark .page-wrapper, .mh-body.dark .page-wrapper a,'.
	'.meta-review .review-summary,'.
	'.mh-body.dark input[type="text"],'.
	'.mh-body.dark input[type="password"],'.
	'.mh-body.dark input[type="email"],'.
	'.mh-body.dark input[type="tel"],'.
	'.mh-body.dark textarea { color: '.$curated['co_txt_color_2'].'; }';

	echo '.mh-body.dark .search-result .search-result-content,'.
	'.mh-body.dark .search-result .search-result-content a,'.
	'.mh-body.dark .search-result .search-result-content .meta-info .entry-date { color: '. $curated['co_txt_color_2'].'; }';
	
	else :

	echo 'body, a,'.
	'.i-category a,'.
	'.meta-review .review-summary,'.
	'input[type="text"], input[type="password"],'.
	'input[type="email"], input[type="tel"],'.
	'textarea { color:'. $curated['co_txt_color_2'].'; }';

	echo '.woo-maha .myaccount_user,'.
	'.woo-maha .myaccount_user > span { color:'. $curated['co_txt_color_2'].'; }';

	// Buddypress 
	echo '#buddypress ul.item-list li div.item-title span { color: '.$curated['co_txt_color_2'].'; }';
	endif;

endif;


// Meta color
if ( isset( $curated['co_txt_color_meta'] ) && $curated['co_txt_color_meta'] != '#9a9a9a' ) :
	echo '.maha-crumbs, .maha-crumbs a, .bbp-breadcrumb, .bbp-breadcrumb a,'.
	'.meta-info .entry-date,'.
	'.meta-tags a, .meta-tags span,'.
	'.np-caption,'.
	'.comment-list .reply a,'.
	'.comment-list .comment-meta a { color:'. $curated['co_txt_color_meta'].' !important; }';

	// Widget 
	echo '.social_subscribe .social-network .social-network-unit,'.
	'.widget_calendar tbody td { color:'. $curated['co_txt_color_meta'].'}';

	// bbpress 
	echo '#bbpress-forums div.bbp-reply-content .bbp-reply-permalink,'.
	'#bbpress-forums div.bbp-forum-author .bbp-author-role,'.
	'#bbpress-forums div.bbp-topic-author .bbp-author-role,'.
	'#bbpress-forums div.bbp-reply-author .bbp-author-role,'.
	'span.bbp-author-ip,'.
	'.bbp-reply-post-date,'.
	'.bbp-reply-date-ip,'.
	'li.bbp-topic-title .bbp-topic-meta,'.
	'li.bbp-topic-title .bbp-topic-meta a,'.
	'li .maha-freshness,'.
	'li .maha-freshness a,'.
	'li.bbp-topic-post,'.
	'#bbpress-forums .bbp-body li.bbp-forum-topic-reply,'.
	'span.bbp-admin-links,'.
	'span.bbp-admin-links a,'.
	'.bbp-pagination-count,'.
	'.bbp-topic-pagination a { color:'. $curated['co_txt_color_meta'].' !important; }';

	echo '.mh-body.dark .page-wrapper .meta-info .entry-date'.
	'{ color: '. $curated['co_txt_color_meta'].' }';

	// Woocommerce 
	echo '.woo-maha .product .price del,'.
	'.woo-maha #reviews #comments ol.commentlist li .comment-text p.meta time,'.
	'.woo-maha #payment ul.payment_methods li .payment_box,'.
	'.woo-maha #payment ul.payment_methods .payment_method_paypal a'.
	'{ color: '. $curated['co_txt_color_meta'].' }';

	// Buddypress 
	echo '#buddypress span.activity,'.
	'#buddypress span.highlight,'.
	'#buddypress div#item-header .mentionname,'.
	'#buddypress div.activity-meta .button,'.
	'#buddypress .acomment-options a,'.
	'#buddypress .activity-list .new_blog_post .activity-header p,'.
	'#buddypress .activity-list .new_blog_post .activity-header p a,'.
	'#buddypress .activity-list .activity_update .activity-header p,'.
	'#buddypress .activity-list .activity_update .activity-header p a,'.
	'#buddypress .standard-form .pass-title,'.
	'#buddypress .mini .activity-header p a.activity-time-since'.
	'{ color:'. $curated['co_txt_color_meta'].'}';
endif;


// background cat
if ( isset( $curated['co_cat_bg_text'] ) && $curated['co_cat_bg_text'] != '#eaeaea' ) :
	
	if ( isset( $curated['color_scheme'] ) && $curated['color_scheme'] != true ) :

	echo '.mh-body.dark .i-category .mh-cat-item { background-color:'. $curated['co_cat_bg_text'].' }';

	else :

	echo '.i-category .mh-cat-item { background-color:' . $curated['co_cat_bg_text'].' }';

	endif;

endif;



if ( isset( $curated['coe_button_bg_color'] ) && $curated['coe_button_bg_color'] != '#000000' ) :

	if ( isset( $curated['color_scheme'] ) && $curated['color_scheme'] != true ) :

	echo '.mh-body.dark .page-wrapper #respond #submit, .mh-body.dark .mh-button,'.
	'.mh-body.dark .pagination a.current,'.
	'.mh-body.dark .pagination a:not(.dot):hover,'.
	'.mh-body.dark .pagination span.current,'.
	'.mh-body.dark .content-pagination > span,'.
	'.mh-body.dark .content-pagination > a:hover,'.
	'.mh-body.dark .woocommerce-pagination ul li .page-numbers:hover,'.
	'.mh-body.dark .woocommerce-pagination ul li .page-numbers.current { background-color: '. $curated['coe_button_bg_color'].' }';

	else :

	echo '#respond #submit, .mh-button,'.
	'.pagination a.current,'.
	'.pagination a:not(.dot):hover,'.
	'.pagination span.current,'.
	'.content-pagination > span,'.
	'.content-pagination > a:hover,'.
	'.woocommerce-pagination ul li .page-numbers:hover,'.
	'.woocommerce-pagination ul li .page-numbers.current { background-color: '. $curated['coe_button_bg_color'].' }';

	endif;

endif;

if ( isset( $curated['coe_button_text_color'] ) && $curated['coe_button_text_color'] != '#ffffff' ) :

	if ( isset( $curated['color_scheme'] ) && $curated['color_scheme'] != true ) :

	echo '.mh-body.dark .page-wrapper #respond #submit, .mh-body.dark .mh-button,'.
	'.mh-body.dark .pagination a.current,'.
	'.mh-body.dark .pagination a:not(.dot):hover,'.
	'.mh-body.dark .pagination span.current,'.
	'.mh-body.dark .content-pagination > span,'.
	'.mh-body.dark .content-pagination > a:hover,'.
	'.mh-body.dark .woocommerce-pagination ul li .page-numbers:hover,'.
	'.mh-body.dark .woocommerce-pagination ul li .page-numbers.current'.
	'{ color:'. $curated['coe_button_text_color'].' }';

	else :

	echo '#respond #submit, .mh-button,'.
	'.pagination a.current,'.
	'.pagination a:not(.dot):hover,'.
	'.pagination span.current,'.
	'.content-pagination > span,'.
	'.content-pagination > a:hover,'.
	'.woocommerce-pagination ul li .page-numbers:hover,'.
	'.woocommerce-pagination ul li .page-numbers.current'.
	'{ color: '. $curated['coe_button_text_color'].' }';

	endif;

endif;



if ( isset( $curated['fwa_bg_color'] ) && $curated['fwa_bg_color'] != '#151515' ) :
	echo '#footer-sidebar { background-color: '. $curated['fwa_bg_color'].' }';
endif;

if ( isset( $curated['fwa_txt_color_1'] ) && $curated['fwa_txt_color_1'] != '#dcdcdc' ) :
	echo '#footer h1, #footer h1 a,'.
	'#footer h2, #footer h2 a,'.
	'#footer h3, #footer h3 a,'.
	'#footer h4, #footer h4 a,'.
	'#footer h5, #footer h5 a,'.
	'#footer h6, #footer h6 a,'.
	'#footer .social_subscribe .social-network .social-network-count,'.
	'#footer .widget_popular_post .nav-popular-post li a {'.
	'color: '. $curated['fwa_txt_color_1'].'; }';

	echo '#footer .widget_popular_post .nav-popular-post li a.popular-active,'.
	'#footer .widget_popular_post .nav-popular-post li a:hover {'.
	'-webkit-box-shadow: 0 -4px 0 '.$curated['fwa_txt_color_1'] .' inset;'.
	'-moz-box-shadow: 0 -4px 0 '. $curated['fwa_txt_color_1'] .' inset;'.
	'box-shadow: 0 -4px 0 '. $curated['fwa_txt_color_1'] .' inset;'.
	'}';
endif;

if ( isset( $curated['fwa_txt_color_2'] ) && $curated['fwa_txt_color_2'] != '#8b8b8b' ) :
	echo '#footer-sidebar, #footer-sidebar a { color: '. $curated['fwa_txt_color_2'].' }';
endif;


if ( isset( $curated['fc_bg_color'] ) && $curated['fc_bg_color'] != '#000000' ) :
	echo '.f-copyright { background-color:'.$curated['fc_bg_color'].' }';
endif;

if ( isset( $curated['fc_txt_color_1'] ) && $curated['fc_txt_color_1'] != '#a1a1a1' ) :
	echo '.f-copyright, .f-copyright a { color:'. $curated['fc_txt_color_1'].' }';
endif;

if ( isset( $curated['fc_link_color'] ) && $curated['fc_link_color'] == 'accent-1' ) :
	echo '.f-copyright a:hover { color: '. $curated['accent_1'].'}';
endif;

if ( isset( $curated['fc_link_color'] ) && $curated['fc_link_color'] == 'accent-2' ) :
	echo '.f-copyright a:hover { color: '. $curated['accent_2'].'}';
endif;


?>