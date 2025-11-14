<?php

/**
 * Assets Management - Enqueue scripts and styles
 * 
 * @package Tayta
 */

namespace App\Core;

class Assets
{
  public function __construct()
  {
    add_action('wp_enqueue_scripts', [$this, 'enqueueAssets']);
  }

  /**
   * Check if Vite dev server is running
   */
  private function isViteDevMode(): bool
  {
    // Simple check: try to connect to Vite dev server
    $ch = @curl_init('https://localhost:5173');
    if ($ch === false) {
      return false;
    }

    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $http_code > 0;
  }

  /**
   * Enqueue scripts and styles
   */
  public function enqueueAssets()
  {
    $theme_version = wp_get_theme()->get('Version');

    if ($this->isViteDevMode()) {
      // Development mode: Load from Vite dev server with HMR
      wp_enqueue_script('vite-client', 'https://localhost:5173/@vite/client', [], null, false);
      wp_enqueue_script('tayta-main', 'https://localhost:5173/src/js/main.js', ['vite-client'], null, false);

      // Add type="module" to scripts using filter
      add_filter('script_loader_tag', function ($tag, $handle) {
        if (in_array($handle, ['vite-client', 'tayta-main'])) {
          return str_replace('<script ', '<script type="module" ', $tag);
        }
        return $tag;
      }, 10, 2);
    } else {
      // Production mode: Load compiled assets
      wp_enqueue_style('tayta-styles', get_template_directory_uri() . '/public/bundle.css', [], $theme_version);
      wp_enqueue_script('tayta-scripts', get_template_directory_uri() . '/public/app.js', [], $theme_version, true);
    }
  }
}
