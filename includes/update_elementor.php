<?php

// Přidání funkce, která přidá tlačítko Aktualizovat Elementor do admin baru
function add_aktualizovat_button($wp_admin_bar)
{
  // Tlačítko se ukáže jen pro administrátory
  if (! current_user_can('manage_options')) {
    return;
  }

  // Přidání tlačítka Aktualizovat Elementor do admin baru
  $wp_admin_bar->add_node(array(
    'id'    => 'aktualizovat_button',
    'title' => 'Aktualizovat Elementor',  // Název tlačítka
    'href'  => wp_nonce_url(admin_url('admin-post.php?action=refresh_permalinks'), 'refresh_permalinks'),
    'meta'  => array(
      'title' => __('Aktualizuje Elementor'), // Tooltip
    ),
  ));
}
add_action('admin_bar_menu', 'add_aktualizovat_button', 100);

// Funkce, která obnoví wordpress permalinky
function refresh_permalinks()
{
  // Bezpečnostní opatření
  check_admin_referer('refresh_permalinks');

  // Flush permalinks
  flush_rewrite_rules();

  // Přesměrování zpět s úspěšnou zprávou
  wp_redirect(add_query_arg('updated', 'true', wp_get_referer()));
  exit;
}
add_action('admin_post_refresh_permalinks', 'refresh_permalinks');

// Funkce, která ukáže úspěšnou správu v administraci webu
function show_permalinks_updated_notice()
{
  if (isset($_GET['updated']) && $_GET['updated'] == 'true') {
    echo '<div class="notice notice-success is-dismissible">
                 <p>' . __('Trvalé odkazy byly úspěšně aktualizovány!') . '</p>
             </div>';
  }
}
add_action('admin_notices', 'show_permalinks_updated_notice');
?>