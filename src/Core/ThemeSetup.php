<?php

/**
 * Theme Setup - Register theme supports and menus
 * 
 * @package Tayta
 */

namespace App\Core;

class ThemeSetup
{
  public function __construct()
  {
    add_action('after_setup_theme', [$this, 'setup']);
  }

  /**
   * Theme setup
   */
  public function setup()
  {
    // Add support for site title
    add_theme_support('title-tag');

    // Add support for featured images
    add_theme_support('post-thumbnails');

    // Add support for HTML5
    add_theme_support('html5', [
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    ]);

    // Register navigation menus
    register_nav_menus([
      'primary' => __('Primary Menu', 'tayta'),
      'footer' => __('Footer Menu', 'tayta'),
    ]);
  }
}
