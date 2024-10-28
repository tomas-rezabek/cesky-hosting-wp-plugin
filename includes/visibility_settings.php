<?php
// Function to create the new settings page
function custom_admin_section_visibility_page()
{
    add_menu_page(
        'ČH - Administrace - Zobrazení sekcí',   // Page title
        'ČH - Administrace',                      // Menu title
        'manage_options',                         // Capability
        'admin-sections-visibility',              // Menu slug
        'custom_admin_section_visibility_page_content', // Function to display content
        'dashicons-visibility',                   // Icon
        9                                        // Position in the menu
    );
}

add_action('admin_menu', 'custom_admin_section_visibility_page');

// Function to render the settings page content
function custom_admin_section_visibility_page_content()
{
?>
    <div class="wrap">
        <img src="https://www.cesky-hosting.cz/obj/files/2/sys_media_960.svg">
        <h1>Administrace - Zobrazení sekcí</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('section_visibility_settings'); // Security nonce
            do_settings_sections('admin-sections-visibility'); // Section with fields
            submit_button();
            ?>
        </form>
    </div>
<?php
}

// Register the settings, section, and fields
function custom_register_admin_section_visibility_settings()
{
    // Register a new setting to store visibility preferences
    register_setting('section_visibility_settings', 'hidden_admin_sections', array(
        'type' => 'array', // Ensure it is stored as an array
        'sanitize_callback' => 'custom_sanitize_hidden_sections', // Optional: Sanitize the input
        'default' => array() // Default value is an empty array
    ));

    // Add a section to the settings page
    add_settings_section(
        'admin_section_visibility',      // ID
        'Vyberte sekce, které chce skrýt', // Title
        null,                            // Callback (can be null if not needed)
        'admin-sections-visibility'      // Page slug (matches menu slug)
    );

    // Add individual fields for each section to hide
    add_settings_field(
        'hide_posts',                    // Field ID
        'Schovat Příspěvky',             // Label
        'custom_section_visibility_checkbox', // Callback to display the checkbox
        'admin-sections-visibility',     // Page slug
        'admin_section_visibility',      // Section ID
        array('section' => 'posts')      // Argument to identify this field
    );

    add_settings_field(
        'hide_comments',                 // Field ID
        'Schovat Komentáře',             // Label
        'custom_section_visibility_checkbox', // Callback to display the checkbox
        'admin-sections-visibility',     // Page slug
        'admin_section_visibility',      // Section ID
        array('section' => 'comments')   // Argument to identify this field
    );

    add_settings_field(
        'hide_astra',                   // Field ID
        'Schovat Astra šablonu',        // Label
        'custom_section_visibility_checkbox', // Callback to display the checkbox
        'admin-sections-visibility',     // Page slug
        'admin_section_visibility',      // Section ID
        array('section' => 'astra')      // Argument to identify this field
    );

    add_settings_field(
        'hide_elementor',        // Field ID
        'Schovat Elementor',               // Label
        'custom_section_visibility_checkbox', // Callback to display the checkbox
        'admin-sections-visibility',     // Page slug
        'admin_section_visibility',      // Section ID
        array('section' => 'elementor') // Argument to identify this field
    );

    add_settings_field(
        'hide_elementor_library',        // Field ID
        'Schovat Šablony',               // Label
        'custom_section_visibility_checkbox', // Callback to display the checkbox
        'admin-sections-visibility',     // Page slug
        'admin_section_visibility',      // Section ID
        array('section' => 'elementor_library') // Argument to identify this field
    );

    add_settings_field(
        'hide_theme-editor',        // Field ID
        'Schovat Editor Šablony',               // Label
        'custom_section_visibility_checkbox', // Callback to display the checkbox
        'admin-sections-visibility',     // Page slug
        'admin_section_visibility',      // Section ID
        array('section' => 'theme-editor') // Argument to identify this field
    );
    add_settings_field(
        'hide_widgets',        // Field ID
        'Schovat Widgets',               // Label
        'custom_section_visibility_checkbox', // Callback to display the checkbox
        'admin-sections-visibility',     // Page slug
        'admin_section_visibility',      // Section ID
        array('section' => 'widgets') // Argument to identify this field
    );
    add_settings_field(
        'hide_plugin-editor',        // Field ID
        'Schovat Plugin Editor',               // Label
        'custom_section_visibility_checkbox', // Callback to display the checkbox
        'admin-sections-visibility',     // Page slug
        'admin_section_visibility',      // Section ID
        array('section' => 'plugin-editor') // Argument to identify this field
    );
}

// Callback function to display checkboxes for each section
function custom_section_visibility_checkbox($args)
{
    // Get the saved settings from the options
    $hidden_sections = get_option('hidden_admin_sections', array());

    // Make sure $hidden_sections is an array
    if (!is_array($hidden_sections)) {
        $hidden_sections = array(); // Reset to an empty array if not
    }

    // Determine if the current section is checked
    $checked = in_array($args['section'], $hidden_sections) ? 'checked' : '';

    // Output the checkbox
    echo '<input type="checkbox" name="hidden_admin_sections[]" value="' . esc_attr($args['section']) . '" ' . $checked . ' />';
}

// Optional: Sanitize the input to ensure it's an array
function custom_sanitize_hidden_sections($input)
{
    return is_array($input) ? array_map('sanitize_text_field', $input) : array();
}

// Function to hide selected sections from the admin menu
function custom_hide_admin_sections()
{
    // Get the saved settings from the options
    $hidden_sections = get_option('hidden_admin_sections', array());

    // Make sure $hidden_sections is an array
    if (!is_array($hidden_sections)) {
        $hidden_sections = array(); // Reset to an empty array if not
    }

    // Check if "posts" is selected to be hidden
    if (in_array('posts', $hidden_sections)) {
        remove_menu_page('edit.php'); // Hide the Posts section
    }

    // Check if "comments" is selected to be hidden
    if (in_array('comments', $hidden_sections)) {
        remove_menu_page('edit-comments.php'); // Hide the Comments section
    }

    // Check if "astra" is selected to be hidden
    if (in_array('astra', $hidden_sections)) {
        remove_menu_page('astra'); // Hide the Astra section
    }

    // Check if "elementor" is selected to be hidden
    if (in_array('elementor', $hidden_sections)) {
        remove_menu_page('elementor'); // Hide the Astra section
    }

    // Check if "elementor_library" is selected to be hidden
    if (in_array('elementor_library', $hidden_sections)) {
        remove_menu_page('edit.php?post_type=elementor_library'); // Hide the Elementor Library
    }

    // Check if "theme-editor" is selected to be hidden, its hiding submenu
    if (in_array('theme-editor', $hidden_sections)) {
        remove_submenu_page('themes.php', 'theme-editor.php'); // Hide the Theme Editor
    }

    // Check if "widgets" is selected to be hidden, its hiding submenu
    if (in_array('widgets', $hidden_sections)) {
        remove_submenu_page('themes.php', 'widgets.php'); // Hide the Widgets
    }

    // Check if "plugin-editor" is selected to be hidden, its hiding submenu
    if (in_array('plugin-editor', $hidden_sections)) {
        remove_submenu_page('plugins.php', 'plugin-editor.php'); // Hide the Plugin Editor
    }

    // You can add more sections here, like media, pages, etc.
    // remove_menu_page('upload.php'); // Hide Media
    // remove_menu_page('edit.php?post_type=page'); // Hide Pages
}
add_action('admin_init', 'custom_register_admin_section_visibility_settings');
add_action('admin_menu', 'custom_hide_admin_sections', 999);
?>