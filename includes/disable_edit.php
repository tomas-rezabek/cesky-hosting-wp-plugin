<?php

// Funkce, která přesměřuje uživatele když kliknou na odkaz edit.php
function custom_redirect_on_edit_action()
{
  // Kontrola na jaké se nacházíme stránce
  if (is_admin() && isset($_GET['post'], $_GET['action']) && $_GET['action'] === 'edit') {

    // Zjištněí parametru akce z URL
    $action = $_GET['action'];

    // Kontrola zda je akce "edit" a nejedná se o "elementor"
    if ($action === 'edit' && (!isset($_GET['action']) || $_GET['action'] !== 'elementor')) {

      // Přesměrování na přehled stránek (edit.php?post_type=page)
      wp_redirect(admin_url('edit.php?post_type=page'));
      exit; // Ukončení dalšího přesměrování
    }
  }
}
add_action('admin_init', 'custom_redirect_on_edit_action');

// Odebrání Upravit odkazu z přehledu stránek
function remove_edit_link_from_pages($actions, $post)
{
  // Kontrola post type a pravomoce uživatele
  if ($post->post_type === 'page' && current_user_can('edit_pages')) {
    // Odstranění Edit odkazu
    unset($actions['edit']);
  }

  return $actions;
}
add_filter('page_row_actions', 'remove_edit_link_from_pages', 10, 2);

// Funkce která odebere tlačítka v admin baru
function remove_edit_page_button_from_admin_bar($wp_admin_bar)
{
  // Kontrola post type a pravomoce uživatele
  if (is_page() && current_user_can('edit_pages')) {
    // Odstranění Edit odkazu
    $wp_admin_bar->remove_node('edit'); // Upravit stránku
    $wp_admin_bar->remove_node('new-content'); // Akce
    $wp_admin_bar->remove_node('comments'); // Upravit komentáře
  }
}
add_action('admin_bar_menu', 'remove_edit_page_button_from_admin_bar', 999);


?>