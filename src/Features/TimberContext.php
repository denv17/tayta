<?php

/**
 * Timber Context - Add global context to Timber
 * 
 * @package Tayta
 */

namespace App\Features;

use Timber\Timber;
use App\Core\MenuWalker;

class TimberContext
{
  public function __construct()
  {
    add_filter('timber/context', [$this, 'addToContext']);
  }

  /**
   * Add global context to Timber
   */
  public function addToContext($context)
  {
    // Menus with custom walker
    $context['menu_primary'] = $this->getMenu('primary', [
      'menu_class' => 'flex flex-col lg:flex-row items-center gap-8 lg:gap-8',
    ]);

    $context['menu_footer'] = $this->getMenu('footer', [
      'menu_class' => 'grow flex flex-col lg:flex-row flex-wrap lg:justify-center gap-6 text-sm uppercase',
      'link_class' => 'text-white hover:text-orange whitespace-nowrap transition-colors duration-300',
    ]);

    // Site options
    $context['site'] = new \Timber\Site();

    return $context;
  }

  /**
   * Get menu with custom walker and Tailwind classes
   */
  private function getMenu($location, $args = [])
  {
    $defaults = [
      'theme_location' => $location,
      'container' => false,
      'walker' => new MenuWalker(),
      'echo' => false,
      'fallback_cb' => false,
    ];

    return wp_nav_menu(array_merge($defaults, $args));
  }
}
