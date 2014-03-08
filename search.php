<?php
/*---------------------------------
	Search Template
------------------------------------*/
	get_header(); 
?>

<h1 class="title"><?php _e('Search Results', 'goodwork'); ?></h1>
<hr style="margin:-30px 0 40px" />

<div class="postsContainer classic">

			<?php 

				$allsearch = &new WP_Query("s=$s&showposts=-1"); 
				$key = esc_html($s, 1); 
				$count = $allsearch->post_count;
				wp_reset_query(); 

			?>
		
			<?php if ( have_posts() ) : ?>

				<h4 class="result more">
					<?php echo __('Your search for ', 'goodwork') . '<em>"'.get_search_query().'"</em>' . __(' returned ', 'goodwork') . $count . __(' results', 'goodwork'); ?>
				</h4>

				<?php get_template_part( 'loop', 'search' ); ?>
			
				<?php rb_pagination($allsearch->max_num_pages, 1, 'results'); ?>

			<?php else : ?>

				<div class="full_width">
					<h4 class="more"><?php _e( 'Nothing Found', 'goodwork' ); ?></h4>
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'goodwork' ); ?></p>
				</div>

			<?php endif; ?>

		</div>

<?php get_footer(); ?>