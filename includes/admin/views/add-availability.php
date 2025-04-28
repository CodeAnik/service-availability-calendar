<?php
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( isset( $_POST['sac_submit'] ) ) {
	$service_title = sanitize_text_field( $_POST['service_title'] );
	$is_available  = sanitize_text_field( $_POST['availability'] );
	$month         = '';
	$year          = '';

	if ( 'yes' === $is_available && isset( $_POST['availability_month'], $_POST['availability_year'] ) ) {
		$month = sanitize_text_field( $_POST['availability_month'] );
		$year  = sanitize_text_field( $_POST['availability_year'] );
	}

	$post_id = wp_insert_post(
		array(
			'post_type'   => 'service_availability',
			'post_title'  => $service_title,
			'post_status' => 'publish',
		)
	);

	if ( $post_id ) {
		update_post_meta( $post_id, '_sac_is_available', $is_available );
		update_post_meta( $post_id, '_sac_availability_month', $month );
		update_post_meta( $post_id, '_sac_availability_year', $year );

		// Trigger shortcode creation (we'll implement this later)
		do_action( 'sac_service_availability_saved', $post_id, $is_available, $month, $year );

		echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__( 'Service availability saved successfully!', 'service-availability-calendar' ) . '</p></div>';
	} else {
		echo '<div class="notice notice-error is-dismissible"><p>' . esc_html__( 'There was an error saving the service availability.', 'service-availability-calendar' ) . '</p></div>';
	}
}
?>

<div class="wrap">
	<h2><?php esc_html_e( 'Add New Service Availability', 'service-availability-calendar' ); ?></h2>
	<form method="post" action="">
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php esc_html_e( 'Service Title', 'service-availability-calendar' ); ?></th>
				<td><input type="text" name="service_title" class="regular-text" required></td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php esc_html_e( 'Availability', 'service-availability-calendar' ); ?></th>
				<td>
					<select name="availability" id="availability">
						<option value="no"><?php esc_html_e( 'No', 'service-availability-calendar' ); ?></option>
						<option value="yes"><?php esc_html_e( 'Yes', 'service-availability-calendar' ); ?></option>
					</select>
				</td>
			</tr>
			<tr valign="top" id="availability_details" style="display: none;">
				<th scope="row"><?php esc_html_e( 'Available From', 'service-availability-calendar' ); ?></th>
				<td>
					<select name="availability_month">
						<option value=""><?php esc_html_e( 'Select Month', 'service-availability-calendar' ); ?></option>
						<?php
						$months = array(
							'01' => __( 'January', 'service-availability-calendar' ),
							'02' => __( 'February', 'service-availability-calendar' ),
							'03' => __( 'March', 'service-availability-calendar' ),
							'04' => __( 'April', 'service-availability-calendar' ),
							'05' => __( 'May', 'service-availability-calendar' ),
							'06' => __( 'June', 'service-availability-calendar' ),
							'07' => __( 'July', 'service-availability-calendar' ),
							'08' => __( 'August', 'service-availability-calendar' ),
							'09' => __( 'September', 'service-availability-calendar' ),
							'10' => __( 'October', 'service-availability-calendar' ),
							'11' => __( 'November', 'service-availability-calendar' ),
							'12' => __( 'December', 'service-availability-calendar' ),
						);
						foreach ( $months as $value => $label ) {
							echo '<option value="' . esc_attr( $value ) . '">' . esc_html( $label ) . '</option>';
						}
						?>
					</select>
					<select name="availability_year">
						<option value=""><?php esc_html_e( 'Select Year', 'service-availability-calendar' ); ?></option>
						<?php
						$current_year = date( 'Y' );
						for ( $i = $current_year; $i <= $current_year + 5; $i++ ) {
							echo '<option value="' . esc_attr( $i ) . '">' . esc_html( $i ) . '</option>';
						}
						?>
					</select>
				</td>
			</tr>
		</table>
		<?php submit_button( __( 'Save Availability', 'service-availability-calendar' ), 'primary', 'sac_submit' ); ?>
	</form>
</div>

<script>
    jQuery(document).ready(function($) {
        $('#availability').change(function() {
            if ($(this).val() === 'yes') {
                $('#availability_details').show();
            } else {
                $('#availability_details').hide();
            }
        });
    });
</script>