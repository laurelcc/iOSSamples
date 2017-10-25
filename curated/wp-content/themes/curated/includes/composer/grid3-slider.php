<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2016

    - Grid3 Slider

 ---------------------------------------------------------------------------*/

$maha_el_key = maha_el_key(); ?>

<div class="mh-el grid3-slide">

	<?php
	// Start Container
	if (get_sub_field('el_area') == 1) { echo '<div class="container">'; }
	?>

		<?php
		// Init Element Options
		$number_of_posts = get_sub_field( 'grid3_of_slides' );
		$grid3_boxed = get_sub_field( 'grid3_boxed' );
		$grid3_boxed_class = ''; if ($grid3_boxed == true) {$grid3_boxed_class = 'grid3-boxed'; }

		// Count All Pusblished Posts
		$all_posts = wp_count_posts()->publish;

		// Minimum Posts number
		if ( $all_posts > 6 ) {
			
			// Set Initial Number of posts
			if ( $all_posts < $number_of_posts ) { $number_of_posts = $all_posts; }

			// Generate Layout
			$grid3_layout = maha_curated_grid3_model( $number_of_posts );
			$grid3_model = $grid3_layout['slide_model'];
			$grid3_style = $grid3_layout['slide_style'];

			?>
			<div id="<?php echo $maha_el_key; ?>" class="wrap-grid3-slide maha_royalSlider <?php echo $grid3_boxed_class; ?> up-up">
				<?php
				
				// Loop by Model
				$offset = 0;
				// foreach ($grid3_model as $key_model => $v_model) {
					// $v_model = 12;
					// Query Loop
					$loop_fields = array(
						'loop_categories' => get_sub_field('grid3_category'),
						'loop_tags' => get_sub_field('grid3_tags'),
						'loop_order' => get_sub_field('grid3_order'),
						'loop_number_posts' => $number_of_posts
					);
					$loop_offset = array('offset' => $offset);
					$loop_orderby = array('orderby' => 'post_date');

					$grid3_args = maha_loop($loop_fields) + $loop_offset + $loop_orderby;
					$wp_query = new WP_Query( $grid3_args );

					if ( $wp_query->have_posts() ) :
						// Start Loop
						$grid3 = 0;
						$grid3_small = 0;
						$grid3_item = array('big','small','small');
						while ( $wp_query->have_posts() ) : $wp_query->the_post();

							// Start slide
							if ( $grid3 == 0 ) { echo '<div class="i-slide rsContent"><div class="bContainer">'; }

								// Start grid3 Item
								$grid3_class = $grid3_item[$grid3];

								if ( $grid3_class == 'small' && $grid3_small == 0 ) {
									echo '<div class="grid3-wrap small2">';
								}
								if ( $grid3_class == 'small' && $grid3_small <= 2 ) {
									$grid3_small++;
								}

								echo '<div class="grid3-item '.$grid3_class.'" data-url="'.get_permalink().'">';

									?>
									<div class="wrap-grid3-item zoom-zoom">
										
										<div class="grid3-item-cover zoom-it three" style="background-image: url(<?php echo maha_featured_url( get_the_ID() , 'mh_gallery'); ?>)">
											<a class="grid3-url" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
												<!-- <h2><?php the_title(); ?></h2> -->
											</a>
										</div>

										<div class="detail">
											<div class="meta-info">
												<time itemprop="datePublished" class="entry-date" datetime="<?php the_time( 'c' ); ?>" >
													<?php the_time( get_option( 'date_format' ) ); ?>
												</time>
											</div>
											<a class="grid3-url" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
												<h2><?php the_title(); ?></h2>
											</a>
										</div>
									</div>
									<?php

								echo '</div>';

								if ( $grid3_class == 'small' && $grid3_small == 2 ) {
									echo '</div>';
									$grid3_small=0;
								}

								// echo $grid3.' x '.$v_model;

							// End slide
							if ( $grid3 == 2 ) { echo '</div></div>'; $grid3 = 0; } else { $grid3++; }

						// $grid3++;
						endwhile;
					endif;

					wp_reset_query();

					// $offset = $v_model + $offset;
				// }

				?>

			</div>

			<?php
		    	
		} else {

			echo '<div class="com-sm-12 message">';
			_e( 'Minimum number of posts is 6 for grid3 Slider! <a href="'.admin_url("post-new.php").'">Create new post now </a>', MAHA_TEXT_DOMAIN );
			echo '</div>';
		}
		?>

	<?php
	// End of container
	if (get_sub_field('el_area') == 1) { echo '</div>'; }
	?>

</div>