<?php
// Funkce pro úpravu footeru
function custom_admin_footer_text() {
    echo '<p>Web je hostován u <a href="https://www.cesky-hosting.cz/" target="_blank">Českého hostingu</a>.</p>';
}

function custom_admin_footer_filter() {
    add_filter('admin_footer_text', 'custom_admin_footer_text');
}
// Hook
add_action('admin_init', 'custom_admin_footer_filter');

function remove_wp_logo($wp_admin_bar)
{
  $wp_admin_bar->remove_node('wp-logo');
}
add_action('admin_bar_menu', 'remove_wp_logo', 100);

function add_ch_logo($wp_admin_bar)
{
  $args = array(
    'id'    => 'ch-logo',
    'title' => '<img src="https://www.cesky-hosting.cz/obj/files/2/sys_media_958-icon-32-32.png" alt="Český hosting" style="margin:0;display:block;"/>', // Add your custom logo here
    'href'  => 'https://www.cesky-hosting.cz', // Vlastní URL adresa
    'meta'  => array(
      'class' => 'ch-logo',
      'title' => 'Přejít na Český hosting', // Tooltip 
      'target' => '_blank'
    )
  );
  $wp_admin_bar->add_node($args);
}
add_action('admin_bar_menu', 'add_ch_logo', 1);

?>