<?php
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

$availabilities = get_posts(
	array(
		'post_type'  => 'service_availability',
		'numberposts' => -1, // Get all posts
	)
);

// Handle Deletion
if ( isset( $_POST['delete_availability'] ) && isset( $_POST['sac_delete_nonce'] ) && isset( $_POST['delete_availability_id'] ) ) {
    $delete_id = absint( $_POST['delete_availability_id'] );

    // Verify nonce to ensure the request is valid
    if ( ! wp_verify_nonce( $_POST['sac_delete_nonce'], 'delete_availability_' . $delete_id ) ) {
        die( 'Invalid request' );
    }

    // Check if the user has permission to delete the post
    if ( current_user_can( 'delete_posts' ) ) {
        // Delete the post
        wp_delete_post( $delete_id, true ); // Force deletion without moving to trash
        // Optional: Redirect to avoid resubmitting the form on refresh
        wp_redirect( admin_url( 'admin.php?page=service-availability' ) );
        exit;
    } else {
        echo 'You do not have permission to delete this post.';
    }
}


?>

<div class="wrap">
	<h2><?php esc_html_e( 'All Service Availabilities', 'service-availability-calendar' ); ?></h2>
	<?php if ( ! empty( $availabilities ) ) : ?>
		<div class="table-responsive">
		<table class="wp-list-table widefat fixed striped">
			<thead>
				<tr>
					<th><?php esc_html_e( 'Service Title', 'service-availability-calendar' ); ?></th>
					<th><?php esc_html_e( 'Availability', 'service-availability-calendar' ); ?></th>
					<th><?php esc_html_e( 'Month', 'service-availability-calendar' ); ?></th>
					<th><?php esc_html_e( 'Year', 'service-availability-calendar' ); ?></th>
					<th><?php esc_html_e( 'Shortcode', 'service-availability-calendar' ); ?></th>
					<th><?php esc_html_e( 'Actions', 'service-availability-calendar' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $availabilities as $availability ) :
					$is_available = get_post_meta( $availability->ID, '_sac_is_available', true );
					$month        = get_post_meta( $availability->ID, '_sac_availability_month', true );
					$year         = get_post_meta( $availability->ID, '_sac_availability_year', true );
					?>
					<tr>
						<td><?php echo esc_html( $availability->post_title ); ?></td>
						<td><?php echo 'yes' === $is_available ? esc_html__( 'Yes', 'service-availability-calendar' ) : esc_html__( 'No', 'service-availability-calendar' ); ?></td>
						<td><?php echo esc_html( $month ? date( 'F', mktime( 0, 0, 0, $month, 1 ) ) : '-' ); ?></td>
						<td><?php echo esc_html( $year ? $year : '-' ); ?></td>
						<td><code>[service_availability id="<?php echo esc_attr( $availability->ID ); ?>"]</code></td>
						<td class="action-button">
							<a href="<?php echo esc_url( admin_url( 'admin.php?page=edit-service-availability&id=' . $availability->ID ) ); ?>" class="button button-primary"><?php esc_html_e( 'Edit', 'service-availability-calendar' ); ?></a>

							<!-- Custom Delete Button with Nonce -->
							<form method="post" action="">
								<?php wp_nonce_field( 'delete_availability_' . $availability->ID, 'sac_delete_nonce' ); ?>
								<input type="hidden" name="delete_availability_id" value="<?php echo esc_attr( $availability->ID ); ?>">
								<input type="submit" name="delete_availability" value="<?php esc_html_e( 'Delete', 'service-availability-calendar' ); ?>" class="button button-danger" onclick="return confirm('<?php esc_html_e( 'Are you sure you want to delete this availability?', 'service-availability-calendar' ); ?>')" />
							</form>
						</td>

					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		</div>
	<?php else : ?>
		<p><?php esc_html_e( 'No service availabilities found.', 'service-availability-calendar' ); ?></p>
	<?php endif; ?>
</div>