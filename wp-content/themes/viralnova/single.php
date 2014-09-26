<?php
/**
 * The template for displaying all single posts.
 *
 * @package CloneTemplates
 */

get_header(); ?>

	<div class="page-article">
		<?php if (is_active_sidebar('sidebar-4')) :?>
			<div class="banner">
				<?php dynamic_sidebar( 'sidebar-4' ); ?>
			</div>
		<?php endif;?>

		<div id="main" class="colleft" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

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