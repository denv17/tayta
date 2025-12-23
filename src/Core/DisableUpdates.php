<?php

namespace App\Core;

/**
 * Disable Automatic Updates
 * Prevents WordPress from auto-updating core, plugins, and themes
 */
class DisableUpdates
{
  public function __construct()
  {
    $this->disableAutoUpdates();
    $this->disableUpdateNotifications();
  }

  /**
   * Disable automatic updates for plugins and themes
   */
  private function disableAutoUpdates()
  {
    // Disable auto updates for plugins
    add_filter('auto_update_plugin', '__return_false');

    // Disable auto updates for themes
    add_filter('auto_update_theme', '__return_false');
  }

  /**
   * Hide update notifications (optional)
   * Useful if you want to keep everything "frozen"
   */
  private function disableUpdateNotifications()
  {
    // Hide plugin update notifications
    remove_action('load-update-core.php', 'wp_update_plugins');
    add_filter('pre_site_transient_update_plugins', '__return_null');

    // Hide theme update notifications
    remove_action('load-update-core.php', 'wp_update_themes');
    add_filter('pre_site_transient_update_themes', '__return_null');

    // Hide core update notifications
    add_filter('pre_site_transient_update_core', '__return_null');
  }
}
