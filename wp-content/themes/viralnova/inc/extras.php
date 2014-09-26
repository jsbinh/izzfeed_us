<?php
/**
 * Custom functions that act exclusively for our theme
 *
 *
 * @package CloneTemplates
 */

/**
 * Add a "Font Awesome Icon" field to Category
 *
 */
// Add term page
add_action( 'category_add_form_fields', 'ct_taxonomy_add_new_meta_field', 10, 2 );

function ct_taxonomy_add_new_meta_field() {
	// this will add the custom meta field to the add new term page
	?>
	<div class="form-field">
		<label for="term_meta[cat_icon]"><?php _e( 'Font Awesome Icons', 'clonetemplates' ); ?></label>
		<input type="text" name="term_meta[cat_icon]" id="term_meta[cat_icon]" value="">
		<p class="description"><?php printf(__( 'Choose your category icon from <a href="%s" target="_blank">Font Awesome Icons</a>. For example: <b>fa-wordpress</b>','clonetemplates' ), 'http://fontawesome.io/icons/'); ?></p>
	</div>
<?php
}

// Edit term page
add_action( 'category_edit_form_fields', 'ct_taxonomy_edit_meta_field', 10, 2 );

function ct_taxonomy_edit_meta_field($term) {
 
	// put the term ID into a variable
	$t_id = $term->term_id;
 
	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "taxonomy_$t_id" ); ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[cat_icon]"><?php _e( 'Font Awesome Icon', 'clonetemplates' ); ?></label></th>
		<td>
			<input type="text" name="term_meta[cat_icon]" id="term_meta[cat_icon]" value="<?php echo esc_attr( $term_meta['cat_icon'] ) ? esc_attr( $term_meta['cat_icon'] ) : ''; ?>">
			<p class="description"><?php printf(__( 'Choose your category icon from <a href="%s" target="_blank">Font Awesome Icons</a>. For example: <b>fa-wordpress</b>','clonetemplates' ), 'http://fontawesome.io/icons/'); ?></p>
		</td>
	</tr>
<?php
}

// Save extra taxonomy fields callback function.
add_action( 'edited_category', 'ct_save_taxonomy_custom_meta', 10, 2 );  
add_action( 'create_category', 'ct_save_taxonomy_custom_meta', 10, 2 );

function ct_save_taxonomy_custom_meta( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id = $term_id;
		$term_meta = get_option( "taxonomy_$t_id" );
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		// Save the option array.
		update_option( "taxonomy_$t_id", $term_meta );
	}
}
/**
 * Add a meta box to check whether it's featured or not.
 */
function ct_featured_check_box() {

    $screens = array( 'post' );//we only need Featured filter in post

    foreach ( $screens as $screen ) {

        add_meta_box(
            'featured_check_box',
            __( 'Is this a featured post?', 'clonetemplates' ),
            'ct_inner_featured_check_box',
            $screen,
            'side',
            'high'
        );
    }
}
add_action( 'add_meta_boxes', 'ct_featured_check_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function ct_inner_featured_check_box( $post ) {

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'ct_inner_featured_check_box', 'ct_inner_featured_check_box_nonce' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  $value = get_post_meta( $post->ID, 'ct_featured', true );
  if(!$value) $value = 'no';?>

  <input type="checkbox" id="featured_check_box" name="featured_check_box" value="<?php echo $value;?>" <?php checked( $value, 'yes' ); ?>>
  <label for="featured_check_box">
       <?php _e( 'If this is checked as a featured post, it will display a bigger image on homepage and archive pages.', 'clonetemplates' );?>
  </label>
  
<?php }

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function ct_featured_save_postdata( $post_id ) {

  /*
   * We need to verify this came from the our screen and with proper authorization,
   * because save_post can be triggered at other times.
   */

  // Check if our nonce is set.
  if ( ! isset( $_POST['ct_inner_featured_check_box_nonce'] ) )
    return $post_id;

  $nonce = $_POST['ct_inner_featured_check_box_nonce'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'ct_inner_featured_check_box' ) )
      return $post_id;

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;

  // Check the user's permissions.
  if ( 'post' == $_POST['post_type'] ) {

    if ( ! current_user_can( 'edit_post', $post_id ) )
        return $post_id;
  }

  /* OK, its safe for us to save the data now. */

  // Checks for input and saves
  if( isset( $_POST[ 'featured_check_box' ] ) ) {
    update_post_meta( $post_id, 'ct_featured', 'yes' );
  } else {
    update_post_meta( $post_id, 'ct_featured', 'no' );
  }
}
add_action( 'save_post', 'ct_featured_save_postdata' );

/**
 * Social profiles
 */
function ct_social_profile() {

    if ( of_get_option('fb')) {
        echo '<a href="'.of_get_option('fb').'" target="_blank" class="fb">Facebook</a>';
    }

    $profiles = array('google', 'twitter', 'youtube', 'pinterest', 'linkedin');

    foreach ($profiles as $profile) {
        if ( of_get_option($profile)) {
            echo '<a href="'.of_get_option($profile).'" target="_blank" class="'.$profile.'">&nbsp;</a>';
        }
    }
}