<?php

// Schová tlačítko zpět do Wordpress Editoru
function hide_buttons()
{
  if (is_admin() || (is_user_logged_in() && current_user_can('administrator'))) {
    echo '<style>
            #elementor-switch-mode,
            #wp-admin-bar-new-content,
            #wp-admin-bar-comments,
            #wp-admin-bar-appearance,
            #wp-admin-bar-themes,
            #wp-admin-bar-widgets,
            #wp-admin-bar-elementor_app_site_editor,
            #wp-admin-bar-elementor_site_settings {
                display: none !important;
            }
        </style>';
  }
}

// Hook the function into both admin_head and wp_head
add_action('admin_head', 'hide_buttons'); // For admin area
add_action('wp_head', 'hide_buttons');    // For logged-in users on the front end

?>