<?php
/**
 * 	Template Name: Home Page
 *
 *	This page template is for the homepage. It will pull the most recent posts
 *  and display the featured above the others.
 *
*/
get_header(); ?>

<?php $options = get_option('hope_alliance_options'); ?>

<section id="slider">
	<?php putRevSlider("homepage_slider") ?>
</section>

<section id="primary">
	<div id="content" role="main">
		<div class="row">

		<?php if ($options) :

			for ($i = 1; $i < 4; $i++) : ?>
				<div class="small-12 medium-4 columns">
					<div class="home-box box-<?php echo $i; ?>">
						<a href="<?php echo get_permalink($options['box_'.$i.'_link']); ?>">
							<span class="box-mask"></span>
							<h1><?php echo $options['box_'.$i.'_title']; ?></h1>
							<p>
								<?php echo $options['box_'.$i.'_text']; ?>
								<i class="icon-arrow_right"></i>
							</p>
						</a>
					</div>
				</div>

		<?php endfor; endif; ?>

		</div>

		<?php if ( have_posts() ) :
		// Do we have any posts/pages in the database that match our query?
		?>

			<?php while ( have_posts() ) : the_post();
			// If we have a page to show, start a loop that will display it
			?>

			<?php the_content(); ?>

			<?php endwhile; // OK, let's stop the page loop once we've displayed it ?>

		<?php else : // Well, if there are no posts to display and loop through, let's apologize to the reader (also your 404 error) ?>

			<article class="post error">
				<h1 class="404">Nothing has been posted like that yet</h1>
			</article>

		<?php endif; // OK, I think that takes care of both scenarios (having a page or not having a page to show) ?>
	</div><!-- #content -->
</section><!-- #primary -->

<section id="secondary">
	<div class="row">
		<div class="small-12 medium-6 columns">
			<div id="event-col">
				<div class="col-headers">
					<h2 class="column-headers">Upcoming Events</h2>
				</div>
				<div class="col-content clearfix">
					<?php echo do_shortcode( '[google-calendar-events id="1" type="list-grouped" max="3"]' ); ?>
					<a href="events/" class="more-link">SEE ALL EVENTS</a>
				</div>
			</div>
		</div>
		<div class="small-12 medium-6 columns">
			<div id="sermon-col">
				<div class="col-headers">
					<h2 class="column-headers">Recent Sermons</h2>
				</div>
				<div class="col-content clearfix">
					<?php
						$latest_sermon = new WP_Query(array(
							'post_type' => 'wpfc_sermon',
							'posts_per_page' => 1,
							'post_status' => 'publish',
							'wpfc_service_type' => 'sunday-service',
						    'no_found_rows' => true,
						    'update_post_term_cache' => false,
						    'update_post_meta_cache' => false
						));
						if ($latest_sermon->have_posts()) :
						?>
							<?php  while ($latest_sermon->have_posts()) : $latest_sermon->the_post(); ?>
								<?php global $post; ?>

								<div id="latest_sermon">
									<a id="latest_sermon_title" class="sermon-title" title="<?php echo esc_attr( get_the_title() ); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
									<span class="sermon-date">
										on&nbsp;
										<?php wpfc_sermon_date(get_option('date_format')); ?>
									</span>
									<p class="sermon-description">
										<?php
											echo trim_better(get_wpfc_sermon_meta('sermon_description'), 220, true, false);
										 ?>
									</p>
									<?php wpfc_sermon_files(); ?>
								</div>
							<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>
					<a href="sermons/" class="more-link">VIEW ALL SERMONS</a>
				</div>
			</div>
		</div>
	</div>
</section>


<?php get_footer(); // This fxn gets the footer.php file and renders it ?>