<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Default Page

 ---------------------------------------------------------------------------*/
global $post, $curated;

$page_column = "12"; if (get_field('page_sidebar', $post->ID) == 'page_sidebar_on') { $page_column = "8"; }
?>
<?php get_header(); ?>
<?php if ($curated['running_text_on'] == true) { get_template_part('includes/content/running', 'text'); } ?>
<div class="mh-el page-sidebar page-default">
        
	<!-- start container -->
	<div class="container">

		<div class="row">
			<!-- Page -->
			<div class="col-sm-<?php echo $page_column; ?>">

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
					
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<article id="post-<?php echo $post->ID; ?>" class="main-content single-post-box" itemscope="" itemtype="http://schema.org/Article">
							<header><?php $page_title_on = true; if (get_field('page_title', $post->ID) != 'page_title_on') { $page_title_on = false; } if ( $page_title_on == true) { ?><h1 itemprop="name" class="entry-title"><?php the_title(); ?></h1> <?php } ?></header>

							<div class="text-content">
								<?php the_content(); ?>
							</div>

						</article>

					<?php endwhile; endif; ?>

				</div>

				<?php
				if (get_field('use_homepage', $post->ID) == 'enable'){ get_template_part ( 'includes/composer/homepage'); }
				?>

			</div>

			<?php
			// Sidebar Collumn
			if ( get_field( 'page_sidebar', $post->ID ) == 'page_sidebar_on' ){

				$affix_class = '';
				if ( isset( $curated['page_affix'] ) && $curated['page_affix'] == true ) {
					$affix_class = 'affix_sidebar';
				}

				echo '<!-- Sidebar --><div class="col-sm-4 '. $affix_class .'">';get_sidebar();echo '</div>';
			}
			?>
			
		</div>
	</div>

</div>


<?php get_footer(); ?>