<?php

/**
 * The template for displaying any archive.
 *
 */

get_header(); ?>

<section id="primary">
		<div id="content" role="main">


			<?php
				$sermon_settings = get_option('wpfc_options');
				$archive_title = $sermon_settings['archive_title'];
				if(empty($archive_title)):
					$archive_title = 'Sermons';
				endif;
			?>
			<div class="row">
				<div class="small-12 columns">
					<h1 class="title"><?php echo $archive_title; ?></h1>
					<div class="wpfc_sorting clearfix">
						<?php render_wpfc_sorting(); ?>
					</div>
				</div>
			</div>

			<?php /* If there are no posts to display, such as an empty archive page */ ?>
			<?php if ( ! have_posts() ) : ?>
				<div class="row">
					<div id="post-0" class="post error404 not-found small-12 columns">
						<h1 class="entry-title"><?php _e( 'Not Found', 'sermon-manager' ); ?></h1>
						<div class="entry-content">
							<p><?php _e( 'Apologies, but no sermons were found.', 'sermon-manager' ); ?></p>
							<?php get_search_form(); ?>
						</div><!-- .entry-content -->
					</div><!-- #post-0 -->
				</div>
			<?php endif; ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					echo (++$j % 2 == 0) ? "<div class='full-width'>" : "<div class='row'>";
				?>
					<div id="post-<?php the_ID(); ?>" <?php post_class('small-12 columns'); ?>>
						<div class="row">
							<div class="small-12 medium-5 large-3 columns">
								<div class="wpfc_sermon_image">
									<?php render_sermon_image('sermon_medium'); ?>
								</div>
							</div>
							<div class="small-12 medium-7 large-9 columns">
								<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'sermon-manager' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
								</h1>

								<div class="entry-content">
									<div class="wpfc_sermon_wrap cf">

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
								</div><!-- .entry-content -->
							</div>
						</div>
						<div class="row">
							<div class="small-12 columns">
								<?php	$sermonoptions = get_option('wpfc_options'); if ( isset($sermonoptions['archive_player']) == '1') { ?>
									<div class="wpfc_sermon cf">
										<?php wpfc_sermon_files(); ?>
									</div>
								<?php } ?>

								<div class="entry-utility">
									<!--
									<span class="comments-link">
									<?php// comments_popup_link( __( 'Leave a comment', 'sermon-manager' ), __( '1 Comment', 'sermon-manager' ), __( '% Comments', 'sermon-manager' ) ); ?></span>
									<?php// edit_post_link( __( 'Edit', 'sermon-manager' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
									-->
								</div><!-- .entry-utility -->
								<p>
									<?php
										$description = get_post_meta($post->ID, 'sermon_description', 'true');
										if ($description != '')
											$description = truncateHTML($description, 200);
											echo $description;
									?>
								</p>

								<a class="button" href="<?php the_permalink(); ?>">Read More</a>
							</div>
						</div>
					</div><!-- #post-## -->
				</div>
			<?php endwhile; // End the loop. Whew. ?>

			<?php /* Display navigation to next/previous pages when applicable */ ?>
			<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<div class="row">
					<div id="nav-below" class="navigation">
						<div class="nav-previous small-6 columns"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'sermon-manager' ) ); ?></div>
						<div class="nav-next small-6 columns"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'sermon-manager' ) ); ?></div>
					</div><!-- #nav-below -->
				</div>
			<?php endif; ?>


		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_footer(); ?>