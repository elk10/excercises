<?php

function ek_add_custom_metabox() {

	add_meta_box(
		'ek_meta',
		__( 'Events' ),
		'ek_meta_callback',
		'event',
		'normal',
		'core'
	);

}

add_action( 'add_meta_boxes', 'ek_add_custom_metabox' );

function ek_meta_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'ek_events_nonce' );
	$ek_stored_meta = get_post_meta( $post->ID ); 

	?>

	<div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="event-id" class="ek-row-title"><?php _e( 'Event Name', 'wp-job-listing' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" class="ek-row-content" name="event_id" id="event-id"
				value="<?php if ( ! empty ( $ek_stored_meta['event_id'] ) ) {
					echo esc_attr( $ek_stored_meta['event_id'][0] );
				} ?>"/>
			</div>
		</div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="date-listed" class="ek-row-title"><?php _e( 'Start Date', 'wp-job-listing' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" size=10 class="ek-row-content datepicker" name="date_listed" id="date-listed" value="<?php if ( ! empty ( $ek_stored_meta['date_listed'] ) ) echo esc_attr( $ek_stored_meta['date_listed'][0] ); ?>"/>
			</div>
		</div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="application_deadline" class="ek-row-title"><?php _e( 'End Date', 'wp-job-listing' ) ?></label>
			</div>
			<div class="meta-td">
				<input type="text" size=10 class="ek-row-content datepicker" name="application_deadline" id="application_deadline" value="<?php if ( ! empty ( $ek_stored_meta['application_deadline'] ) ) echo esc_attr( $ek_stored_meta['application_deadline'][0] ); ?>"/>
			</div>
		</div>

		<?php

		$content = get_post_meta( $post->ID, 'principle_duties', true );
		$editor = 'principle_duties';
		$settings = array(
			'textarea_rows' => 8,
			'media_buttons' => false,
		);

		wp_editor( $content, $editor, $settings); ?>
		</div>
		
	        <div class="meta-td">
	          <select name="relocation_assistance" id="relocation-assistance">
		          <option value="Yes" <?php if ( ! empty ( $ek_stored_meta['relocation_assistance'] ) ) selected( $ek_stored_meta['relocation_assistance'][0], 'Yes' ); ?>><?php _e( 'Yes', 'wp-job-listing' )?></option>';
		          <option value="No" <?php if ( ! empty ( $ek_stored_meta['relocation_assistance'] ) ) selected( $ek_stored_meta['relocation_assistance'][0], 'No' ); ?>><?php _e( 'No', 'wp-job-listing' )?></option>';
	          </select>
	    </div> 
	</div>	
	<?php
}

function ek_meta_save( $post_id ) {
	// Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'ek_events_nonce' ] ) && wp_verify_nonce( $_POST[ 'ek_events_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    if ( isset( $_POST[ 'event_id' ] ) ) {
    	update_post_meta( $post_id, 'event_id', sanitize_text_field( $_POST[ 'event_id' ] ) );
    }
    if ( isset( $_POST[ 'date_listed' ] ) ) {
    	update_post_meta( $post_id, 'date_listed', sanitize_text_field( $_POST[ 'date_listed' ] ) );
    }
    if ( isset( $_POST[ 'application_deadline' ] ) ) {
    	update_post_meta( $post_id, 'application_deadline', sanitize_text_field( $_POST[ 'application_deadline' ] ) );
    }
	if ( isset( $_POST[ 'relocation_assistance' ] ) ) {
		update_post_meta( $post_id, 'relocation_assistance', sanitize_text_field( $_POST[ 'relocation_assistance' ] ) );
	}
}
add_action( 'save_post', 'ek_meta_save' );







