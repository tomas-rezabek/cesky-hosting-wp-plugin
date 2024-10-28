<?php
/*
Plugin Name: Český hosting - Plugin pro šablony
Plugin URI: https://www.cesky-hosting.cz/
Description: Upravuje administraci webu
Version: 2.2.0
Author: Český hosting
Author URI: https://www.cesky-hosting.cz/
License: GPL2
*/

require_once plugin_dir_path(__FILE__) . 'includes/visibility_settings.php';  // Administrace webu
require_once plugin_dir_path(__FILE__) . 'includes/dashboard.php';  // Nástěnka
require_once plugin_dir_path(__FILE__) . 'includes/footer.php';  // Info ve footeru a logo v admin baru
require_once plugin_dir_path(__FILE__) . 'includes/update_elementor.php';  // Info ve footeru a logo v admin baru
require_once plugin_dir_path(__FILE__) . 'includes/disable_edit.php'; // Vypne odkazy pro editování bez Elementoru
require_once plugin_dir_path(__FILE__) . 'includes/disable_back_to_wp_editor.php'; // Vypne tlačítko zpět do WP editoru

?>