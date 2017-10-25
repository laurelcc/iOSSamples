<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Homepage Loop

 ---------------------------------------------------------------------------*/

global $post;

if ( get_field('use_homepage', $post->ID) === 'enable' ) {

	$pagination_style = get_field('pagination_style',$post->ID);
	$block_type = get_field('home_block_type', $post->ID);

	if ( get_field('page_sidebar', $post->ID) === 'page_sidebar_off' ) { $col_sm = 4; $col_sm2=3; $item_range = 3; }
	else { $col_sm = 6;$item_range = 2; $col_sm2 = 4; }

	wp_reset_query(); ?>

	<div id="cur-page" class="mh-el">

		<?php if ( get_field('home_title',$post->ID) ) : ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="block-cap">
					<h3><?php echo do_shortcode(get_field('home_title',$post->ID)); ?></h3>
				</div>
			</div>
		</div>
		<?php endif; ?>

		<?php $paged = 1;
		if ( get_query_var('paged') ) $paged = get_query_var('paged');
		if ( get_query_var('page') ) $paged = get_query_var('page');
		$pagination = array('paged' => $paged);

		$number_of_posts_config = get_field('home_number_posts',$post->ID);
		$offset_config = 0;
		if ( get_field('home_offset',$post->ID) != 0 ) {
			$offset_config = (($paged - 1) * $number_of_posts_config) + get_field('home_offset',$post->ID);
		}

		$loop_fields = array(
			'loop_categories' => get_field('home_category',$post->ID),
			'loop_tags' => get_field('home_tags',$post->ID),
			'loop_order' => get_field('home_order',$post->ID),
			'loop_number_posts' => $number_of_posts_config,
			'loop_offset' => $offset_config
		);
		$home_summary = get_field('home_summary', $post->ID);

		$home_args = maha_loop($loop_fields) + $pagination;
		$wp_query = new WP_Query( $home_args );

		if ( $wp_query->have_posts() ) :
		echo '<div class="cur-page-item row block-streams el-'.get_field('home_block_type', $post->ID).'">';
		$post_start = 1;


		$post->i_summary = $home_summary;
		$first_row = $first = false;

		// Blocked 1 ++++++++++++++++++++
		if ( $block_type === 'block-1' ) {
			$item_class = "up-up-child col-sm-".$col_sm;
			$item = "medium";
			$first_row = true;
		}

		// Blocked 2 ++++++++++++++++++++
		if ( $block_type == 'block-2' ) {
			$item_class = "up-up-child col-sm-".$col_sm;
			$item = "medium";
		}

		// Blocked 3 ++++++++++++++++++++
		if ( $block_type == 'block-3' ) {
			$item_class = "up-up-child col-sm-12";
			$item = "list";
		}

		// Blocked 4 ++++++++++++++++++++
		if ( $block_type == 'block-4' ) {
			$item_class = "up-up-child col-sm-".$col_sm;
			$item = "medium";
			$first = true;
		}

		// Blocked 6 ++++++++++++++++++++
		if ( $block_type == 'block-6' ) {
			$item_class = "up-up-child col-sm-".$col_sm2;
			$item = "medium";
		}

		// Blocked 7 ++++++++++++++++++++
		if ( $block_type == 'block-7' ) {
			$item_class = "up-up-child col-sm-".$col_sm;
			$item = "small";
		}


		while ( $wp_query->have_posts() ) : $wp_query->the_post();
			$post->i_summary = $home_summary;

			if ( $first_row == true && $post_start > $item_range ) {
				$item = "small";
				$first_row = false;
			} ?>

			<div class="<?php echo $item_class; ?>">
				<?php get_template_part ( 'includes/content/item', $item ); ?>
			</div>

			<?php if ( $first == true ) {
				$item = "small";
				$first = false;
			} ?>


			<?php $post_start++;
		endwhile;
		echo '</div>';
		endif;
		?>

		<?php if ($pagination_style == 'infinite_scroll') {?>
		<div class="a-nav">
		<div class="a-next"><?php next_posts_link( ' ' ); ?></div>
		<div class="a-prev"><?php previous_posts_link( ' ' ); ?></div>
		</div>
		<?php }else{ ?>
		<?php maha_pagination(); } ?>
		<?php wp_reset_query(); ?>

	</div>
<?php } ?>