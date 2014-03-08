<?php

/**
 * The template for displaying any archive.
 *
 */

get_header(); ?>

<section id="primary">
		<div id="content" class="row" role="main">

			<div class="small-12 columns">

				<?php if ( have_posts() ) : ?>
					<header class="archive-header">
						<h1 class="archive-title"><?php
							if ( is_day() ) :
								printf( __( 'Daily Archives: %s', 'hope' ), get_the_date() );
							elseif ( is_month() ) :
								printf( __( 'Monthly Archives: %s', 'hope' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'hope' ) ) );
							elseif ( is_year() ) :
								printf( __( 'Yearly Archives: %s', 'hope' ), get_the_date( _x( 'Y', 'yearly archives date format', 'hope' ) ) );
							else :
								_e( 'Archives', 'hope' );
							endif;
						?></h1>
					</header><!-- .archive-header -->

					<?php /* The loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<h1 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
						<?php the_content(); ?>
					<?php endwhile; ?>

					<?php wp_link_pages(); ?>

				<?php else : ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif; ?>

			</div>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>