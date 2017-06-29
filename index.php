<?php
/*
  Plugin Name: Social Accounts
  Plugin URI: https://rich-97.github.io/wp-social-account
  Description: A plugin for share the social account
  Version: 1.0.0
  License: GPL2
  Author: Ricardo Moreno
  Author URI: https://rich-97.github.io/aboutme
*/

require 'options_page.php';
require 'shortcodes.php';

// Shortcodes.
add_shortcode('social', 'social_accounts');

if (is_admin()) {
  new options_page();
}
?>