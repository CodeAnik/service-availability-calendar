<?php

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

class SAC_Public {

	public function __construct() {
		add_action( 'sac_service_availability_saved', array( $this, 'handle_service_availability_saved' ), 10, 4 );
		add_shortcode( 'service_availability', array( $this, 'service_availability_shortcode' ) );
	}

	public function handle_service_availability_saved( $post_id, $is_available, $month, $year ) {
		// No need to create a new post. Just update the existing post meta.
		// The shortcode function will fetch the post meta.
	}

	public function service_availability_shortcode( $atts ) {
		$atts = shortcode_atts(
			array(
				'id' => 0,
			),
			$atts,
			'service_availability'
		);

		$post_id = intval( $atts['id'] );

		if ( ! $post_id ) {
			return esc_html__( 'Invalid Service Availability ID', 'service-availability-calendar' );
		}

		$is_available = get_post_meta( $post_id, '_sac_is_available', true );
		$month        = get_post_meta( $post_id, '_sac_availability_month', true );
		$year         = get_post_meta( $post_id, '_sac_availability_year', true );

		if ( 'yes' === $is_available && $month && $year ) {
			$month_name = date( 'F', mktime( 0, 0, 0, $month, 1 ) );
			return sprintf( __( 'Available from %s, %s', 'service-availability-calendar' ), $month_name, $year );
		} else {
			return esc_html__( 'Not Available', 'service-availability-calendar' );
		}
	}

}
