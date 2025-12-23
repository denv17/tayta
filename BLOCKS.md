# ACF Blocks Guide

## Requirements

This theme requires **ACF PRO** to work with custom blocks.

1. Download ACF PRO from https://www.advancedcustomfields.com/
2. Install and activate the plugin
3. Field groups will auto-load from each block's folder

## Block Structure

Each block is self-contained in its own folder:

```
blocks/
  hero/
    hero.twig      # Template
    fields.json    # ACF field group
    block.php      # Block registration config
    README.md      # Documentation (optional)
```

## Using Blocks

1. Create or edit a page in WordPress
2. Click the "+" button to add a block
3. Look for **"Tayta Blocks"** category
4. Select a block
5. Fill in the ACF fields
6. Publish!

## Available Blocks

### Hero Block

Main landing section with title, description, CTA button, and image.

### Story Block

About/story section with chef photo, description, and optional CTA link.

### Food Slider Block

Image gallery/carousel for food photos.

### Bowl Builder Block

Interactive bowl creation form.

### Catering Block

Catering services section with background image and CTA button.

### Contact Block

Contact information and form.

### Newsletter Block

Email subscription form.

## Notes

- CTA fields use ACF's **Link** field type
- Link fields include URL, title, and target in one field
- You can select internal pages or add custom URLs

## Creating a New Block

1. Create a new folder in `blocks/` (e.g., `blocks/my-block/`)
2. Add three files:
   - `my-block.twig` - Template file
   - `block.php` - Registration config
   - `fields.json` - ACF field group (create via WordPress admin)
3. The block will auto-register on next page load

### Example `block.php`:

```php
<?php
return [
  'name' => 'my-block',
  'title' => __('My Block'),
  'description' => __('Block description'),
  'icon' => 'admin-appearance',
  'category' => 'tayta-blocks',
];
```

## Troubleshooting

**Blocks don't appear in Gutenberg?**

- Make sure ACF PRO is installed and activated
- Check that field groups are loaded in Custom Fields

**Blocks appear but no fields?**

- Field groups should auto-load from `acf-json/`
- If not, go to Custom Fields > Tools > Import Field Groups
