<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package CloneTemplates
 */
?>

<div class="article">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="clearfix"></div>
		<div class="content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'clonetemplates' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
		<div class="clearfix"></div>
		<footer class="entry-footer">
			<?php edit_post_link( __( 'Edit', 'clonetemplates' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-footer -->
	</article><!-- #post-## -->
</div>
