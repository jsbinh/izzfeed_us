<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package CloneTemplates
 */
?>

<div class="colright-container" role="complementary">
	<div class="colright">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>

	<?php if ( is_active_sidebar('sidebar-2')):?>
		<div class="colright2">
			<div id="undefined-sticky-wrapper" class="sticky-wrapper">
				<div class="stick1">
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
				</div>
			</div>
		</div>
	<?php endif;?>

</div><!-- .colright-container -->
