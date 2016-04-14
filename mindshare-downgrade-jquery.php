<?php
/*
Plugin Name: Downgrade jQuery Fix for WordPress 4.5
Plugin URI: https://mindsharelabs.com/
Description: Downgrade jQuery Fix for WordPress 4.5
Version: 0.2
Author: Mindshare Labs, Inc.
Author URI: https://mind.sh/are/
License: GNU General Public License
License URI: https://www.gnu.org/licenses/gpl-3.0.txt
*/

/**
 *
 * Copyright 2016 Mindshare Studios, Inc. (https://mind.sh/are/)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 3, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 */

// deny direct access
if (!function_exists('add_action')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}

if (!defined('MINDSHARE_DOWNGRADE_JQUERY_MIN_WP_VERSION')) {
	define('MINDSHARE_DOWNGRADE_JQUERY_MIN_WP_VERSION', '4.5');
}

if (!defined('MINDSHARE_DOWNGRADE_JQUERY_VERSION')) {
	define('MINDSHARE_DOWNGRADE_JQUERY_VERSION', '1.11.3');
}

// check WordPress version
global $wp_version;
if (version_compare($wp_version, MINDSHARE_DOWNGRADE_JQUERY_MIN_WP_VERSION, "<")) {
	exit('Downgrade jQuery Fix requires WordPress ' . MINDSHARE_DOWNGRADE_JQUERY_MIN_WP_VERSION . ' or newer.');
}

function mindshare_fix_jquery_wp45() {

	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', '//code.jquery.com/jquery-' . MINDSHARE_DOWNGRADE_JQUERY_VERSION . '.min.js', FALSE, MINDSHARE_DOWNGRADE_JQUERY_VERSION, FALSE);
		//wp_enqueue_script('jquery');

		wp_deregister_script('jquery-migrate');
		wp_register_script('jquery-migrate', '//code.jquery.com/jquery-migrate-1.2.1.min.js', array('jquery'), '1.2.1', FALSE);
		//wp_enqueue_script('jquery-migrate');
	}

}

add_action('wp_enqueue_scripts', 'mindshare_fix_jquery_wp45');
