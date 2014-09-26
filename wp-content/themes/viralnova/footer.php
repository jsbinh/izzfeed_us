<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package CloneTemplates
 */
?>

	</div><!-- .content -->
</div><!-- .wrapper -->	

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="footer">
		<?php if (is_active_sidebar('sidebar-7')) :?>
			<div class="ad">
				<div class="signup">
					<?php dynamic_sidebar( 'sidebar-7' ); ?>
				</div>
			</div>				
		<?php endif;?>

		<div class="clearfix footer_container">
			<div class="footmenu white">
				<div class="categories">
					<?php dynamic_sidebar( 'sidebar-3' ); ?>
				</div>
				<div class="connect">
					<div class="social">
						<?php ct_social_profile();?>
					</div>					
					<a class="footlogo" href="<?php echo esc_url( home_url( '/' ) ); ?>">&nbsp;</a>
					
					<div class="copy">
						<span>&copy; <?php echo date('Y'); ?></span><?php bloginfo( 'name' ); ?>
						<?php
							if ( of_get_option('copyright') ) {
								echo ( of_get_option('copyright') );
							} else {
								printf(__( 'Made with <span class="red">&hearts;</span> from <a href="%s" rel="designer" target="_blank">CloneTemplates</a>', 'clonetemplates' ), 'http://clonetemplates.com/');
							}
						?>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</footer><!-- #colophon -->

<div id="back-to-top" title="<?php _e( 'Return to top of page', 'clonetemplates' ); ?>"><div id="arrowup"></div></div>

<?php wp_footer(); ?>

</body>
</html>
