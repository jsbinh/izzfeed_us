<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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
		
		<div class="colleft" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
				// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() ) :
						fb_comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- .colleft -->

		<?php get_sidebar(); ?>
		
	</div><!-- .page-article -->

<?php get_footer(); ?>
