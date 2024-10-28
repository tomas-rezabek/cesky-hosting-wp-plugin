<?php

function custom_dashboard_setup()
{
  remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
  remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
  remove_meta_box('dashboard_primary', 'dashboard', 'side');
  remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
  remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
  remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
  remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
  remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
  remove_meta_box('dashboard_activity', 'dashboard', 'normal'); //since 3.8

  // Add your custom widget
  wp_add_dashboard_widget(
    'custom_dashboard_widget', // Widget slug
    'Český hosting - Nástěnka', // Název našeho widgetu
    'custom_dashboard_widget_content' // Funkce na zobrazení widgetu
  );
}

function custom_dashboard_widget_content()
{
  // Vlastní HTML widgetu
?>
  <div class="custom-widget">
    <h2>Nápověda Administrace</h2>
    <p>Níže jsou k dispozici odkazy pro rychlou editaci:</p>
    <ul>
      <li><a href="https://example.com/link1">Úprava názvu a popisu webu ...</a></li>
      <li><a href="https://example.com/link2">Odkaz 2</a></li>
      <li><a href="https://example.com/link3">Odkaz 3</a></li>
    </ul>
  </div>
  <style>
    #welcome-panel,
    #e-dashboard-overview {
      display: none;
    }

    .custom-widget {
      padding: 20px;
      border-radius: 10px;
      text-align: left;
    }

    .custom-widget h2 {
      color: #333;
    }

    .custom-widget a {
      color: #0073aa;
    }

    .custom-widget a:hover {
      color: #005177;
    }
  </style>
<?php
}

// Hook do wp_dashboard_setup na odstraneni nepotrebnych widgetu a pridani naseho
add_action('wp_dashboard_setup', 'custom_dashboard_setup');

?>