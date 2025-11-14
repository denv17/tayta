<?php

namespace App\Core;

/**
 * Custom Walker for WordPress menus with Tailwind CSS classes
 */
class MenuWalker extends \Walker_Nav_Menu
{
  /**
   * Start the element output.
   */
  public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
  {
    $classes = empty($item->classes) ? [] : (array) $item->classes;

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
    $atts['class'] = 'text-white hover:text-blue transition-colors duration-300 text-2xl font-bold uppercase';

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
