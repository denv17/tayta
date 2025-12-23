<?php

namespace App\Blocks;

/**
 * Blocks Manager
 * Registers ACF Blocks with Timber templates
 */
class BlocksManager
{
  private $blocks_dir;

  public function __construct()
  {
    $this->blocks_dir = get_template_directory() . '/blocks';

    add_action('acf/init', [$this, 'registerBlocks']);
    add_filter('acf/settings/save_json', [$this, 'setAcfJsonSavePath']);
    add_filter('acf/settings/load_json', [$this, 'setAcfJsonLoadPaths']);
  }

  /**
   * Register all ACF blocks
   * Automatically loads all blocks from blocks/ directory
   */
  public function registerBlocks()
  {
    if (!function_exists('acf_register_block_type')) {
      return;
    }

    // Auto-discover and register all blocks
    $blocks_path = $this->blocks_dir;

    if (!is_dir($blocks_path)) {
      return;
    }

    $block_folders = array_filter(glob($blocks_path . '/*'), 'is_dir');

    foreach ($block_folders as $block_folder) {
      $block_config_file = $block_folder . '/block.php';

      if (file_exists($block_config_file)) {
        $config = require $block_config_file;

        if (is_array($config) && isset($config['name'])) {
          $this->registerBlock($config['name'], $config);
        }
      }
    }
  }

  /**
   * Register a single block
   */
  private function registerBlock($name, $args = [])
  {
    $defaults = [
      'name' => $name,
      'render_callback' => [$this, 'renderBlock'],
      'mode' => 'preview',
      'supports' => [
        'align' => false,
        'mode' => true,
        'jsx' => true,
      ],
    ];

    $args = array_merge($defaults, $args);

    acf_register_block_type($args);
  }

  /**
   * Render block using Timber
   */
  public function renderBlock($block, $content = '', $is_preview = false, $post_id = 0)
  {
    $context = \Timber\Timber::context();

    // Add block data to context
    $context['block'] = $block;
    $context['fields'] = get_fields();
    $context['is_preview'] = $is_preview;

    // Get block slug (remove 'acf/' prefix)
    $slug = str_replace('acf/', '', $block['name']);

    // Render Timber template from blocks/[slug]/[slug].twig
    $template_path = "blocks/{$slug}/{$slug}.twig";

    // Check if template exists, fallback to old structure if needed
    $full_path = get_template_directory() . '/' . $template_path;
    if (!file_exists($full_path)) {
      $template_path = "blocks/{$slug}.twig";
    }

    \Timber\Timber::render($template_path, $context);
  }

  /**
   * Set ACF JSON save path (not used, but required by ACF)
   */
  public function setAcfJsonSavePath($path)
  {
    return get_template_directory() . '/blocks';
  }

  /**
   * Set ACF JSON load paths
   * Automatically loads field groups from each block's folder
   */
  public function setAcfJsonLoadPaths($paths)
  {
    // Remove default path
    unset($paths[0]);

    // Auto-discover all block folders
    $blocks_path = $this->blocks_dir;

    if (is_dir($blocks_path)) {
      $block_folders = array_filter(glob($blocks_path . '/*'), 'is_dir');

      foreach ($block_folders as $block_folder) {
        $paths[] = $block_folder;
      }
    }

    return $paths;
  }

  /**
   * Register custom block category
   */
  public static function registerBlockCategory($categories)
  {
    return array_merge(
      $categories,
      [
        [
          'slug' => 'tayta-blocks',
          'title' => __('Tayta Blocks'),
          'icon' => 'food',
        ],
      ]
    );
  }
}
