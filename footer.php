			<footer class="site-footer" role="contentinfo">
				<section id="top-footer" class="row">
					<?php if(is_active_sidebar('footer_widget_1'))
							dynamic_sidebar('footer_widget_1'); ?>

					<?php if(is_active_sidebar('footer_widget_2'))
							dynamic_sidebar('footer_widget_2'); ?>

					<section class="small-6 medium-3 columns">

						<?php if(is_active_sidebar('footer_widget_3'))
								dynamic_sidebar('footer_widget_3'); ?>

						<?php if(is_active_sidebar('footer_widget_4'))
								dynamic_sidebar('footer_widget_4'); ?>

					</section>

					<?php if(is_active_sidebar('footer_widget_5'))
								dynamic_sidebar('footer_widget_5'); ?>
				</section>
				<section class="row">
					<div class="small-12 medium-8 columns">
						<?php if(is_active_sidebar('hope_footer_copyright'))
								dynamic_sidebar('hope_footer_copyright'); ?>
					</div>
					<div class="small-12 medium-4 columns">
						<p class="credit">
							Designed & Developed by <a href="http://akwright.com">Alex Wright</a>
						</p>
					</div>
				</section>
			</footer>

			<?php
				wp_footer();

				wp_register_script('theme_foundation', get_template_directory_uri().'/js/foundation.min.js', array('jquery'), NULL, true);
				wp_register_script('theme_scripts', get_template_directory_uri().'/js/main.js', array('theme_plugins'), NULL, true);

				wp_enqueue_script('theme_foundation');
				wp_enqueue_script('theme_scripts');
			?>
		</div>
	</div>
	<nav class="outer-nav right vertical">
		<?php wp_nav_menu( array(
			'theme_location' 	=> 'mobile',
			'menu_class' 			=> 'mobile-nav',
			'container'				=> false,
			'depth'						=> 0,
			'items_wrap'			=> '%3$s'
			) ); ?>
	</nav>
</div>

</body>
</html>
