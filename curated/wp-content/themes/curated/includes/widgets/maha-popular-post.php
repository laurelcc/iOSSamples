<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

	- Popular Post

---------------------------------------------------------------------------*/

if ( ! class_exists( 'maha_popular_post' ) ) {
	class maha_popular_post extends WP_Widget {

		function __construct() {

			// Widget settings
			$widget_ops = array('classname' => 'widget_review widget_popular_post', 'description' =>  __("Show popular post", MAHA_TEXT_DOMAIN) );

			// Widget control settings
			$this->alt_option_name = 'widget_popular_post';

			// Create the widget
			parent::__construct('popular-post', wp_get_theme()->get('Name').__(' - Popular Post', MAHA_TEXT_DOMAIN), $widget_ops);
		}

		function widget($args, $instance) {

			extract($args);

			$title = apply_filters('widget_title', empty($instance['title']) ? __('Popular Post', MAHA_TEXT_DOMAIN) : $instance['title'], $instance, $this->id_base);

			if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )  {$number = 5; }

			// Popular Day
			$day = date('d');
			$month = date('m');
			$year = date('Y');
			$popular_day = new WP_Query(
				apply_filters( 'widget_posts_args',
					array( 'posts_per_page' => $number,
						'day' => $day,
						'monthnum' => $month,
						'year' => $year,
						'no_found_rows' => true,
						'post_status' => 'publish',
						'meta_key' => 'post_views_count',
						'orderby' => 'meta_value_num',
						'order' => 'DESC',
						'ignore_sticky_posts' => true
					)
				)
			);

			// Popular Week
			$week = date('W');
			$year = date('Y');
			$popular_week = new WP_Query(
				apply_filters( 'widget_posts_args',
					array( 
						'posts_per_page' => $number,
						'year' => $year,
						'w' => $week,
						'no_found_rows' => true,
						'post_status' => 'publish',
						'meta_key' => 'post_views_count',
						'orderby' => 'meta_value_num', 
						'order' => 'DESC',
						'ignore_sticky_posts' => true
					)
				)
			);

			// Popular Month
			$month = date('m');
			$year = date('Y');
			$popular_month = new WP_Query(
				apply_filters( 'widget_posts_args',
					array(
						'posts_per_page' => $number,
						'year' => $year,
						'monthnum' => $month,
						'no_found_rows' => true,
						'post_status' => 'publish',
						'meta_key' => 'post_views_count',
						'orderby' => 'meta_value_num',
						'order' => 'DESC',
						'ignore_sticky_posts' => true
					)
				)
			);

			echo $before_widget; ?>

			<?php echo "<div class='nav-popular-post'>".
				"<ul>".
					"<li><a href='#' class='popular-active' data-popular='popular_day'>". __('Today', MAHA_TEXT_DOMAIN) ."</a></li>".
					"<li><a href='#' data-popular='popular_week'>". __('Week', MAHA_TEXT_DOMAIN) ."</a></li>".
					"<li><a href='#' data-popular='popular_month'>". __('Month', MAHA_TEXT_DOMAIN) ."</a></li>".
				"</ul>".
			"</div>"; ?>

			<div class='popular'>
			<?php $popular = array('popular_day','popular_week','popular_month');
			foreach ($popular as $key => $value) {
				if ($value === 'popular_day') { $active = ' popular-show'; } else { $active = ''; } ?>
				<div class="clearfix <?php echo $value.$active; ?>">

				<?php if ( ${$value}->have_posts() ) :
					while ( ${$value}->have_posts() ) : ${$value}->the_post(); ?>
						<div class="post-box-small recent-item clearfix" itemscope itemtype="http://schema.org/Article">
								<div class="thumb-wrap zoom-zoom">
									<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
										<?php $thumb_class = 'entry-thumb';
										if ( has_post_thumbnail() ) : // Set Featured Image
											$thumb = maha_featured_url( get_the_ID() , 'mh_widget');
											$thumb_class .= ' zoom-it three';
										else :
											$thumb = maha_no_thumbnail('mh_widget');
										endif; ?>
										<img width="83" height="63" itemprop="image" class="<?php echo $thumb_class; ?>" src="<?php echo $thumb; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
									</a>
								</div>

							<div class="box-small-wrap">
								<h3 itemprop="name" class="entry-title short-bottom">
									<a itemprop="url" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
								</h3>
								<meta itemprop="headline" content="<?php the_title(); ?>" />
								<div class="meta-info">
									<span itemprop="author" class="entry-author"><?php the_author(); ?></span>
									<span class="coma">,</span> 
									<time itemprop="datePublished" class="entry-date" datetime="<?php the_time( 'c' ); ?>" >
									<?php the_time( get_option( 'date_format' ) ); ?>
									</time>
								</div>
							</div>
						</div>
					<?php
					endwhile;
				endif; ?>

				</div>
			<?php } // End foreach ?>
			</div>

			<?php
			wp_reset_postdata();

			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['number'] = (int) $new_instance['number'];

			return $instance;
		}

		function form( $instance ) {
			$title		= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : __('Popular Post', MAHA_TEXT_DOMAIN);
			$number 	= isset( $instance['number'] ) ? absint( $instance['number'] ) : 4; ?>

			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', MAHA_TEXT_DOMAIN ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of reviews to show:', MAHA_TEXT_DOMAIN ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
			</p>
		<?php }
	}
}


register_widget( 'maha_popular_post' );
?>