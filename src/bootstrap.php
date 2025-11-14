<?php

/**
 * Bootstrap file - Initialize the theme
 * 
 * @package Tayta
 */

namespace App;

// Check if Timber is installed
if (!class_exists('Timber\Timber')) {
  add_action('admin_notices', function () {
    echo '<div class="error"><p>Timber is not activated. Make sure you install the Timber plugin or run composer install.</p></div>';
  });
  return;
}

// Initialize Timber
\Timber\Timber::$dirname = ['timber'];
\Timber\Timber::$autoescape = false;
