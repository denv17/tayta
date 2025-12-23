<?php

/**
 * Theme Options - ACF Options Page
 * 
 * @package Tayta
 */

namespace App\Features;

class ThemeOptions
{
  public function __construct()
  {
    add_action('acf/init', [$this, 'registerOptionsPage']);
    add_filter('timber/context', [$this, 'addOptionsToContext']);
    add_filter('acf/settings/save_json', [$this, 'setAcfJsonSavePath']);
    add_filter('acf/settings/load_json', [$this, 'setAcfJsonLoadPath']);
  }

  /**
   * Register ACF Options Page
   */
  public function registerOptionsPage()
  {
    if (function_exists('acf_add_options_page')) {
      acf_add_options_page([
        'page_title' => 'Theme Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-settings',
        'capability' => 'edit_posts',
        'icon_url' => 'dashicons-admin-generic',
        'position' => 60,
      ]);
    }
  }

  /**
   * Add options to Timber context
   */
  public function addOptionsToContext($context)
  {
    $context['options'] = get_fields('option');
    return $context;
  }

  /**
   * Set ACF JSON save path
   */
  public function setAcfJsonSavePath($path)
  {
    return get_stylesheet_directory() . '/acf-json';
  }

  /**
   * Set ACF JSON load paths
   */
  public function setAcfJsonLoadPath($paths)
  {
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
  }
}
