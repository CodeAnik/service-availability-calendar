<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! isset( $_GET['id'] ) || empty( $_GET['id'] ) ) {
    echo '<div class="notice notice-error"><p>Invalid Availability ID.</p></div>';
    return;
}

$availability_id = intval( $_GET['id'] );

// Get existing data
$service_title      = get_the_title( $availability_id );
$is_available       = get_post_meta( $availability_id, '_sac_is_available', true );
$availability_month = get_post_meta( $availability_id, '_sac_availability_month', true );
$availability_year  = get_post_meta( $availability_id, '_sac_availability_year', true );

// Handle form submission
if ( isset( $_POST['sac_submit'] ) ) {
    // Sanitize input data
    $new_service_title    = sanitize_text_field( $_POST['service_title'] );
    $new_is_available     = sanitize_text_field( $_POST['availability'] );
    $new_availability_month = '';
    $new_availability_year  = '';

    if ( 'yes' === $new_is_available && isset( $_POST['availability_month'], $_POST['availability_year'] ) ) {
        $new_availability_month = sanitize_text_field( $_POST['availability_month'] );
        $new_availability_year  = sanitize_text_field( $_POST['availability_year'] );
    }

    // Update post
    $update_result = wp_update_post( array(
        'ID'         => $availability_id,
        'post_title' => $new_service_title,
    ) );

    if ( ! is_wp_error( $update_result ) ) {
        // Update metadata
        update_post_meta( $availability_id, '_sac_is_available', $new_is_available );
        update_post_meta( $availability_id, '_sac_availability_month', $new_availability_month );
        update_post_meta( $availability_id, '_sac_availability_year', $new_availability_year );

        echo '<div class="notice notice-success is-dismissible"><p>Service Availability updated successfully!</p></div>';

        // Refresh data to show updated values in the form
        $service_title      = $new_service_title;
        $is_available       = $new_is_available;
        $availability_month = $new_availability_month;
        $availability_year  = $new_availability_year;
    } else {
        echo '<div class="notice notice-error is-dismissible"><p>There was an error updating the service availability.</p></div>';
    }
}
?>

<div class="wrap">
    <h2><?php esc_html_e( 'Edit Service Availability', 'service-availability-calendar' ); ?></h2>
    <form method="post" action="">
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><?php esc_html_e( 'Service Title', 'service-availability-calendar' ); ?></th>
                <td><input type="text" name="service_title" class="regular-text" value="<?php echo esc_attr( $service_title ); ?>" required></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php esc_html_e( 'Availability', 'service-availability-calendar' ); ?></th>
                <td>
                    <select name="availability" id="availability">
                        <option value="no" <?php selected( $is_available, 'no' ); ?>><?php esc_html_e( 'No', 'service-availability-calendar' ); ?></option>
                        <option value="yes" <?php selected( $is_available, 'yes' ); ?>><?php esc_html_e( 'Yes', 'service-availability-calendar' ); ?></option>
                    </select>
                </td>
            </tr>
            <tr valign="top" id="availability_details" style="<?php echo ( 'yes' === $is_available ) ? '' : 'display: none;'; ?>">
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
                            echo '<option value="' . esc_attr( $value ) . '" ' . selected( $availability_month, $value ) . '>' . esc_html( $label ) . '</option>';
                        }
                        ?>
                    </select>
                    <select name="availability_year">
                        <option value=""><?php esc_html_e( 'Select Year', 'service-availability-calendar' ); ?></option>
                        <?php
                        $current_year = date( 'Y' );
                        for ( $i = $current_year; $i <= $current_year + 5; $i++ ) {
                            echo '<option value="' . esc_attr( $i ) . '" ' . selected( $availability_year, $i ) . '>' . esc_html( $i ) . '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
        </table>
        <?php submit_button( __( 'Update Availability', 'service-availability-calendar' ), 'primary', 'sac_submit' ); ?>
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
        }).change(); // Trigger on page load to set initial visibility
    });
</script>