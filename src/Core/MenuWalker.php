<?php

namespace App\Core;

/**
 * Custom Walker for WordPress menus with Tailwind CSS classes
 */
class MenuWalker extends \Walker_Nav_Menu
{
  private static $menu_items_cache = [];

  /**
   * Start the element output.
   */
  public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
  {
    $classes = empty($item->classes) ? [] : (array) $item->classes;

    // Get all menu items if not cached
    $menu_location = $args->theme_location ?? '';
    if ($menu_location && !isset(self::$menu_items_cache[$menu_location])) {
      $menu_items = wp_get_nav_menu_items($args->menu);
      self::$menu_items_cache[$menu_location] = $menu_items ?: [];
    }

    // Check if this is the last item
    $is_last_item = false;
    if (isset(self::$menu_items_cache[$menu_location]) && !empty(self::$menu_items_cache[$menu_location])) {
      $last_item = end(self::$menu_items_cache[$menu_location]);
      $is_last_item = ($item->ID === $last_item->ID);
    }

    // Add custom Tailwind classes to menu items
    $li_classes = [
      'group',
      'relative'
    ];

    $class_names = join(' ', array_filter(array_merge($li_classes, $classes)));
    $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

    $output .= '<li' . $class_names . '>';

    // Link attributes
    $atts = [];
    $atts['href'] = !empty($item->url) ? $item->url : '';

    // Default link classes (for primary menu)
    $default_classes = 'text-white hover:text-blue transition-colors duration-300 text-2xl font-bold uppercase';

    // Use custom link_class if provided in args, otherwise use default
    $atts['class'] = isset($args->link_class) ? $args->link_class : $default_classes;

    // Apply button styles to last item in header
    if ($is_last_item && $menu_location === 'primary') {
      $atts['class'] = 'inline-flex items-center justify-center gap-2 min-w-40 px-8 py-3 text-xl font-bold uppercase rounded-md transition-colors bg-blue text-white hover:bg-opacity-90';
    }

    // Apply bold to last item in footer
    if ($is_last_item && $menu_location === 'footer') {
      $atts['class'] .= ' font-bold';
    }

    // Active state
    if (in_array('current-menu-item', $classes)) {
      $atts['class'] .= ' text-blue';
    }

    // Add aria-current for accessibility
    if (in_array('current-menu-item', $classes)) {
      $atts['aria-current'] = 'page';
    }

    $attributes = '';
    foreach ($atts as $attr => $value) {
      if (!empty($value)) {
        $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
        $attributes .= ' ' . $attr . '="' . $value . '"';
      }
    }

    $item_output = $args->before ?? '';
    $item_output .= '<a' . $attributes . '>';
    $item_output .= ($args->link_before ?? '') . apply_filters('the_title', $item->title, $item->ID) . ($args->link_after ?? '');
    $item_output .= '</a>';
    $item_output .= $args->after ?? '';

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}
