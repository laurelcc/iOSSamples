<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Archive Page

 ---------------------------------------------------------------------------*/
global $curated; ?>

<?php get_header(); ?>

<?php if ($curated['running_text_on'] == true) { get_template_part('includes/content/running', 'text'); } ?>
<div class="mh-el page-sidebar page-archive">

	<!-- start container -->
	<div class="container">

		<div class="row">
			<!-- Page -->
			<div class="col-sm-8">

				<!-- Module 1 -->
				<div class="main-content" role="main" itemprop="mainContentOfPage">
					
					<!-- Breadcrumbs -->
					<?php
					$maha_breadcrumbs = true;
					if ( function_exists('yoast_breadcrumb') ) {
						$yoast_crumb = yoast_breadcrumb('<div class="maha-crumbs">','</div>', false);
						if ( isset( $yoast_crumb ) && !empty( $yoast_crumb ) ) {
							echo $yoast_crumb;
							$maha_breadcrumbs = false;
						}
					}
					
					if (function_exists('maha_crumbs') && $maha_breadcrumbs == true) { maha_crumbs(); } ?>

					<?php $curtaxmeta = ''; ?>
					
					<div id="head-content">
						<h1 itemprop="name" class="entry-title">
							<?php if ( is_tag() ) {
								single_tag_title();
								$curtaxmeta = get_query_var('tag_id');

							} elseif ( is_day() ) {
								the_time('F jS, Y');

							} elseif ( is_month() ) {
								the_time('F, Y');

							} elseif ( is_year() ) {
								the_time('Y');

							} elseif ( get_post_format() ) {
								echo get_post_format();

							} ?>
						</h1>

						<?php if( !empty( $curtaxmeta ) ) : ?>
							<div class="entry-subtitle"><?php echo tag_description( $curtaxmeta ); ?></div>
						<?php endif; ?>
					</div>

					<div class="row block-streams el-<?php echo $curated['archive_module']; ?>">

						<?php if (have_posts()) :

							$i_summary = false;
							if ( $curated['archive_module'] === 'module-1' ) {
								$item_class = 'col-sm-12';
								$item = 'full-width';
							} elseif ( $curated['archive_module'] === 'module-2' ) {
								$i_summary = $curated['archive_summary_on'];
								$item_class = 'col-sm-6';
								$item = 'medium';
							} elseif ( $curated['archive_module'] === 'module-3' ) {
								$i_summary = $curated['author_summary_on'];
								$item_class = 'col-sm-12';
								$item = 'list';
							} elseif ( $curated['archive_module'] === 'module-4' ) {
								$item_class = 'col-sm-12';
								$item = 'full-content';
							} else {
								$i_summary = $curated['archive_summary_on'];
								$item_class = 'col-sm-6';
								$item = 'medium';
							}

							while (have_posts()) : the_post(); ?>

								<?php $post->i_summary = $i_summary; ?>
								<div class="<?php echo $item_class; ?>">
									<?php get_template_part ( 'includes/content/item', $item ); ?>
								</div>
								<?php

							endwhile;
							
						else : ?>

							<div class="col-sm-12 message">
								<?php _e( 'Sorry, no posts were found', MAHA_TEXT_DOMAIN ); ?>
							</div>

						<?php endif; ?>

					</div>

					<?php maha_pagination(); ?>
					
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