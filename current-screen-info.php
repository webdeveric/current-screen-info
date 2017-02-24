<?php
/*
Plugin Name: Current Screen Info
Description: Add debugging info about the current screen to the help tab
Version: 0.1.0
Author: Eric King
Author URI: http://webdeveric.com/
*/

namespace webdeveric\CurrentScreenInfo;

function enqueueStyles()
{
    \wp_enqueue_style( 'current-screen-info', plugins_url( 'current-screen-info.css', __FILE__ ) );
}

add_action('admin_print_styles', __NAMESPACE__ . '\enqueueStyles' );

add_action('current_screen', function() {
    $screen = \get_current_screen();

    if ( $screen ) {
        $screen->add_help_tab([
            'id' => 'current-screen-info',
            'title' => 'Current Screen Info',
            'callback' => function( $screen, $args ) {
                echo '<table class="wp-list-table widefat current-screen-info"><thead><tr><th>Property</th><th>Value</th></tr></thead><tbody>';
                foreach( get_object_vars( $screen ) as $key => $value ) {
                    if ( is_bool( $value ) ) {
                        $value = sprintf('<span class="boolean">%s</span>', $value ? 'true' : 'false' );
                    } elseif ( empty( $value ) ) {
                        $value = '<span class="empty">empty</span>';
                    }

                    printf('<tr><td>%s</td><td>%s</td></tr>', $key, $value );
                }
                echo '</tbody></table>';
            }
        ]);
    }
});
