<?php global $curated; ?>
<div class="item-medium-simple post-box-normal" itemscope itemtype="http://schema.org/Article">
	<div class="meta-info no-bottom">
		<?php if ( isset( $curated['module_meta']['author'] ) && $curated['module_meta']['author'] != false ) :
			echo '<span itemprop="author" class="entry-author"><a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ) .'">'. get_the_author() .'</a></span>';
		endif;

		if ( isset( $curated['module_meta']['author'] ) && $curated['module_meta']['author'] != false && isset( $curated['module_meta']['date'] ) && $curated['module_meta']['date'] != false ) :
			echo '<span class="coma">,</span>';
		endif; ?>

		<?php if ( isset( $curated['module_meta']['date'] ) && $curated['module_meta']['date'] != false ) : ?>
			<time itemprop="datePublished" class="entry-date" datetime="<?php the_time( 'c' ); ?>" >
				<?php the_time( get_option( 'date_format' ) ); ?>
			</time>
		<?php endif; ?>
	</div>

	<div class="thumb-wrap zoom-zoom">
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
			<?php if ( maha_meta_review( get_the_ID() ) != '' ) : ?>
				<span class="i-review"><?php echo maha_meta_review( get_the_ID() ); ?></span>
			<?php endif; ?>

			<?php $thumb_class = 'entry-thumb';
			if ( has_post_thumbnail() ) : // Set Featured Image
				$thumb = maha_featured_url( get_the_ID() , 'mh_medium_simple');
				$thumb_class .= ' zoom-it three';
			else :
				$thumb = maha_no_thumbnail('mh_medium_simple');
			endif; ?>
			<img width="262" height="141" itemprop="image" class="<?php echo $thumb_class; ?>" src="<?php echo $thumb; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
		</a>
	</div>

	<h3 itemprop="name" class="entry-title">
		<a itemprop="url" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
			<?php the_title(); ?>
		</a>
	</h3>
	<meta itemprop="headline" content="<?php the_title(); ?>" />
</div>