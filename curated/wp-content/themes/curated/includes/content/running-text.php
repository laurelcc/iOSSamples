<?php
global $curated;

$filter = $curated['running_text_filter'];
$number_post = $curated['running_text_number_post'];

$tag = array();
if ( isset( $curated['running_text_tag_filter'] ) && is_array( $curated['running_text_tag_filter'] ) ) {
	$tag = $curated['running_text_tag_filter'];
}

$cat = array();
if ( isset( $curated['running_text_cat_filter'] ) && is_array( $curated['running_text_cat_filter'] ) ) {
	$cats = $curated['running_text_cat_filter'];
	foreach ($cats as $key => $value) {
		if ( $value == true ) {
			$cat[] = $key;
		}
	}
}


if ($filter == 'latest') {

	$wp_query = new WP_Query(
		array(
			'post_type' => 'post',
			'posts_per_page' => $number_post,
			'category__and' => $cat,
			'tag__and' => $tag,
			'no_found_rows' => true,
			'post_status' => 'publish',
			'order' => 'DESC'
		)
	);

} elseif ($filter == 'featured') {

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

} elseif ($filter == 'random') {

	$wp_query = new WP_Query(
		array(
			'post_type' => 'post',
			'posts_per_page' => $number_post,
			'category__and' => $cat,
			'tag__and' => $tag,
			'no_found_rows' => true,
			'post_status' => 'publish',
			'orderby' => 'rand'
		)
	);

} elseif ($filter == 'popular_all') {

	$wp_query = new WP_Query(
		array(
			'post_type' => 'post',
			'posts_per_page' => $number_post,
			'category__and' => $cat,
			'tag__and' => $tag,
			'no_found_rows' => true,
			'post_status' => 'publish',
			'meta_key' => 'post_views_count',
			'orderby' => 'meta_value_num',
			'order' => 'DESC'
		)
	);

} elseif ($filter == 'popular_month') {

	$month = date('m');
	$year = date('Y');
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
			'meta_key' => 'post_views_count',
			'orderby' => 'meta_value_num',
			'order' => 'DESC'
		)
	);

} elseif ($filter == 'popular_week') {

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
			'meta_key' => 'post_views_count',
			'orderby' => 'meta_value_num',
			'order' => 'DESC'
		)
	);

} elseif ($filter == 'top_all') {

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
					'key' => 'enable_review',
					'value' => 1
				)
			),
			'meta_key' => 'score_module',
			'orderby' => 'meta_value_num',
			'order' => 'DESC'
		)
	);

} elseif ($filter == 'top_month') {

	$month = date('m');
	$year = date('Y');
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
					'key' => 'enable_review',
					'value' => 1
				)
			),
			'meta_key' => 'score_module',
			'orderby' => 'meta_value_num',
			'order' => 'DESC'
		)
	);

} elseif ($filter == 'top_week') {

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
					'key' => 'enable_review',
					'value' => 1
				)
			),
			'meta_key' => 'score_module',
			'orderby' => 'meta_value_num',
			'order' => 'DESC'
		)
	);

} ?>

<div class="container">
	<div class="row">
		<?php if ( $wp_query->have_posts() && $wp_query->post_count >= 5 ) : ?>

		<div class="col-sm-12 mh-run">
			<div class="cur-runtext" id="runtext">
				<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
					<div class="thumb-runtext">
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
							<?php
							if ( has_post_thumbnail() ) : // Set Featured Image
								$thumb = maha_featured_url( get_the_ID() , 'mh_widget');
							else :
								$thumb = maha_no_thumbnail('mh_widget');
							endif; ?>
							<img width="70" height="44" src="<?php echo $thumb; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
							
							<?php the_title(); ?>
						</a>
					</div>
				<?php endwhile; ?>
			</div>
		</div>

		<?php else : ?>

		<div class="col-sm-12">
			<?php _e("Minimum number of posts is 5 for running text.", MAHA_TEXT_DOMAIN); ?>
		</div>

		<?php endif; ?>
	</div>
</div>
<?php wp_reset_query(); ?>