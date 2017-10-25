<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Default Page

 ---------------------------------------------------------------------------*/
global $post, $curated; ?>

<?php get_header(); ?>

<?php if ($curated['running_text_on'] == true) { get_template_part('includes/content/running', 'text'); } ?>
<div class="mh-el page-sidebar page-index">

	<!-- start container -->
	<div class="container">

		<div class="row">
			<!-- Page -->
			<div class="col-sm-8">

				<div class="main-content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
					
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
					
					<?php if ( have_posts() ) :

						$cat_module = 'el-block-3';
						if ( $curated['homepage_module'] != '' ) {
							$cat_module = 'el-'.$curated['homepage_module'];
						}

						$i_summary = true;
						if ( $curated['homepage_module'] === 'module-1' ) {
							$item_class = 'col-sm-12';
							$item = 'full-width';
						} elseif ( $curated['homepage_module'] === 'module-2' ) {
							// $i_summary = $curated['homepage_summary_on'];
							$item_class = 'col-sm-6';
							$item = 'medium';
						} elseif ( $curated['homepage_module'] === 'module-3' ) {
							$item_class = 'col-sm-12';
							$item = 'list';
						} elseif ( $curated['homepage_module'] === 'module-4' ) {
							$item_class = 'col-sm-12';
							$item = 'full-content';
						} else {
							// $i_summary = $curated['homepage_summary_on'];
							$item_class = 'col-sm-6';
							$item = 'medium';
						}

						?>

						<div class="row block-streams <?php echo $cat_module; ?>">
						<?php while ( have_posts() ) : the_post(); ?>

							<?php $post->i_summary = $i_summary; ?>
							<div class="<?php echo $item_class; ?>">
								<?php get_template_part ( 'includes/content/item', $item ); ?>
							</div>

						<?php endwhile; ?>
						</div>

						<?php maha_pagination(); ?>

					<?php else :

						echo '<div class="col-sm-12 message">';
						_e( 'Sorry, no posts were found', MAHA_TEXT_DOMAIN );
						echo '</div>';

					endif; ?>

				</div>

			</div>

			<!-- Sidebar -->
			<div class="col-sm-4">
				<?php get_sidebar(); ?>
			</div>
			
		</div>
	</div>

</div>


<?php get_footer(); ?>