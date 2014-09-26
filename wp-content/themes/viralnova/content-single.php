<?php
/**
 * @package CloneTemplates
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>
	<article>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<h5 class="atribute red clearfix">
			<div style="float:left;">
				<span class="date">
					<?php the_date();?> 
				</span> 
						
					&nbsp;
			</div>
					
			<div style="float:right">

				<?php foreach (get_the_category() as $cat) : 
					$cat_id   = $cat->term_id;
					$cat_data = get_option("taxonomy_$cat_id");?>

					<a href="<?php echo get_category_link($cat->term_id); ?>">
						<span class="category">
						<?php if (isset($cat_data['cat_icon'])){
							echo '<i class="fa '.$cat_data['cat_icon'].'"></i>';
						}
						?>
				 		<?php echo $cat->cat_name; ?>
				 		</span>
			 		</a>
			 	<?php endforeach; ?>
													
			</div>
		</h5>

		<div class="article-top">
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
	
				<a href="<?php echo get_permalink(get_adjacent_post(false,'',false)); ?>" rel="prev">
					<div class="al">&nbsp;</div>
					<?php _e( 'prev article', 'clonetemplates' ); ?>
				</a>
				
				<a href="<?php echo get_permalink(get_adjacent_post(false,'',true)); ?>" rel="next">
					<?php _e( 'next article', 'clonetemplates' ); ?>
					<div class="ar">&nbsp;</div>
				</a>
			</div>				
		</div>

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
			<?php if(of_get_option('postmeta')):?>
				<?php
					/* translators: used between list items, there is a space after the comma */
					$category_list = get_the_category_list( __( ', ', 'clonetemplates' ) );

					/* translators: used between list items, there is a space after the comma */
					$tag_list = get_the_tag_list( '', __( ', ', 'clonetemplates' ) );

					if ( ! clonetemplates_categorized_blog() ) {
						// This blog only has 1 category so we just need to worry about tags in the meta text
						if ( '' != $tag_list ) {
							$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'clonetemplates' );
						} else {
							$meta_text = __( 'Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'clonetemplates' );
						}

					} else {
						// But this blog has loads of categories so we should probably display them here
						if ( '' != $tag_list ) {
							$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'clonetemplates' );
						} else {
							$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'clonetemplates' );
						}

					} // end check for categories on this blog

					printf(
						$meta_text,
						$category_list,
						$tag_list,
						get_permalink()
					);
				?>
			<?php endif;?>

			<?php edit_post_link( __( 'Edit', 'clonetemplates' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-footer -->
	</article>
</div><!-- #post-## -->

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
	
				<a href="<?php echo get_permalink(get_adjacent_post(false,'',false)); ?>" rel="prev">
					<div class="al">&nbsp;</div>
					<?php _e( 'prev article', 'clonetemplates' ); ?>
				</a>
				
				<a href="<?php echo get_permalink(get_adjacent_post(false,'',true)); ?>" rel="next">
					<?php _e( 'next article', 'clonetemplates' ); ?>
					<div class="ar">&nbsp;</div>
				</a>
</div>

<div class="clearfix"></div>

<div id="last" class="weboffers">
	<div class="ad">
		<div class="aligncenter">
			<?php if (is_active_sidebar('sidebar-5')) :?>
				<?php dynamic_sidebar( 'sidebar-5' ); ?>
			<?php endif;?>
		</div>
	</div>
</div>
