<?php global $post, $curated; maha_set_viwr($post->ID); get_header(); ?>
<?php $cover_post = 'regular'; if ( get_field( 'cover_post', $post->ID ) != '' ) { $cover_post = get_field( 'cover_post', $post->ID ); } ?>

<!-- Running Text -->
<?php if ($curated['running_text_on'] == true) {?>
    <div class="<?php if (get_field('top_featured_post', $post->ID) == '1') echo "cur-run";elseif ( $cover_post == 'parallax' ) echo 'cur-par'; else echo "cur-no"; ?>">
    <?php get_template_part('includes/content/running', 'text'); ?>
    </div>
<?php } ?>

<div class="mh-el page-sidebar single-<?php echo $cover_post; ?>">                           
	<?php
	// Featured Posts +++++++++++++++++       
        
	if ( get_field( 'top_featured_post', $post->ID ) == '1' ) {
		get_template_part ( 'includes/content/featured', 'posts' );
	}
	// Parallax Cover +++++++++++++++++
	if ( $cover_post == 'parallax' ) {
		get_template_part ( 'includes/content/item', 'cover-parallax' );
	}
	// Title Cover +++++++++++++++++
	if ( $cover_post == 'title' ) {
		get_template_part ( 'includes/content/item', 'cover-title' );
	}
	?>

	<!-- start container -->
	<div class="container">

		<?php
		// Boxed Cover +++++++++++++++++
		if ( $cover_post == 'boxed' ) {
			get_template_part ( 'includes/content/item', 'cover-boxed' );
		}
		?>

		<div class="row">
			<!-- Page -->
			<div class="col-sm-8">

				<div class="main-content">
					
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

							<?php
							// Regular Cover +++++++++++++++++
							if ( $cover_post == 'regular' ) {
								get_template_part ( 'includes/content/item', 'cover-regular' );
							}
							?>

							<?php
							if ( $cover_post == 'title' || $cover_post == 'regular' ) {
								maha_format_gallery( $post->ID );
								maha_format_video( $post->ID );
							}

							if ( get_post_format() == 'audio' ) { maha_format_audio( $post->ID ); }
							?>

							<div class="text-content">

								<?php
								// Post Rating - Defined by post author in admin post edit page
								if ( get_field('enable_review') == '1' ) {
									maha_review_filter();
								}

								// Content
								the_content();

								// Content pagination
								$args = array(
									'before'           => '<div class="content-pagination clearfix both"> '. __('Pages : ', MAHA_TEXT_DOMAIN),
									'after'            => '</div>',
									'link_before'      => '<span>',
									'link_after'       => '</span>',
									'next_or_number'   => 'number',
									'pagelink'         => '%'
								);
								wp_link_pages( $args ); ?>

							</div>

							<footer class="clearfix both">
								<?php if( has_tag() ) : ?>
								<div class="meta-tags clearfix">
									<?php the_tags( 'Tags : ', '<span>,</span> ' ); ?> 
								</div>
								<?php endif; ?>

								<?php if ( $curated['related_place'] == 'tags' ) { maha_related_posts_place($post->ID); } /* Related below tags */ ?>								
								
								<div class="next-prev clearfix">
								<?php if ( get_next_post() != "" ) : ?>
									<?php next_post_link ( '%link', '<i class="tm-chevron-right"></i><div class="np-caption">' . $curated['s_next_article'] . '</div><h3 class="np-title">%title</h3>' ); ?>
								<?php endif; ?>
									<i class="tm-3dots"></i>
								<?php if ( get_previous_post() != "" ) : ?>
									<?php previous_post_link ( '%link', '<i class="tm-chevron-left"></i><div class="np-caption">' . $curated['s_prev_article'] . '</div><h3 class="np-title">%title</h3>' ); ?>
								<?php endif; ?>
								</div>

								<div class="meta-author">
									<div class="author-thumb">
										<a itemprop="author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
											<?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta( 'email' ), '200' ); } ?>
										</a>
									</div>

									<div class="author-info">
										<h3 class="author-name">
											<a itemprop="author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a>
										</h3>
										<div class="author-desc">
											<span class="fn"><?php the_author_meta( 'description' ); ?></span>
										</div>
										<ul class="author-links">
											<?php maha_user_social_network( get_user_by( 'email', get_the_author_meta( 'email' ) ) ); ?>
										</ul>
									</div>
								</div>

								<?php if ( $curated['related_place'] == 'author' or $curated['related_place'] == '' ) { maha_related_posts_place($post->ID); } /* Related below author */ ?>

							</footer>
						</article> <!-- /.post -->
						<?php
						endwhile;
					endif;
					?>

					<!-- Comment -->
					<?php comments_template(); ?>

				</div>
			</div>

			<?php
			// Sidebar Collumn
			$affix_class = '';
			if ( isset( $curated['single_affix'] ) && $curated['single_affix'] == true ) {
				$affix_class = 'affix_sidebar';
			}
			echo '<!-- Sidebar --><div class="col-sm-4 '. $affix_class .'">';get_sidebar();echo '</div>';
			?>
		</div>
	</div>

</div>


<?php get_footer(); ?>