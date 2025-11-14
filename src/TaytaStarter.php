<?php

/**
 * Main Theme Class
 * 
 * @package Tayta
 */

namespace App;

use App\Core\ThemeSetup;
use App\Core\Assets;
use App\Features\TimberContext;

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

    // Features
    new TimberContext();
  }
}
