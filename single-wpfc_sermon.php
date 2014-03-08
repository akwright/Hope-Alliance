<?php
/**
 * Template Name: Sermons
 * The template for displaying sermons.
 *
 */

get_header(); ?>
	<section id="primary">
		<div id="content" class="row" role="main">

			<div class="small-12 columns">
				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<article class="post">
							<div class="row">
								<div class="hide-for-small medium-3 columns wpfc_sermon_image">
									<?php render_sermon_image('sermon_thumbnail'); ?>
								</div>
								<div class="small-12 medium-9 columns">
									<h1 class="title"><?php the_title(); ?></h1>
									<div class="entry-meta">
										<?php wpfc_sermon_date('l, F j, Y'); ?>
										<span class="meta-sep"> by </span> <?php echo the_terms( $post->ID, 'wpfc_preacher', '', ', ', ' ' ); ?>
									</div>

									<div class="wpfc_sermon_meta cf">
										<p>
											<?php
												wpfc_sermon_meta('bible_passage', '<span class="bible_passage">'.__( 'Main Passage: ', 'sermon-manager'), '</span>');
												echo the_terms( $post->ID, 'wpfc_sermon_series', '<br><span class="sermon_series">'.__( 'Series: ', 'sermon-manager'), ' ', '</span>' );
											?>
										</p>
									</div>
								</div>
							</div>

							<div class="the-content row">

								<div class="wpfc_sermon cf small-12 medium-9 columns">
									<div class="wpfc_sermon_files">
										<?php wpfc_sermon_files(); ?>
									</div>
									<div class="wpfc_sermon_description">
										<?php wpfc_sermon_description(); ?>
									</div>

									<?php echo the_terms( $post->ID, 'wpfc_sermon_topics', '<p class="sermon_topics">'.__( 'Topics: ', 'sermon-manager'), ',', '', '</p>' ); ?>
								</div>

								<div class="wpfc_downloads small-12 medium-3 columns">
									<?php wpfc_sermon_attachments(); ?>
								</div>

							</div><!-- the-content -->

						</article>

					<?php endwhile; ?>

				<?php else : ?>

					<article class="post error">
						<h1 class="404">Nothing posted yet</h1>
					</article>

				<?php endif; ?>

				<div id="nav-below" class="navigation row collapse">
					<div class="nav-previous small-6 columns"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'sermon-manager' ) . '</span> %title' ); ?></div>
					<div class="nav-next small-6 columns"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'sermon-manager' ) . '</span>' ); ?></div>
				</div><!-- #nav-below -->

				<?php comments_template( '', true ); ?>
			</div>

		</div><!-- #content .site-content -->
	</section><!-- #primary .content-area -->
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>