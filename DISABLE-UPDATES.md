# Disable Automatic Updates

This theme automatically disables plugin and theme auto-updates and hides update notifications.

## What's Disabled

The `src/Core/DisableUpdates.php` class disables:

- Plugin auto-updates
- Theme auto-updates
- Update notifications

## Optional: Disable Core Updates

To also disable WordPress core updates, add this to `wp-config.php` before `/* That's all, stop editing! */`:

```php
define('AUTOMATIC_UPDATER_DISABLED', true);
define('WP_AUTO_UPDATE_CORE', false);
```

## Re-enable Auto-Updates

To re-enable auto-updates, comment out this line in `src/TaytaStarter.php`:

```php
// new DisableUpdates();
```
