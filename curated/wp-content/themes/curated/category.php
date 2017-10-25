<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Category Page

 ---------------------------------------------------------------------------*/

global $curated;
$page_column = "8";
?>

<?php get_header(); ?>

<?php if ($curated['running_text_on'] == true) { get_template_part('includes/content/running', 'text'); } ?>
<div class="mh-el page-sidebar page-category">

	<!-- start container -->
	<div class="container">

		<div class="row">
			<!-- Page -->
			<div class="col-sm-<?php echo $page_column; ?>">

				<!-- Module 1 -->
				<div class="main-content" role="main" itemprop="mainContentOfPage">
					
					<!-- Breadcrumbs -->
					<?php
					$maha_breadcrumbs = 1;
					if ( function_exists('yoast_breadcrumb') ) {
						$yoast_crumb = yoast_breadcrumb('<div class="maha-crumbs">','</div>', false);
						if ( isset( $yoast_crumb ) && !empty( $yoast_crumb ) ) {
							echo $yoast_crumb;
							$maha_breadcrumbs = 0;
						}
					}
					
					if (function_exists('maha_crumbs') && $maha_breadcrumbs === 1) { maha_crumbs(); } ?>
					
					<?php $curcat = get_query_var('cat'); ?>

					<div id="<?php echo $curcat.'-'; single_cat_title(); ?>" class="clearfix">
						<h1 class="entry-title"><?php single_cat_title(); ?></h1>
						<div class="entry-subtitle">
							<?php echo category_description( $curcat ); ?>
						</div>
					</div>

					<?php
					// If Module use Featured Slider ++++++++++++++++++++++++++
					if( get_field( 'category_slider', 'category_' . $curcat ) == 'category_slider_on' ){
						echo '<div class="el-featured-slide up-up">';
							get_template_part ( 'includes/content/blocked', 'slider' );
						echo '</div>';
					}
					?>

					<?php
					$cat_module = 'module-2';
					if ( get_field( 'category_module', 'category_' . $curcat ) != '' ) {
						$cat_module = get_field( 'category_module', 'category_' . $curcat );
					}
					?>
					<div class="row block-streams el-<?php echo $cat_module; ?>">

						<?php if (have_posts()) :

							$i_summary = false;
							if ( $cat_module === 'module-1' ) {
								$item_class = 'up-up-child col-sm-12';
								$item = 'full-width';
							} elseif ( $cat_module === 'module-2' ) {
								$i_summary = $curated['category_summary_on'];
								$item_class = 'up-up-child col-sm-6';
								$item = 'medium';
							} elseif ( $cat_module === 'module-3' ) {
								$item_class = 'up-up-child col-sm-12';
								$item = 'list';
							} elseif ( $cat_module === 'module-4' ) {
								$item_class = 'up-up-child col-sm-12';
								$item = 'full-content';
							} else {
								$i_summary = $curated['category_summary_on'];
								$item_class = 'col-sm-6';
								$item = 'medium';
							}

							while (have_posts()) : the_post(); ?>

								<?php $post->i_summary = $i_summary; ?>
								<div class="<?php echo $item_class; ?>">
									<?php get_template_part ( 'includes/content/item', $item ); ?>
								</div>
								<?php

							endwhile; ?>

						<?php else :

							echo '<div class="col-sm-12 message">';
							_e( 'Sorry, no posts were found', MAHA_TEXT_DOMAIN );
							echo '</div>';

						endif; ?>

					</div>
					
					<?php maha_pagination(); ?>

					<?php wp_reset_query(); ?>

				</div>

			</div>

			<?php
				// If This Page Use Sidebar
				if ( empty( $curated['category_sidebar_select'] ) ) $sidebar='blog-sidebar';
				else $sidebar = $curated['category_sidebar_select'];

				echo '<div class="col-sm-4"><div class="sidebar">'; dynamic_sidebar($sidebar); 
				echo '</div></div>';
			?>
		</div>
	</div>

</div>


<?php get_footer(); ?>