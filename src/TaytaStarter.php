<?php

/**
 * Main Theme Class
 * 
 * @package Tayta
 */

namespace App;

use App\Core\ThemeSetup;
use App\Core\Assets;
use App\Core\DisableUpdates;
use App\Features\TimberContext;
use App\Features\ThemeOptions;
use App\Blocks\BlocksManager;

class TaytaStarter
{
  public function __construct()
  {
    $this->init();
  }

  /**
   * Initialize theme components
   */
  private function init()
  {
    // Core functionality
    new ThemeSetup();
    new Assets();
    new DisableUpdates();

    // Features
    new TimberContext();
    new ThemeOptions();

    // Blocks
    new BlocksManager();

    // Register custom block category
    add_filter('block_categories_all', [BlocksManager::class, 'registerBlockCategory']);
  }
}
