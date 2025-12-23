# Tayta Theme

Modern WordPress theme with Timber (Twig), Tailwind CSS v4, and ACF Blocks.

## Requirements

- ACF PRO plugin
- Composer
- Node.js & npm

## Installation

```bash
# Install dependencies
composer install
npm install

# Development
npm run dev

# Production
npm run build
```

## Project Structure

```
tayta/
├── blocks/                   # ACF Blocks (self-contained)
│   ├── hero/
│   │   ├── hero.twig        # Template
│   │   ├── fields.json      # ACF fields
│   │   └── block.php        # Block config
│   └── story/
│       ├── story.twig
│       ├── fields.json
│       └── block.php
├── src/
│   ├── css/main.css         # Tailwind v4 config
│   └── js/main.js           # JavaScript entry
├── timber/
│   └── partials/            # Reusable templates
├── public/                  # Compiled assets
└── templates/               # PHP templates
```

## Tailwind CSS v4 Configuration

Configure Tailwind in `src/css/main.css` using the `@theme` directive:

```css
@theme {
  --color-primary: #3b82f6;
  --font-sans: system-ui, sans-serif;
}
```

## Usage

### ACF Blocks

This theme includes 7 custom blocks: Hero, Story, Food Slider, Bowl Builder, Catering, Contact, and Newsletter.

For detailed instructions, see **[BLOCKS.md](BLOCKS.md)**

### Twig Templates

- Create `.twig` files in `timber/` folder
- Create corresponding `.php` files in `templates/` that call `Timber\Timber::render()`

### Styles & JavaScript

- **CSS**: Edit `src/css/main.css` → compiles to `public/bundle.css`
- **JS**: Edit `src/js/main.js` → compiles to `public/app.js`

### After Adding New PHP Classes

When you add new PHP classes or modify the structure, regenerate the autoloader:

```bash
composer dump-autoload
```

## Security

This theme disables plugin and theme auto-updates by default.

For details and optional core update configuration, see **[DISABLE-UPDATES.md](DISABLE-UPDATES.md)**

## Resources

- [Timber Documentation](https://timber.github.io/docs/)
- [Tailwind CSS v4 Documentation](https://tailwindcss.com/docs)
- [Vite Documentation](https://vitejs.dev/)
- [ACF Documentation](https://www.advancedcustomfields.com/resources/)

## Author

Denis Ventura
