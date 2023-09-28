<?php
/**
 * Plugin Name:       WPForms Conversational Forms
 * Plugin URI:        https://wpforms.com
 * Description:       Create Conversational Forms with WPForms.
 * Requires at least: 5.2
 * Requires PHP:      5.6
 * Author:            WPForms
 * Author URI:        https://wpforms.com
 * Version:           1.10.0
 * Text Domain:       wpforms-conversational-forms
 * Domain Path:       languages
 *
 * WPForms is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * WPForms is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with WPForms. If not, see <https://www.gnu.org/licenses/>.
 */

use WPFormsConversationalForms\Loader;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin version.
 *
 * @since 1.0.0
 */
define( 'WPFORMS_CONVERSATIONAL_FORMS_VERSION', '1.10.0' );

/**
 * Plugin main file.
 *
 * @since 1.7.0
 */
define( 'WPFORMS_CONVERSATIONAL_FORMS_FILE', __FILE__ );

/**
 * Check addon requirements.
 *
 * @since 1.7.0
 */
function wpforms_conversational_forms_required() {

	/**
	 * Require PHP 5.6+.
	 */
	if ( PHP_VERSION_ID < 50600 ) {
		add_action( 'admin_init', 'wpforms_conversational_forms_deactivate' );
		add_action( 'admin_notices', 'wpforms_conversational_forms_deactivate_msg' );

	} elseif (
		! function_exists( 'wpforms' ) ||
		version_compare( wpforms()->version, '1.7.5', '<' )
	) {
		add_action( 'admin_init', 'wpforms_conversational_forms_deactivate' );
		add_action( 'admin_notices', 'wpforms_conversational_forms_fail_wpforms_version' );

	} else {
		wpforms_conversational_forms();
	}
}

add_action( 'wpforms_loaded', 'wpforms_conversational_forms_required' );

/**
 * Deactivate plugin.
 *
 * @since 1.0.0
 */
function wpforms_conversational_forms_deactivate() {

	deactivate_plugins( plugin_basename( __FILE__ ) );
}

/**
 * Display notice after deactivation.
 *
 * @since 1.0.0
 */
function wpforms_conversational_forms_deactivate_msg() {

	echo '<div class="notice notice-error"><p>';
	printf(
		wp_kses( /* translators: %s - WPForms.com documentation page URL. */
			__( 'The WPForms Conversational Forms plugin has been deactivated. Your site is running an outdated version of PHP that is no longer supported and is not compatible with the Conversational Forms addon. <a href="%s" target="_blank" rel="noopener noreferrer">Read more</a> for additional information.', 'wpforms-conversational-forms' ),
			[
				'a' => [
					'href'   => [],
					'rel'    => [],
					'target' => [],
				],
			]
		),
		'https://wpforms.com/docs/supported-php-version/'
	);
	echo '</p></div>';

	// phpcs:disable WordPress.Security.NonceVerification.Recommended
	if ( isset( $_GET['activate'] ) ) {
		unset( $_GET['activate'] );
	}
	// phpcs:enable WordPress.Security.NonceVerification.Recommended
}

/**
 * Admin notice for minimum WPForms version.
 *
 * @since 1.7.0
 */
function wpforms_conversational_forms_fail_wpforms_version() {

	echo '<div class="notice notice-error"><p>';
	// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
	printf( /* translators: Minimum required WPForms version. */
		esc_html__( 'The WPForms Conversational Forms plugin has been deactivated because it requires WPForms v%s or later to work.', 'wpforms-conversational-forms' ),
		'1.7.5'
	);
	// phpcs:enable WordPress.Security.EscapeOutput.OutputNotEscaped
	echo '</p></div>';

	// phpcs:disable WordPress.Security.NonceVerification.Recommended
	if ( isset( $_GET['activate'] ) ) {
		unset( $_GET['activate'] );
	}
	// phpcs:enable WordPress.Security.NonceVerification.Recommended
}

/**
 * Get the instance of the plugin main class,
 * which actually loads all the code.
 *
 * @since 1.0.0
 *
 * @return Loader
 */
function wpforms_conversational_forms() {

	require_once __DIR__ . '/vendor/autoload.php';

	return Loader::get_instance();
}
