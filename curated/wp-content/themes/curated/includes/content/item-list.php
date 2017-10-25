<?php global $curated; ?>
<div class="item-list post-box-oblog" itemscope itemtype="http://schema.org/Article">

	<div class="thumb-wrap short-bottom zoom-zoom">
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
		<?php if ( maha_meta_review( get_the_ID() ) != '' ) : ?>
			<span class="i-review"><?php echo maha_meta_review( get_the_ID() ); ?></span>
		<?php endif; ?>

   		<?php $thumb_class = 'entry-thumb';
		if ( has_post_thumbnail() ) : // Set Featured Image
			$thumb = maha_featured_url( get_the_ID() , 'mh_list');
			$thumb_class .= ' zoom-it three';
		else :
			$thumb = maha_no_thumbnail('mh_list');
		endif; ?>
		<!-- <img width="258" height="169" class="<?php echo $thumb_class; ?>" itemprop="image" src="<?php echo $thumb; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/> -->
		<img width="260" height="198" class="<?php echo $thumb_class; ?>" itemprop="image" src="<?php echo $thumb; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
   		</a>
	</div>

	<div class="meta-info">
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
	<h3 itemprop="name" itemprop="headline" class="entry-title">
		<a itemprop="url" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
			<?php the_title(); ?>
		</a>
	</h3>
	<meta itemprop="headline" content="<?php the_title(); ?>" />

	<?php $i_summary = true; if (isset($post->i_summary)) { $i_summary = $post->i_summary; }
	if ( $i_summary == true ) : ?>
	<div itemprop="description" class="i-summary">
		<?php the_excerpt(); ?>
	</div>
	<?php endif; ?>

	<div class="meta-count">
		<?php if ( isset( $curated['module_meta']['category'] ) && $curated['module_meta']['category'] != false ) : ?>
			<span class="i-category"><?php maha_post_category( get_the_ID() ); ?></span>
		<?php endif; ?>
		
		<div class="count-data">
			<?php if ( isset( $curated['module_meta']['view'] ) && $curated['module_meta']['view'] != false ) : ?>
				<span class="meta-info-viewer"><?php echo maha_get_viwr( $post->ID ); ?><i class="tm-view"></i></span>
			<?php endif; ?>

			<?php if ( isset( $curated['module_meta']['comment'] ) && $curated['module_meta']['comment'] != false ) : ?>
				<span class="meta-info-comments"><a href="<?php the_permalink(); ?>"><?php comments_number('0', '1', '%'); ?></a><i class="tm-comment"></i></span>
			<?php endif; ?>
		</div>
	</div>
</div>