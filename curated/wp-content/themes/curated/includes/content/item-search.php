<div class="item-search post-box-oblog" itemscope itemtype="http://schema.org/Article">

	<?php if ( has_post_thumbnail() ) : // Meta Image ?>
		<meta itemprop="image" content="<?php echo maha_featured_url( get_the_ID() , 'mh_medium'); ?>">
	<?php elseif( maha_first_post_image() ) : ?>
		<meta itemprop="image" content="<?php echo maha_first_post_image(); ?>">
   	<?php endif; ?>

	<div class="meta-info">
		<span itemprop="author" class="entry-author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span><span class="coma">,</span> 
		<time itemprop="datePublished" class="entry-date" datetime="<?php the_time( 'c' ); ?>" >
			<?php the_time( get_option( 'date_format' ) ); ?>
		</time>
	</div>

	<h3 itemprop="name" class="entry-title">
		<a itemprop="url" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
	</h3>
	<meta itemprop="headline" content="<?php the_title(); ?>" />
	
	<div itemprop="description" class="i-summary">
		<?php the_excerpt(); ?>
	</div>

	<div class="meta-count">
		<span class="i-category"><?php maha_post_category( get_the_ID() ); ?></span>

		<div class="count-data">
			<?php //if ( $maha_options['single_viewer'] == true ) { ?>
				<span class="meta-info-viewer"><?php echo maha_get_viwr( $post->ID ); ?><i class="tm-view"></i></span>
			<?php //} ?>
			<span class="meta-info-comments"><a href="<?php the_permalink(); ?>"><?php comments_number('0', '1', '%'); ?></a><i class="tm-comment"></i></span>
		</div>
	</div>

</div>