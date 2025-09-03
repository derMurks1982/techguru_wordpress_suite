<?php
/**
 * Main logic for the TG Menu Manager plugin.
 *
 * Handles classic WordPress menu (nav_menu taxonomy and nav_menu_item post type)
 * creation using a simple admin interface.
 *
 * @package TG_Menu_Manager
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * TG_Menu_Manager class.
 */
class TG_Menu_Manager {
    /**
     * Constructor. Hooks into admin_menu.
     */
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'register_admin_page' ) );
    }

    /**
     * Register a custom admin page for managing menus.
     */
    public function register_admin_page() {
        add_menu_page(
            __( 'TG Menu Manager', 'tg-menu-manager' ),
            __( 'TG Menu Manager', 'tg-menu-manager' ),
            'manage_options',
            'tg-menu-manager',
            array( $this, 'render_admin_page' ),
            'dashicons-menu',
            65
        );
    }

    /**
     * Render the admin page content.
     */
    public function render_admin_page() {
        if ( isset( $_POST['tg_new_menu'] ) && check_admin_referer( 'tg_create_menu', 'tg_menu_nonce' ) ) {
            $menu_name = sanitize_text_field( wp_unslash( $_POST['tg_new_menu'] ) );
            if ( ! empty( $menu_name ) ) {
                wp_create_nav_menu( $menu_name );
                echo '<div class="updated"><p>' . esc_html__( 'Menu created.', 'tg-menu-manager' ) . '</p></div>';
            }
        }

        $menus = wp_get_nav_menus();

        echo '<div class="wrap">';
        echo '<h1>' . esc_html__( 'TG Menu Manager', 'tg-menu-manager' ) . '</h1>';
        echo '<form method="post">';
        wp_nonce_field( 'tg_create_menu', 'tg_menu_nonce' );
        echo '<p><input type="text" name="tg_new_menu" placeholder="' . esc_attr__( 'New menu name', 'tg-menu-manager' ) . '" /></p>';
        submit_button( __( 'Create Menu', 'tg-menu-manager' ) );
        echo '</form>';

        if ( ! empty( $menus ) ) {
            echo '<h2>' . esc_html__( 'Existing Menus', 'tg-menu-manager' ) . '</h2><ul>';
            foreach ( $menus as $menu ) {
                echo '<li>' . esc_html( $menu->name ) . '</li>';
            }
            echo '</ul>';
        }
        echo '</div>';
    }
}

new TG_Menu_Manager();
