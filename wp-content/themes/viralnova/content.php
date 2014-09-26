<?php
/**
 * @package CloneTemplates
 */

$value = get_post_meta( $post->ID, 'ct_featured', true );

if($value == 'yes') :?>
	<div id="post-<?php the_ID(); ?>" <?php post_class('grid-box col span_2 feature'); ?>>
		<a href="<?php the_permalink();?>">
			<img src="<?php echo ct_get_thumbnail_src('featured');?>" alt="<?php the_title();?>" width="690" height="252" border="0">
		</a>
		<h4 class="snip">
			<a href="<?php the_permalink();?>">
				<?php echo ct_title('25');?>
			</a>
		</h4>
	</div><!-- #post-## -->
<?php else :?>
	<div id="post-<?php the_ID(); ?>" <?php post_class('grid-box col span_1 feature'); ?>>
		<a href="<?php the_permalink();?>">
			<img src="<?php echo ct_get_thumbnail_src('thumbnail');?>" alt="<?php the_title();?>" width="340" height="252" border="0">
		</a>
		<h4 class="snip">
			<a href="<?php the_permalink();?>">
				<?php echo ct_title('15');?>
			</a>
		</h4>
	</div><!-- #post-## -->
<?php endif;?>