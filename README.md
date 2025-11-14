# Tayta Theme

Modern WordPress theme with Timber (Twig) and Tailwind CSS v4.

## 📁 Project Structure

```
tayta/
├── functions.php          # Required by WordPress
├── index.php             # Required by WordPress (fallback)
├── style.css             # Required by WordPress (theme metadata)
├── screenshot.png        # (optional) Theme preview
├── vite.config.js        # Vite configuration with Tailwind CSS v4
├── package.json          # npm dependencies
├── composer.json         # Composer (Timber)
├── public/               # Compiled files
│   ├── bundle.css       # CSS compiled by Tailwind v4
│   └── app.js           # JS compiled by Vite
├── src/                  # Source files
│   ├── css/
│   │   ├── tokens.css   # Custom CSS variables
│   │   └── main.css     # Tailwind v4 with @theme config
│   └── js/
│       └── main.js      # Main JavaScript
├── timber/               # Twig templates
│   ├── base.twig        # General layout
│   ├── index.twig       # Home/fallback
│   ├── page.twig        # Pages
│   ├── single.twig      # Single posts
│   └── partials/
│       ├── header.twig
│       ├── footer.twig
│       └── hero.twig
├── templates/            # WordPress PHP templates
│   ├── index.php
│   ├── page.php
│   └── single.php
└── vendor/               # Composer (Timber)
```

## 🚀 Installation

### 1. Install PHP dependencies (Timber)

```bash
composer install
```

### 2. Install Node dependencies

```bash
npm install
```

### 3. Development

Run in development mode with auto-rebuild:

```bash
npm run dev
```

This will:

- Watch for changes in `src/js/` and `src/css/`
- Automatically rebuild when you save files
- Compile Tailwind CSS v4
- Update files in `public/` folder

**After saving a file, refresh your browser (Cmd+R) to see changes.**

### 4. Production

To compile for production (minified):

```bash
npm run build
```

This creates optimized, minified files in the `public/` folder.

## 🎨 Tailwind CSS v4 Configuration

This theme uses **Tailwind CSS v4** which has a new configuration approach using CSS instead of JavaScript.

### Configuration Location

The Tailwind configuration is now in `src/css/main.css` using the `@theme` directive:

```css
@theme {
  /* Custom colors */
  --color-primary: #3b82f6;
  --color-secondary: #8b5cf6;

  /* Custom fonts */
  --font-sans: system-ui, -apple-system, sans-serif;
}
```

### No tailwind.config.js needed!

Tailwind v4 uses CSS for configuration, so there's no `tailwind.config.js` file.

## 📝 Usage

### Create new Twig templates

1. Create the `.twig` file in the `timber/` folder
2. Create the corresponding `.php` file in `templates/` that calls Timber\Timber::render()

### Add styles

- Edit `src/css/main.css` to add Tailwind v4 theme configuration
- Edit `src/css/tokens.css` for additional custom CSS variables
- Styles will automatically compile to `public/bundle.css`

### Add JavaScript

- Edit `src/js/main.js` to add your JavaScript
- Code will automatically compile to `public/app.js`

## 🎨 Customization

### Tailwind v4 Theme

Edit `src/css/main.css` and customize within the `@theme` block:

```css
@theme {
  --color-primary: #3b82f6;
  --font-sans: "Inter", sans-serif;
  --breakpoint-tablet: 768px;
}
```

### CSS Variables

Edit `src/css/tokens.css` to define additional custom CSS variables.

## 📚 Resources

- [Timber Documentation](https://timber.github.io/docs/)
- [Tailwind CSS v4 Documentation](https://tailwindcss.com/docs)
- [Vite Documentation](https://vitejs.dev/)

## 👤 Author

Denis Ventura
