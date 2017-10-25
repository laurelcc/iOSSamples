<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Search Page

 ---------------------------------------------------------------------------*/

global $curated, $paged, $wp_query;

if ( $curated['search_option'] === 'all' ) { $val_post = array('post','page'); }
else { $val_post = $curated['search_option']; }

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
if ( get_query_var('page') ) { $paged = get_query_var('page'); }

$args = array(
	'post_type' => $val_post,
	'post_status' => 'publish',
	's' => get_search_query(),
	'paged' => $paged
);

get_header(); ?>

<?php if ($curated['running_text_on'] == true) { get_template_part('includes/content/running', 'text'); } ?>
<div class="mh-el page-sidebar page-search">

	<!-- start container -->
	<div class="container">

		<div class="row">
			<!-- Page -->
			<div class="col-sm-8">

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
					
					<div class="mh-template-h-wrap">
						<h1 itemprop="name" class="entry-title">
							<?php _e( 'Search results for', MAHA_TEXT_DOMAIN ); ?> "<?php echo get_search_query(); ?>"
						</h1>
						<div class="mh-el-search-wrap">
							<?php get_search_form(); ?>
						</div>
					</div>

					<div class="row block-streams el-module-search">

						<?php $wp_query = new WP_Query( $args );

						if ($wp_query->have_posts()) : ?>

							<?php while ($wp_query->have_posts()) : $wp_query->the_post();

								// Module Loop ++++++++++++++++++++++++++ ?>
								<div class="col-sm-12">
									<?php get_template_part ( 'includes/content/item', 'search' ); ?>
								</div>

							<?php endwhile; ?>

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

			<!-- Sidebar -->
			<?php
			if ( empty( $curated['category_sidebar_select'] ) ) $sidebar='blog-sidebar';
			else $sidebar = $curated['category_sidebar_select'];

			echo '<div class="col-sm-4"><div class="sidebar">'; dynamic_sidebar($sidebar); 
			echo '</div></div>';
			?>
		</div>
	</div>

</div>

<?php get_footer(); ?>