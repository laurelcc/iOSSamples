<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Featured Posts

 ---------------------------------------------------------------------------*/

global $curated;
$maha_el_key = maha_el_key();
$maha_options = get_option('curated');

$filter = $maha_options['top_sticky_filter'];
$number_post = $maha_options['top_sticky_number_post'];

$tag = array();
if ( isset( $curated['top_sticky_tag_filter'] ) && is_array( $curated['top_sticky_tag_filter'] ) ) {
	$tag = $curated['top_sticky_tag_filter'];
}

$cat = array();
if ( isset( $curated['top_sticky_cat_filter'] ) && is_array( $curated['top_sticky_cat_filter'] ) ) {
	$cats = $curated['top_sticky_cat_filter'];
	foreach ($cats as $key => $value) {
		if ( $value == true ) {
			$cat[] = $key;
		}
	}
}



if ( $filter == 'latest' ) {

	$wp_query = new WP_Query(
		array(
			'post_type' => 'post',
			'posts_per_page' => $number_post,
			'category__and' => $cat,
			'tag__and' => $tag,
			'no_found_rows' => true,
			'post_status' => 'publish',
			'meta_key' => 'top_featured_post',
			'meta_value' => 1,
			'order' => 'DESC'
		)
	);

} elseif ( $filter == 'featured' ) {

	$wp_query = new WP_Query(
		array(
			'post_type' => 'post',
			'posts_per_page' => $number_post,
			'category__and' => $cat,
			'tag__and' => $tag,
			'no_found_rows' => true,
			'post_status' => 'publish',
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'top_featured_post',
					'value' => 1
				)
			),
			'meta_key' => 'featured_post',
			'meta_value' => '1',
			'order' => 'DESC'
			)
	);

} elseif ( $filter == 'random' ) {

	$wp_query = new WP_Query(
		array(
			'post_type' => 'post',
			'posts_per_page' => $number_post,
			'category__and' => $cat,
			'tag__and' => $tag,
			'no_found_rows' => true,
			'post_status' => 'publish',
			'meta_key' => 'top_featured_post',
			'meta_value' => 1,
			'orderby' => 'rand'
		)
	);

} elseif ( $filter == 'popular_all' ) {

	$wp_query = new WP_Query(
		array(
			'post_type' => 'post',
			'posts_per_page' => $number_post,
			'category__and' => $cat,
			'tag__and' => $tag,
			'no_found_rows' => true,
			'post_status' => 'publish',
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'top_featured_post',
					'value' => 1
				)
			),
			'meta_key' => 'post_views_count',
			'orderby' => 'meta_value_num',
			'order' => 'DESC'
		)
	);

} elseif ( $filter == 'popular_month' ) {

	$month = date('m', strtotime('-30 days'));
	$year = date('Y', strtotime('-30 days'));
	$wp_query = new WP_Query(
		array(
			'post_type' => 'post',
			'posts_per_page' => $number_post,
			'category__and' => $cat,
			'tag__and' => $tag,
			'year' => $year,
			'monthnum' => $month,
			'no_found_rows' => true,
			'post_status' => 'publish',
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'top_featured_post',
					'value' => 1
				)
			),
			'meta_key' => 'post_views_count',
			'orderby' => 'meta_value_num',
			'order' => 'DESC'
		)
	);

} elseif ( $filter == 'popular_week' ) {

	$week = date('W');
	$year = date('Y');
	$wp_query = new WP_Query(
		array(
			'post_type' => 'post',
			'posts_per_page' => $number_post,
			'category__and' => $cat,
			'tag__and' => $tag,
			'year' => $year,
			'w' => $week,
			'no_found_rows' => true,
			'post_status' => 'publish',
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'top_featured_post',
					'value' => 1
				)
			),
			'meta_key' => 'post_views_count',
			'orderby' => 'meta_value_num',
			'order' => 'DESC'
		)
	);

} elseif ( $filter == 'top_all' ) {

	$wp_query = new WP_Query(
		array(
		'post_type' => 'post',
		'posts_per_page' => $number_post,
		'category__and' => $cat,
		'tag__and' => $tag,
		'no_found_rows' => true,
		'post_status' => 'publish',
		'meta_query' => array(
		'relation' => 'AND',
		array(
		'key' => 'top_featured_post',
		'value' => 1
		),
		array(
		'key' => 'enable_review',
		'value' => 1
		)
		),
		'meta_key' => 'score_module',
		'orderby' => 'meta_value_num',
		'order' => 'DESC'
		)
	);

} elseif ( $filter == 'top_month' ) {

	$month = date('m', strtotime('-30 days'));
	$year = date('Y', strtotime('-30 days'));
	$wp_query = new WP_Query(
		array(
			'post_type' => 'post',
			'posts_per_page' => $number_post,
			'category__and' => $cat,
			'tag__and' => $tag,
			'year' => $year,
			'monthnum' => $month,
			'no_found_rows' => true,
			'post_status' => 'publish',
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'top_featured_post',
					'value' => 1
				),
				array(
					'key' => 'enable_review',
					'value' => 1
				)
			),
			'meta_key' => 'score_module',
			'orderby' => 'meta_value_num',
			'order' => 'DESC'
		)
	);

} elseif ( $filter == 'top_week' ) {

	$week = date('W');
	$year = date('Y');
	$wp_query = new WP_Query( 
		array(
			'post_type' => 'post',
			'posts_per_page' => $number_post,
			'category__and' => $cat,
			'tag__and' => $tag,
			'year' => $year,
			'w' => $week,
			'no_found_rows' => true,
			'post_status' => 'publish',
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'top_featured_post',
					'value' => 1
				),
				array(
					'key' => 'enable_review',
					'value' => 1
				)
			),
			'meta_key' => 'score_module',
			'orderby' => 'meta_value_num',
			'order' => 'DESC'
		)
	);

}

?>

<div class="container late-show featured-extra">

	<div class="row block-streams el-block-5 single-featured-posts">

		<?php if ( $wp_query->have_posts() && $wp_query->post_count >= 4 ) : ?>

			<div id="<?php echo $maha_el_key; ?>" class="featured-slider blocked-carousel">
				<div class="carousel-wrapper">

					<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

					<div class="col-sm-3">
						<?php get_template_part ( 'includes/content/item', 'medium-simple' ); ?>
					</div>

					<?php endwhile; ?>

				</div>
				<div class="carousel-prev"><i class="tm-chevron-left"></i></div>
				<div class="carousel-next"><i class="tm-chevron-right"></i></div>
			</div>

		<?php else :

			echo '<div class="col-sm-12 message">';
			_e( 'Minimum number of featured posts is 4.', MAHA_TEXT_DOMAIN );
			echo '</div>';

		endif; ?>

		<?php wp_reset_query(); ?>

	</div>

</div>