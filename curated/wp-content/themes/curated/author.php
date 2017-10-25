<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Single Author

 ---------------------------------------------------------------------------*/

global $curated; ?>

<?php get_header(); ?>

<?php if ($curated['running_text_on'] == true) { get_template_part('includes/content/running', 'text'); } ?>
<div class="mh-el page-sidebar page-author">

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
					

					<?php $curauth = ( isset( $_GET['author_name'] ) ) ? get_user_by( 'slug', $author_name ) : get_userdata( intval( $author ) ); ?>

					<div class="meta-author">
						<div class="author-thumb">
							<?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta( 'user_email' ), '200' ); } ?>
						</div>

						<div class="author-info">
							<h3 class="author-name">
								<a itemprop="author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo $curauth->display_name; ?></a>
							</h3>
							<div class="author-desc">
								<span class="fn"><?php echo $curauth->user_description; ?></span>
							</div>
							<ul class="author-links">
								<?php maha_user_social_network($curauth); ?>
							</ul>
						</div>

					</div>

					<div class="author-posts"><h1><?php _e("Posts by $curauth->display_name", MAHA_TEXT_DOMAIN); ?></h1></div>

					<div class="row block-streams el-<?php echo $curated['author_module']; ?>">

						<?php if (have_posts()) :

							$i_summary = false;
							if ( $curated['author_module'] === 'module-1' ) {
								$item_class = 'col-sm-12';
								$item = 'full-width';
							} elseif ( $curated['author_module'] === 'module-2' ) {
								$i_summary = $curated['author_summary_on'];
								$item_class = 'col-sm-6';
								$item = 'medium';
							} elseif ( $curated['author_module'] === 'module-3' ) {
								$i_summary = $curated['author_summary_on'];
								$item_class = 'col-sm-12';
								$item = 'list';
							} elseif ( $curated['author_module'] === 'module-4' ) {
								$item_class = 'col-sm-12';
								$item = 'full-content';
							} else {
								$i_summary = $curated['author_summary_on'];
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
							?>

						<?php
						else :

							echo '<div class="col-sm-12 message">';
							_e( 'Sorry, no posts were found', MAHA_TEXT_DOMAIN );
							echo '</div>';

						endif;
						?>

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