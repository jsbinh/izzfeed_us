<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package CloneTemplates
 */

get_header(); ?>

	<div id="articleContainer" class="grid clearfix articles">
		<?php if (is_active_sidebar('sidebar-6')) :?>
			<div class="grid-box col span_1 signup-box" style="float: right; clear: right;">
				<?php dynamic_sidebar( 'sidebar-6' ); ?>
			</div>
		<?php endif;?>
		
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php clonetemplates_numeric_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

	</div><!-- #articleContainer -->

<?php get_footer(); ?>
