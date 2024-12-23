<?php

function webp_upload_mimes($existing_mimes)
{
    $existing_mimes['webp'] = 'image/webp';
    return $existing_mimes;
}
add_filter('mime_types', 'webp_upload_mimes');

function webp_is_displayable($result, $path)
{
    if ($result === false) {
        $displayable_image_types = array(IMAGETYPE_WEBP);
        $info = @getimagesize($path);

        if (empty($info)) {
            $result = false;
        } elseif (!in_array($info[2], $displayable_image_types)) {
            $result = false;
        } else {
            $result = true;
        }
    }

    return $result;
}
add_filter('file_is_displayable_image', 'webp_is_displayable', 10, 2);

function load_image($id, $class = null, $lazy = true)
{
    $image = '';
    if ($id != null) {
        $alt = get_post_meta($id, '_wp_attachment_image_alt', true);
        $metadata = get_post_meta($id, '_wp_attachment_metadata', true);
        $img_src = wp_get_attachment_image_url($id);
        $img_srcset = wp_get_attachment_image_srcset($id);
        $img_sizes = wp_get_attachment_image_sizes($id);
        $lazy_html = $lazy ? 'loading="lazy"' : '';

        // Check if the attachment is an SVG
        $attachment_mime_type = get_post_mime_type($id);

        if ($attachment_mime_type === 'image/svg+xml') {
            // Load SVG with the <svg> tag
            $image = load_image_svg($img_src);
        } else {
            $width = $metadata['width'] ?? '';
            $image = '<img class="' . $class . '" src="' . $img_src . '" width="' . $width . '" ' . $lazy_html . ' srcset="' . esc_attr($img_srcset) . '" alt="' . $alt . '">';
        }
    } else {
        $image = 'expected id given: ' . $id;
    }

    return $image;
}

function load_image_svg($img_src)
{
    $svg = file_get_contents($img_src);
    return $svg;
}

remove_filter('acf_the_content', 'wpautop');


function getSettingPageField($key)
{
    return get_field($key, 'option');
}

function display_custom_footer_menu()
{
    $menu_location = 'footer';
    $locations = get_nav_menu_locations();

    if (isset($locations[$menu_location])) {
        $menu_id = $locations[$menu_location];
        $menu_items = wp_get_nav_menu_items($menu_id);

        if ($menu_items) {
            $menu_items_by_parent = array();
            foreach ($menu_items as $item) {
                $menu_items_by_parent[$item->menu_item_parent][] = $item;
            }

            $parent_count = 0;

            function display_custom_menu_items($items, $menu_items_by_parent)
            {
                echo '<ul class="parent-menu p-0">';
                foreach ($items as $item) {
                    $has_children = !empty($menu_items_by_parent[$item->ID]);
                    echo '<li class="' . ($has_children ? 'parent-menu' : '') . '">';
                    echo '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';

                    // If the item has children, display them
                    if ($has_children) {
                        echo '<ul class="sub-menu p-0">';
                        display_custom_menu_items($menu_items_by_parent[$item->ID], $menu_items_by_parent);
                        echo '</ul>';
                    }

                    echo '</li>';
                }
                echo '</ul>';
            }

            // Loop through the top-level menu items
            if (isset($menu_items_by_parent[0])) {
                foreach ($menu_items_by_parent[0] as $parent_item) {
                    $parent_count++;

                    // Determine the column class based on the parent count
                    $col_class = ($parent_count === 1) ? 'col-md-2 col-12' : (($parent_count === 2) ? 'col-md-3 col-12' : '');

                    if ($col_class) {
                        echo '<div class="' . $col_class . '">';
                    }

                    // Display the menu item and its children
                    echo '<ul class="parent-menu">';
                    display_custom_menu_items([$parent_item], $menu_items_by_parent);
                    echo '</ul>';

                    if ($col_class) {
                        echo '</div>';
                    }

                    if ($parent_count >= 2) {
                        break;
                    }
                }
            }
        }
    }
}
