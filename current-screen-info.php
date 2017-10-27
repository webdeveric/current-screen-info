<?php
/*
Plugin Name: Current Screen Info
Description: Add debugging info about the current screen to the help tab
Version: 0.2.0
Author: Eric King
Author URI: http://webdeveric.com/
*/

namespace webdeveric\CurrentScreenInfo;

const CURRENT_SCREEN_INFO_FILE = __FILE__;

include __DIR__ . '/src/functions.php';

\add_action('current_screen', __NAMESPACE__ . '\addHelpTab');
