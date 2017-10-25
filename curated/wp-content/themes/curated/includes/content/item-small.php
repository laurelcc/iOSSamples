<div class="item-small post-box-small clearfix" itemscope itemtype="http://schema.org/Article">

   	<div class="thumb-wrap zoom-zoom">
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
			<?php $thumb_class = 'entry-thumb';
			if ( has_post_thumbnail() ) : // Set Featured Image
				$thumb = maha_featured_url( get_the_ID() , 'mh_small');
				$thumb_class .= ' zoom-it three';
			else :
				$thumb = maha_no_thumbnail('mh_small');
			endif; ?>
			<img width="100" height="72" itemprop="image" class="<?php echo $thumb_class; ?>" src="<?php echo $thumb; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
		</a>
	</div>

	<div class="box-small-wrap">
		<h3 itemprop="name" class="entry-title short-bottom">
			<a itemprop="url" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
				<?php the_title(); ?>
			</a>
		</h3>
		<meta itemprop="headline" content="<?php the_title(); ?>" />
		<div class="meta-info">
			<time itemprop="datePublished" class="entry-date" datetime="<?php the_time( 'c' ); ?>" >
				<?php the_time( get_option( 'date_format' ) ); ?>
			</time>
		</div>
	</div>
</div>