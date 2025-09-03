<?php
/**
 * Plugin Name: TG Menu Manager
 * Plugin URI: https://example.com
 * Description: Manage classic WordPress menus based on taxonomy terms and nav_menu_item posts.
 * Version: 1.0.0
 * Author: Tech Guru
 * Author URI: https://example.com
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: tg-menu-manager
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once plugin_dir_path( __FILE__ ) . 'tg_menu_manager.php';
