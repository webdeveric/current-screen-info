<?php

namespace webdeveric\CurrentScreenInfo;

use WP_Screen;

function displayHelpTab( WP_Screen $screen, array $args )
{
    echo '<table class="wp-list-table striped current-screen-info"><thead><tr><th>Property</th><th>Value</th></tr></thead><tbody>';

    foreach( get_object_vars( $screen ) as $key => $value ) {
        if ( is_bool( $value ) ) {
            $value = sprintf('<span class="boolean">%s</span>', $value ? 'true' : 'false' );
        } elseif ( is_string( $value ) && empty( $value ) ) {
            $value = '<span class="empty">empty string</span>';
        }

        printf('<tr><td>$screen->%s</td><td>%s</td></tr>', $key, $value );
    }

    echo '</tbody></table>';
}

function addHelpTab()
{
    $screen = \get_current_screen();

    if ( $screen ) {
        \wp_enqueue_style( 'current-screen-info', plugins_url( 'assets/current-screen-info.css', CURRENT_SCREEN_INFO_FILE ) );

        $screen->add_help_tab([
            'id' => 'current-screen-info',
            'title' => 'Current Screen Info',
            'callback' => __NAMESPACE__ . '\displayHelpTab',
        ]);
    }
}
