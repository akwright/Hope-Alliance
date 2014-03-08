			<!-- <section id="connect">
				<div class="row">
					<div class="small-12 medium-5 columns">
						<h2>Connect With Us</h2>
						<p>Stay up-to-date on what’s going on at Hope Alliance by following us on social media, or sending us an email!</p>
					</div>
					<div id="social-wrap" class="small-12 medium-offset-1 medium-6 columns">
						<a class="socials s-facebook" href="#"></a>
						<a class="socials s-email" href="#"></a>
					</div>
				</div>
			</section> -->

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
