=== Service Availability using Calendar ===
Contributors: (Your WordPress.org username(s))
Donate link: (Optional donation link)
Tags: availability, calendar, service, booking
Requires at least: 5.0
Tested up to: 6.4
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

This plugin allows you to manage and display the availability of your services using a simple calendar system.  You can add service availability entries, specify whether a service is available, and, if available, specify the month and year.  The plugin provides a shortcode to display the availability status on your website.

== Installation ==

1.  Upload the `service-availability-calendar` folder to the `/wp-content/plugins/` directory.
2.  Activate the plugin through the 'Plugins' menu in WordPress.
3.  A new menu item 'Service Availability' will appear in your WordPress admin dashboard.

== Usage ==

1.  Go to 'Service Availability' -> 'Add New' to add a new service availability entry.
2.  Enter the service title and select the availability status.
3.  If the service is available, select the month and year.
4.  Click 'Save Availability'.
5.  To display the availability status on a page or post, use the shortcode `[service_availability id="XXX"]`, where XXX is the ID of the service availability entry.  You can find the ID in the 'All Availability' section.

== Frequently Asked Questions ==

Q: How do I find the ID of a service availability entry?
A: Go to 'Service Availability' -> 'All Availability'. The ID is displayed in the table.

Q: Can I display the availability for multiple services on one page?
A: Yes, use the shortcode for each service availability entry, each with its own unique ID.

== Screenshots ==
1.  (Screenshot of the "Add New Service Availability" page)
2.  (Screenshot of the "All Service Availabilities" page)

== Changelog ==

= 1.0.0 =
* Initial release.

== Upgrade Notice ==

= 1.0.0 =
* Initial release.
