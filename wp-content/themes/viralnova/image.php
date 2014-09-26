<?php
/**
 * The template for displaying image attachments
 *
 * @package CloneTemplates
 */
// Retrieve attachment metadata.
$metadata = wp_get_attachment_metadata();

get_header(); ?>

	<div class="page-article">
		<?php if (is_active_sidebar('sidebar-4')) :?>
			<div class="banner">
				<?php dynamic_sidebar( 'sidebar-4' ); ?>
			</div>
		<?php endif;?>

		<div id="main" class="colleft" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>
				<article>

					<div class="article-top">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

						<h5 class="atribute red clearfix">
							<div style="float:left;">
								<span class="date">
									<?php echo esc_html( get_the_date() ); ?> 
								</span> 
										
									&nbsp;
								<?php edit_post_link( __( 'Edit', 'clonetemplates' ), '<span class="edit-link">', '</span>' ); ?>
							</div>

							<div style="float:right;">
								<?php printf(__('Go back to <span class="parent-post-link"><a href="%1$s" rel="gallery">%2$s</a></span>','clonetemplates'), get_permalink( $post->post_parent ), get_the_title( $post->post_parent )); ?>
							</div>
						</h5>

						<div class="article-social">
							<div class="addthis_sharing_toolbox">
								<a class="addthis_button_facebook" target="_blank" style="float: left;" title="Facebook" href="http://www.facebook.com/sharer.php?u=<?php echo rawurlencode(get_permalink());?>">
									<div class="articlefb oswald">
									Share This On Facebook
									</div>
								</a>
							</div>
						</div>

						<div class="article-nav oswald">
							<?php previous_image_link( false, __( '<div class="al">&nbsp;</div>', 'clonetemplates' ) ); ?>
							<?php next_image_link( false, __( '<div class="ar">&nbsp;</div>', 'clonetemplates' ) ); ?>
						</div>				
					</div>

					<div class="clearfix"></div>

					<div class="content">
						<div class="entry-attachment">
							<div class="attachment" style="text-align: center;">
								<?php ct_the_attached_image(); ?>
							</div><!-- .attachment -->
						</div><!-- .entry-attachment -->

						<?php
							the_content();
							wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'clonetemplates' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
							) );
						?>
					</div><!-- .content -->
				</article>
			</div><!-- #post-## -->

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() ) :
					fb_comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</div><!-- .colleft -->
		
		<div class="colright-container">
			<?php get_sidebar('post'); ?>
		</div><!-- .colright-container -->

	</div><!-- .page-article -->

<?php get_footer(); ?>