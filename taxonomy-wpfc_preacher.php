<?php
/**
 * The template for displaying Preacher pages.
 *
 */

get_header(); ?>

	<section id="primary">
		<div id="content" class="row" role="main">
			<div class="small-12 columns">
				<h1 class="title"><?php
					printf( __( 'Sermons by: %s', 'sermon-manager' ), '<span>' . single_cat_title( '', false ) . '</span>' );
				?></h1>
				<div id="wpfc_sermon_tax_description">
				<?php
					/* Image */
					print apply_filters( 'sermon-images-queried-term-image', '', array( 'attr' => array( 'class' => 'alignleft' ), 'after' => '</div>', 'before' => '<div id="wpfc_sermon_image">', 'image_size' => 'thumbnail', ) );
					/* Description */
					$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo '<div class="archive-meta">' . $category_description . '</div>';
				?>
				</div>

				<?php /* If there are no posts to display, such as an empty archive page */ ?>
				<?php if ( ! have_posts() ) : ?>
					<div id="post-0" class="post error404 not-found">
						<h1 class="entry-title"><?php _e( 'Not Found', 'sermon-manager' ); ?></h1>
						<div class="entry-content">
							<p><?php _e( 'Apologies, but no sermons were found.', 'sermon-manager' ); ?></p>
							<?php get_search_form(); ?>
						</div><!-- .entry-content -->
					</div><!-- #post-0 -->
				<?php endif; ?>

				<?php while ( have_posts() ) : the_post(); ?>

						<div id="post-<?php the_ID(); ?>" <?php post_class('row'); ?>>
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

										<div class="entry-utility">
											<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'sermon-manager' ), __( '1 Comment', 'sermon-manager' ), __( '% Comments', 'sermon-manager' ) ); ?></span>
											<?php edit_post_link( __( 'Edit', 'sermon-manager' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
										</div><!-- .entry-utility -->

									</div>
								</div><!-- .entry-content -->
							</div>
						</div><!-- #post-## -->

				<?php endwhile; // End the loop. Whew. ?>

				<?php /* Display navigation to next/previous pages when applicable */ ?>
				<?php if (  $wp_query->max_num_pages > 1 ) : ?>
					<div id="nav-below" class="navigation row clearfix">
						<div class="nav-previous small-6 columns"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'sermon-manager' ) ); ?></div>
						<div class="nav-next small-6 columns"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'sermon-manager' ) ); ?></div>
					</div><!-- #nav-below -->
				<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #container -->
	</section>

<?php get_footer(); ?>