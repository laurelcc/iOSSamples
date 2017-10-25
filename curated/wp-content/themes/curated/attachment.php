<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Attachment Page

 ---------------------------------------------------------------------------*/
global $curated; ?>

<?php get_header(); ?>

<?php if ($curated['running_text_on'] == true) { get_template_part('includes/content/running', 'text'); } ?>
<div class="mh-el page-sidebar page-default page-attachment">
        
	<!-- start container -->
	<div class="container">

		<div class="row">
			<!-- Page -->
			<div class="col-sm-12">

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

						<div id="head-content">
							<h1 itemprop="name" class="entry-title"><?php echo get_the_title(); ?></h1>
						</div>
						
						<div class="row">
							<div class="col-sm-12">
								<?php echo wp_get_attachment_image( get_the_ID(), 'full' ); ?>
							</div>
						</div>

					<?php endwhile; endif; ?>

				</div>

			</div>
			
		</div>
	</div>

</div>


<?php get_footer(); ?>