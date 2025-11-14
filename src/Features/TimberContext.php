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
    $context['menu_primary'] = $this->getMenu('primary');
    $context['menu_footer'] = Timber::get_menu('footer');

    // Site options
    $context['site'] = new \Timber\Site();

    return $context;
  }

  /**
   * Get menu with custom walker and Tailwind classes
   */
  private function getMenu($location)
  {
    return wp_nav_menu([
      'theme_location' => $location,
      'container' => false,
      'menu_class' => 'flex flex-col lg:flex-row items-center gap-8 lg:gap-8',
      'walker' => new MenuWalker(),
      'echo' => false,
      'fallback_cb' => false,
    ]);
  }
}
