<?php

/**
 * WP Bootstrap Navwalker
 *
 * @package WP-Bootstrap-Navwalker
 */

/* Check if Class Exists. */
if (!class_exists('WP_Bootstrap_Navwalker')) {

    /**
     * WP_Bootstrap_Navwalker class.
     *
     * @extends Walker_Nav_Menu
     */
    class WP_Bootstrap_Navwalker extends Walker_Nav_Menu
    {

        /**
         * Start Level.
         *
         * @see Walker::start_lvl()
         *
         * @param mixed $output Passed by reference. Used to append additional content.
         * @param int   $depth (default: 0) Depth of page. Used for padding.
         * @param array $args (default: array()) Arguments.
         * @return void
         */
        public function start_lvl(&$output, $depth = 0, $args = array())
        {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
        }

        /**
         * Start El.
         *
         * @see Walker::start_el()
         *
         * @param mixed $output Passed by reference. Used to append additional content.
         * @param mixed $item Menu item data object.
         * @param int   $depth (default: 0) Depth of menu item. Used for padding.
         * @param array $args (default: array()) Arguments.
         * @param int   $id (default: 0) Menu item ID.
         * @return void
         */
        public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
        {
            $indent = ($depth) ? str_repeat("\t", $depth) : '';

            $classes = empty($item->classes) ? array() : (array) $item->classes;
            $classes[] = 'nav-item menu-item-' . $item->ID;

            if ($args->walker->has_children) {
                $classes[] = 'dropdown';
            }

            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
            $class_names = ' class="' . esc_attr($class_names) . '"';

            $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
            $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

            $output .= $indent . '<li' . $id . $class_names . '>';

            $atts = array();
            $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
            $atts['target'] = !empty($item->target) ? $item->target : '';
            $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';

            if ($args->walker->has_children) {
                $atts['href'] = '#';
                $atts['data-toggle'] = 'dropdown';
                $atts['aria-haspopup'] = 'true';
                $atts['aria-expanded'] = 'false';
                $atts['class'] = 'nav-link dropdown-toggle';
                $atts['id'] = 'navbarDropdown';
                $atts['role'] = 'button';
            } else {
                $atts['href'] = !empty($item->url) ? $item->url : '';
                $atts['class'] = 'nav-link';
            }

            $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);

            $attributes = '';
            foreach ($atts as $attr => $value) {
                if (!empty($value)) {
                    $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        }

        /**
         * Display element.
         *
         * @see Walker::display_element()
         *
         * @param mixed $element Data object.
         * @param mixed $children_elements List of elements.
         * @param int   $max_depth Max depth to traverse.
         * @param int   $depth Depth of current element.
         * @param array $args Arguments.
         * @param mixed $output Passed by reference. Used to append additional content.
         * @return void
         */
        public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
        {
            if (!$element) {
                return;
            }

            $id_field = $this->db_fields['id'];

            // Display this element.
            if (is_object($args[0])) {
                $args[0]->has_children = !empty($children_elements[$element->$id_field]);
            }

            parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
        }

        /**
         * Menu Fallback.
         *
         * If this function is assigned to the wp_nav_menu's fallback_cb variable
         * and the menu doesn't exist, the function will display nothing to a non-logged-in user.
         * However, if a logged-in user views the site, they'll see a message like this:
         *
         *     "Add a menu."
         *
         * @param array $args passed from the wp_nav_menu function.
         */
        public static function fallback($args)
        {
            if (current_user_can('edit_theme_options')) {

                /* Get Arguments. */
                $container = $args['container'];
                $container_id = $args['container_id'];
                $container_class = $args['container_class'];
                $menu_class = $args['menu_class'];
                $menu_id = $args['menu_id'];

                // Initialize var to store fallback html.
                $fallback_output = '';

                if ($container) {
                    $fallback_output = '<' . esc_attr($container);
                    if ($container_id) {
                        $fallback_output .= ' id="' . esc_attr($container_id) . '"';
                    }
                    if ($container_class) {
                        $fallback_output .= ' class="' . esc_attr($container_class) . '"';
                    }
                    $fallback_output .= '>';
                }

                $fallback_output .= '<ul';
                if ($menu_id) {
                    $fallback_output .= ' id="' . esc_attr($menu_id) . '"';
                }
                if ($menu_class) {
                    $fallback_output .= ' class="' . esc_attr($menu_class) . '"';
                }
                $fallback_output .= '>';
                $fallback_output .= '<li class="nav-item"><a href="' . esc_url(admin_url('nav-menus.php')) . '" class="nav-link">Add a menu</a></li>';
                $fallback_output .= '</ul>';

                if ($container) {
                    $fallback_output .= '</' . esc_attr($container) . '>';
                }

                // If $args has 'echo' key and it's true echo, otherwise return.
                if (array_key_exists('echo', $args) && $args['echo']) {
                    echo $fallback_output; // WPCS: XSS OK.
                } else {
                    return $fallback_output;
                }
            }
        }
    }
}
