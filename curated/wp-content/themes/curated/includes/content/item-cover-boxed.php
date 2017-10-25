<?php global $post, $curated; $maha_options = get_option('curated');// echo $post->ID; // print_r($post); ?>
<?php if ( has_post_thumbnail( $post->ID ) ) { ?>

<div class="row">
	<!-- Page -->
	<div class="col-sm-12">
		<div class="cover-wrap">

			<div class="player-wrap"><div class="row">				
				<div class="col-sm-12">
					<div class="back-nav">
						<i class="tm-cancel"></i>
					</div>
				</div></div></div>

			<div class="cover" style="background-image: url(<?php echo maha_featured_url( $post->ID , 'mh_cover_boxed'); ?>);">
				
				<!-- <img class="entry-thumb" src="<?php echo maha_featured_url( $post->ID , 'mh_large'); ?>" alt="<?php echo get_the_title($post->ID); ?>" title="<?php echo get_the_title($post->ID); ?>"> -->

				<?php maha_format_gallery( $post->ID ); ?>

				<div class="detail">

					<div class="row">
						<?php
						if ( get_field('enable_review', $post->ID ) == '1' ) { 
							$itemscope =' itemscope itemtype="http://schema.org/Review"';
						} else {
							$itemscope =' itemscope itemtype="http://schema.org/Blog"';
						}
						?>

						<div class="col-sm-8" <?php echo $itemscope; ?>>

							<?php if ( get_field('enable_review', $post->ID ) == '1' ) { ?>
							<meta itemprop="itemreviewed" content="<?php echo get_the_title($post->ID); ?>">
							<?php } ?>

							<!-- <meta itemprop="author" content="<?php echo get_the_author_meta('display_name', $post->post_author); ?>"> -->
							<meta itemprop="datecreated" content="<?php echo get_the_time( 'c', $post->ID ); ?>">
							<meta itemprop="image" content="<?php echo maha_featured_url( $post->ID , 'mh_cover_boxed'); ?>">
							<meta itemprop="about" content="<?php echo get_field('review_info'); ?>">

							<?php $user = get_user_by( 'email', get_the_author_meta( 'email' ) );
							if ( isset( $user->u_google_plus ) && !empty( $user->u_google_plus ) ) { ?>
								<a href="<?php echo $user->u_google_plus."?rel=author"; ?>" style="display:none;"></a>
							<?php } ?>

							<div class="meta-count">
								<span class="i-category"><?php maha_post_category( $post->ID ); ?></span>
							</div>

							<h1 itemprop="name"><?php echo get_the_title($post->ID); ?></h1>
							<?php
							if ( get_field('subtitle', $post->ID) != '' ){
								echo '<div class="entry-subtitle single-subtitle">'.get_field('subtitle', $post->ID).'</div>';
							}
							?>

							<div class="hidden" itemscope itemtype="http://schema.org/Thing">
								<span itemprop="name"><?php echo get_the_title($post->ID); ?></span>
							</div>

							<div class="meta-info">
								<span itemprop="author" itemscope itemtype="http://schema.org/Person" class="entry-author">
									<a href="<?php echo get_author_posts_url( $post->post_author ); ?>"><?php echo get_the_author_meta('display_name', $post->post_author); ?></span></a>,
								</span>
								<time itemprop="datePublished" class="entry-date" datetime="<?php echo get_the_time( 'c', $post->ID ); ?>" >
									<?php echo get_the_time( get_option( 'date_format' ), $post->ID ); ?>
								</time>
								
								<div class="count-data">
									<?php if ( isset( $curated['single_meta_count']['view'] ) && $curated['single_meta_count']['view'] == true ) : ?>
										<span class="meta-info-viewer"><?php echo maha_get_viwr( $post->ID ); ?><i class="tm-view"></i></span>
									<?php endif; ?>

									<?php if ( isset( $curated['single_meta_count']['comment'] ) && $curated['single_meta_count']['comment'] == true ) : ?>
										<span class="meta-info-comments"><a href="<?php the_permalink(); ?>"><?php comments_number('0', '1', '%'); ?></a><i class="tm-comment"></i></span>
									<?php endif; ?>
								</div>
							</div>

						</div>
						
					</div>

				</div>
				
			</div>

			<?php maha_format_video( $post->ID ); ?>

		</div>
	</div>
</div>

<?php } ?>