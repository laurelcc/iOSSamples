<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014
	Please be extremely cautions editing this file!

    - Shortcodes Maha Output - Mark 1.0.0

 ---------------------------------------------------------------------------*/


# Column

/* --------------------------------------------------------------------------
 * [row]
 ---------------------------------------------------------------------------*/
if (!function_exists('maha_row')) {
	function maha_row( $atts, $content = null ) {

		return '<div class="row mhrow">'. do_shortcode($content) . '</div>';

	}
	add_shortcode('row', 'maha_row');
}

/* --------------------------------------------------------------------------
 * [one_half]
 ---------------------------------------------------------------------------*/
if (!function_exists('maha_one_half')) {
	function maha_one_half( $atts, $content = null ) {
		
		return '<div class="col-sm-6">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_half', 'maha_one_half');
}

/* --------------------------------------------------------------------------
 * [one_third]
 ---------------------------------------------------------------------------*/
if (!function_exists('maha_one_third')) {
	function maha_one_third( $atts, $content = null ) {
		
		return '<div class="col-sm-4">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_third', 'maha_one_third');
}

/* --------------------------------------------------------------------------
 * [two_thirds]
 ---------------------------------------------------------------------------*/
if (!function_exists('maha_two_thirds')) {
	function maha_two_thirds( $atts, $content = null ) {
		
		return '<div class="col-sm-8">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('two_thirds', 'maha_two_thirds');
}

/* --------------------------------------------------------------------------
 * [one_fourth]
 ---------------------------------------------------------------------------*/
if (!function_exists('maha_one_fourth')) {
	function maha_one_fourth( $atts, $content = null ) {
		
		return '<div class="col-sm-3">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_fourth', 'maha_one_fourth');
}

/* --------------------------------------------------------------------------
 * [three_fourths]
 ---------------------------------------------------------------------------*/
if (!function_exists('maha_three_fourths')) {
	function maha_three_fourths( $atts, $content = null ) {
		
		return '<div class="col-sm-9">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('three_fourths', 'maha_three_fourths');
}


// Elements

/* --------------------------------------------------------------------------
 * [divider]
 ---------------------------------------------------------------------------*/
if (!function_exists('maha_divider')) {
	function maha_divider( $atts, $content = null ) {
		
		extract(shortcode_atts(
		array(
			'style' => '',
			'title' => '',
			'text_align' => ''
    ), $atts));

    $use_title = '';
    if ( $title != "" ) { $use_title = '<span>'.do_shortcode($title).'</span>'; }

		return '<div class="i-divider '.$text_align.' '.$style.'">'.$use_title.'</div>';
	}
	add_shortcode('divider', 'maha_divider');
}

/* --------------------------------------------------------------------------
 * [button]
 ---------------------------------------------------------------------------*/
if (!function_exists('maha_button')) {
	function maha_button( $atts, $content = null ) {
		
		extract(shortcode_atts(
		array(
			'size' => '',
			'url' => '',
			'text' => '',
			'target' => '',
			'color' => ''
    ), $atts));

		return '<a href="'.$url.'" class="i-button '.$color.' '.$size.'" target="'.$target.'">' . $text . '</a>';
	}
	add_shortcode('button', 'maha_button');
}

/* --------------------------------------------------------------------------
 * [dropcap]
 ---------------------------------------------------------------------------*/
if (!function_exists('maha_dropcap')) {
	function maha_dropcap( $atts, $content = null ) {
		
		extract(shortcode_atts(
		array(
			'style' => '',
			'title' => ''
    ), $atts));

		return '<span class="dropcap '.$style.'">' . do_shortcode($title) . '</span>';
	}
	add_shortcode('dropcap', 'maha_dropcap');
}

/* --------------------------------------------------------------------------
 * [highlight]
 ---------------------------------------------------------------------------*/
if (!function_exists('maha_highlight')) {
	function maha_highlight( $atts, $content = null ) {
		
		extract(shortcode_atts(
		array(
			'text' => '',
			'color' => ''
    ), $atts));

		return '<span class="i-highlight '.$color.'">' . do_shortcode($text) . '</span> ';
	}
	add_shortcode('highlight', 'maha_highlight');
}


/* --------------------------------------------------------------------------
 * [message_box ]
 ---------------------------------------------------------------------------*/
if (!function_exists('maha_message_box')) {
	function maha_message_box ( $atts, $content = null ) {
		
		extract(shortcode_atts(
		array(
			'title' => '',
			'text' => ''
    ), $atts));

		return '<div class="i-message-box"><div class="i-mb-title">' . do_shortcode($title) . '</div>' . do_shortcode($text) . '</div>';
	}
	add_shortcode('message_box', 'maha_message_box');
}

/* --------------------------------------------------------------------------
 * [tabs ]
 ---------------------------------------------------------------------------*/
if (!function_exists('maha_tabs')) {
	function maha_tabs($atts, $content = null) {
	extract(shortcode_atts(
		array(
			'position' => ''
		), $atts));

    $GLOBALS['tab_count'] = 0;
		do_shortcode( $content );

		wp_enqueue_script('maha-tabs');
		
		if( is_array( $GLOBALS['tabs'] ) ){
			
			$tab_zero = 0;
			foreach( $GLOBALS['tabs'] as $tab ){
				$tab_class = ""; if ($tab_zero==0) {$tab_class = "active";}
				$tab_key = 'i-tab-'.uniqid();
				$tabs[] = '<li class="'.$tab_class.'"><a href="#'.$tab_key.'">'.$tab['title'].'</a></li>';
				$panes[] = '<div class="'.$tab_class.'" id="'.$tab_key.'">'.$tab['content'].'</div>';
				$tab_zero++;
			}
			
			$return = '<div class="i-tabs '.$position.'"><ul class="tab-nav">'.implode( "\n", $tabs ).'</ul><div class="tab-content">'.implode( "\n", $panes )."</div></div>\n";
		}
		return $return;
	}
	add_shortcode('tabs', 'maha_tabs');
}

/* --------------------------------------------------------------------------
 * [tab ]
 ---------------------------------------------------------------------------*/
if (!function_exists('maha_tab')) {
	function maha_tab( $atts, $content ){
		extract(shortcode_atts(
		array(
			'title' => '%d',
			'id' => '%d'
		), $atts));
		
		$x = $GLOBALS['tab_count'];
		$GLOBALS['tabs'][$x] = array(
			'title' => sprintf( $title, $GLOBALS['tab_count'] ),
			'content' =>  do_shortcode($content),
			'id' =>  $id );
		
		$GLOBALS['tab_count']++;
	}
	add_shortcode( 'tab', 'maha_tab' );
}

/* --------------------------------------------------------------------------
 * [toggle ]
 ---------------------------------------------------------------------------*/
if (!function_exists('maha_toggles')) {
	function maha_toggles($atts, $content = null) {

		extract(shortcode_atts(
		array(
			'style' => ''
		), $atts));

    $GLOBALS['toggle_count'] = 0;
		do_shortcode( $content );

		wp_enqueue_script('maha-toggles');
		
		if( is_array( $GLOBALS['toggles'] ) ){
			
			$toggle_zero = 0;
			foreach( $GLOBALS['toggles'] as $toggle ){
				$toggle_class = ""; if ($toggle_zero==0) {$toggle_class = "active";}
				$toggles[] = '<div class="i-toggle">
				<div class="toggle-nav">
					<i class="icon-plus-squared"></i>
					'.$toggle['title'].'
				</div>
				<div class="toggle-content">'.$toggle['content'].'</div></div>';
				$toggle_zero++;
			}
			
			$return = '<div class="i-toggles '.$style.'">'.implode( "\n", $toggles ).'</div>'."\n";
		}

		$GLOBALS['toggles'] = array();

		return $return;
	}
	add_shortcode('toggles', 'maha_toggles');
}

/* --------------------------------------------------------------------------
 * [toggle ]
 ---------------------------------------------------------------------------*/
if (!function_exists('maha_toggle')) {
	function maha_toggle( $atts, $content ){
		extract(shortcode_atts(
		array(
			'title' => '%d'
		), $atts));
		
		$toggle_count = $GLOBALS['toggle_count'];
		$GLOBALS['toggles'][$toggle_count] = array(
			'title' => sprintf( $title, $GLOBALS['toggle_count'] ),
			'content' =>  do_shortcode($content)
		);
		
		$GLOBALS['toggle_count']++;
	}
	add_shortcode( 'toggle', 'maha_toggle' );
}

/* --------------------------------------------------------------------------
 * [video]
 ---------------------------------------------------------------------------*/
if (!function_exists('maha_video')) {
	function maha_video( $atts, $content = null ) {
		
		extract(shortcode_atts(
		array(
			'type' => '',
			'url' => '',
			'title' => '',
			'playbar' => ''
    ), $atts));
		if($playbar==0){
			$chromeless=1;
		}else{
			$chromeless=0;
		}
		$video_embed = wp_oembed_get( $url,array( 'type' => $type,'showinfo' => $title, 'title' => $title, 'info' => $title,'controls' => $playbar, 'chromeless' => $chromeless, 'rel' => 0) );
		return $ofg = '<figure class="wrapper video-wrapper">' .$video_embed. '</figure>';
	}
	add_shortcode('videoembed', 'maha_video');
}

/* --------------------------------------------------------------------------
 * [Content Full Width]
 ---------------------------------------------------------------------------*/
if (!function_exists('maha_full')) {
	function maha_full( $atts, $content = null ) {
		
		extract(shortcode_atts(
		array(
			'type' => ''
    	), $atts));

		return $ofg = '<div class="content-full-width">' .do_shortcode($content). '</div>';
	}
	add_shortcode('content_full', 'maha_full');
}

/* --------------------------------------------------------------------------
 * [Google Maps]
 ---------------------------------------------------------------------------*/
if (!function_exists('maha_maps')) {
	function maha_maps( $atts, $content = null ) {
		
		extract(shortcode_atts(
		array(
			'point' => '',
			'width' => '',
			'height' => '',
			'zoom' =>''
    	), $atts));

		return $ofg = '<div id="map-canvas" data-point="'.$point.'" data-width="'.$width.'" data-height="'.$height.'" data-zoom="'.$zoom.'" style="height:'.$height.'px; width:'.$width.'px"></div>';
	}
	add_shortcode('googlemaps', 'maha_maps');
}

/* --------------------------------------------------------------------------
 * [content_listing ]
 ---------------------------------------------------------------------------*/
if (!function_exists('maha_content_listing')) {
	function maha_content_listing ( $atts, $content = null ) {
		
		extract(shortcode_atts(
		array(
			'mode' => '',
    ), $atts));

		$content = preg_replace('/<hr .*?class="(.*?mh-listing-separator.*?)"(.*?)>/','{separator}',$content);
		$list = explode('{separator}', $content);
		$listing = '';

		if( is_array($list) ){
			foreach ($list as $value) {
				$listing .= '<div class="mh-listing-item clearfix">';
				$listing .= $value;
				$listing .= '</div>';
			}
		}

		$listing_footer = $listing_header = '';
		if( $mode == 'slider' ) {
			$listing_header = "<div class='mh-listing-header'><div class='mh-listing-page'></div></div>";
			$listing_footer = "<div class='mh-listing-footer'><div class='mh-listing-page'></div></div>";
		}

		return '<div class="mh-listing">' .$listing_header .'<div class="mh-listing-content mh-'.$mode.'" data-listing=1>' . do_shortcode($listing) . '</div>'. $listing_footer . '</div>';
	}
	add_shortcode('content_listing', 'maha_content_listing');
}



/* --------------------------------------------------------------------------
 * [bold]
 ---------------------------------------------------------------------------*/
if (!function_exists('maha_bold')) {
	function maha_bold( $atts, $content = null ) {
		
		extract(shortcode_atts(
		array(
			'text' => ''
	    ), $atts));

		return '<strong>' . do_shortcode($text) . '</strong> ';
	}
	add_shortcode('bold', 'maha_bold');
}

/* --------------------------------------------------------------------------
 * [nextpage]
 ---------------------------------------------------------------------------*/
// if( !function_exists( 'maha_nextpage' )) {
// 	function maha_nextpage($atts, $content = null){
// 		return ' <!--nextpage--> ';
// 	}
// 	add_shortcode('nextpage', 'maha_nextpage');
// }


/* --------------------------------------------------------------------------
 * [clean]
 ---------------------------------------------------------------------------*/
if( !function_exists( 'maha_clean' )) {
	function maha_clean($content){   
		$block = array('row','one_half','one_third','two_thirds','one_fourth', 'three_fourths');
		foreach ($block as $value) {
			$array = array (
				'<p>['.$value => '['.$value,
				$value.']</p>' => $value.']',
				'<br />['.$value => '['.$value, 
				$value.']<br />' => $value.']'
			);
			$content = strtr($content, $array);
		}		
		return $content;
	}
	add_filter('the_content', 'maha_clean');
}

/* --------------------------------------------------------------------------
 * [widget_text]
 ---------------------------------------------------------------------------*/
add_filter( 'widget_title', 'do_shortcode');