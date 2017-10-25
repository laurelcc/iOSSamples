<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Blocked Slider - for Category

 ---------------------------------------------------------------------------*/

$maha_el_key = maha_el_key(); 

// Setup Query
$wp_query = new WP_Query(
	array(
		'post_type' => 'post',
		'category__and' => array(get_query_var('cat')),
		'meta_key' => 'featured_post',
		'meta_value' => 1,
		'posts_per_page' => 5,
		'no_found_rows' => true,
		'orderby' => 'rand'
	)
);



// Setup Loop
if ( $wp_query->have_posts() ) : ?>

	<!-- Start Curated Slider -->
	<div id="<?php echo $maha_el_key; ?>" class="el-blocked-slide blocked-slider maha_royalSlider">

	<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
		<div class="i-slide rsContent">
			<div class="full bContainer zoom-zoom" >
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php if ( maha_meta_review( get_the_ID() ) != '' ) : ?>
					<span class="i-review"><?php echo maha_meta_review( get_the_ID() ); ?></span>
					<?php endif; ?>
					<img class="zoom-it three" typeof="foaf:Image" src="<?php echo maha_featured_url( get_the_ID() , 'mh_slide_large'); ?>" alt="<?php the_title(); ?>" />
				</a>

				<div class="detail">
					<div class="row">
						<div class="col-sm-8">
							<div class="meta-info">
								<!-- <span itemprop="author" class="entry-author"><?php the_author(); ?></span>,  -->
								<time itemprop="dateCreated" class="entry-date" datetime="<?php the_time( 'c' ); ?>" >
								<?php the_time( get_option( 'date_format' ) ); ?>
								</time>
							</div>

							<a class="a-url" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<h2><?php the_title(); ?></h2>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endwhile; ?>

	</div>

<?php else :

	echo '<div class="com-sm-12 message">';
	_e( 'Sorry, no posts were found or featured posts not more than 5.', MAHA_TEXT_DOMAIN );
	echo '</div>';

endif; ?>

<?php wp_reset_query(); ?>