<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - 404

 ---------------------------------------------------------------------------*/
global $curated; ?>

<?php get_header(); ?>

<div class="mh-el page-sidebar page-404">

	<!-- start container -->
	<div class="container main-content">
		<div class="row block-streams el-module-404">

			<!-- Page -->
			<div class="col-sm-12">
				<div class="nf404">
					<div class="nf404-text">404</div>
					<div class="nf404-title"><?php echo $curated['nf404_title']; ?></div>
					<div class="nf404-desc"><p><?php echo $curated['nf404_desc']; ?></p></div>
					<div class="mh-el-search-wrap"><?php get_search_form(); ?></div>
				</div>
			</div>

		</div>
	</div>

</div>

<?php get_footer(); ?>