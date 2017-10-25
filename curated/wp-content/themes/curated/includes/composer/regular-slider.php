<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Regular Slider

 ---------------------------------------------------------------------------*/

?>

<div class="mh-el blocked-slide">

	<?php
	// Start Container
	$thumb_size = "mh_cover_boxed";
	if (get_sub_field('el_area') == 1) { echo '<div class="container">'; }
	if (get_sub_field('el_area') == 2) { $thumb_size = "mh_slide_large"; }
	?>

		<?php
		// Setup Query
		$loop_fields = array(
			'loop_categories' => get_sub_field('rslide_category'),
			'loop_tags' => get_sub_field('rslide_tags'),
			'loop_order' => get_sub_field('rslide_order'),
			'loop_number_posts' => get_sub_field('rslide_number_posts'),
			'loop_offset' => get_sub_field('rslide_offset')
		);

		$blocked_args = maha_loop($loop_fields);
		$wp_query = new WP_Query( $blocked_args );
		

		// Setup Loop
		if ( $wp_query->have_posts() ) : ?>
			<!-- Start Curated Slider -->
			<div class="el-blocked-slide regular-slider maha_royalSlider up-up">

				<?php while ( $wp_query->have_posts() ) : $wp_query->the_post();

				$thumb_class = '';
				if ( has_post_thumbnail() ) : // Set Featured Image
					$thumb = maha_featured_url( get_the_ID() , $thumb_size);
					$thumb_class .= 'zoom-it three';
				else :
					$thumb = maha_no_thumbnail( $thumb_size );
				endif; ?>

				<div class="i-slide rsContent">
					<?php if ( maha_meta_review( get_the_ID() ) != '' ) { ?>
						<span class="i-review"><?php echo maha_meta_review( get_the_ID() ); ?></span>
					<?php } ?>
					<div class="full bContainer zoom-zoom" itemscope itemtype="http://schema.org/Article">
						<div class="reg-item-cover zoom-it three" style="background-image: url(<?php echo $thumb; ?>)">
							<a class="a-url" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<!-- <img class="<?php echo $thumb_class; ?>" itemprop="image" src="<?php echo $thumb; ?>" alt="<?php the_title(); ?>" /> -->
							</a>
						</div>
						<div class="detail">
							<!-- <div class="row"> -->
								<!-- <div class="col-sm-8"> -->
									<div class="meta-info">
										<!-- <span itemprop="author" class="entry-author"><?php the_author(); ?></span>,  -->
										<time itemprop="datePublished" class="entry-date" datetime="<?php the_time( 'c' ); ?>" >
											<?php the_time( get_option( 'date_format' ) ); ?>
										</time>
									</div>
									<a class="a-url" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<h2 itemprop="name"><?php the_title(); ?></h2>
									</a>
									<!-- <meta itemprop="headline" content="<?php the_title(); ?>" /> -->
								<!-- </div> -->
								<!-- <div class="col-sm-4"> -->
									<!-- Hello -->
								<!-- </div> -->
							<!-- </div> -->
						</div>
					</div>
				</div>

			<?php endwhile; ?>

			</div>

			<?php

		else :

			echo '<div class="com-sm-12 message">';
			_e( 'Sorry, no posts were found', MAHA_TEXT_DOMAIN );
			echo '</div>';
		endif;
		?>

		<?php wp_reset_query(); ?>

	<?php
	// End of container
	if (get_sub_field('el_area') == 1) { echo '</div>'; }
	?>
	
</div>