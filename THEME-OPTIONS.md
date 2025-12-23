# Theme Options

ACF Options Page for managing global theme settings.

## Location

WordPress Admin → **Theme Settings**

## Available Options

### Footer Settings

- **Opening Hours - Weekdays**: e.g., "Tuesday - Saturday 12:00pm - 23:00pm"
- **Closed Days**: e.g., "Closed on Sunday"
- **Facebook URL**: Full URL to Facebook page
- **Instagram URL**: Full URL to Instagram profile
- **Copyright Text**: Copyright text (use `{year}` for current year)
  - Example: `© {year} example.com. All rights reserved.`
- **Legal Links** (Repeater): Add multiple legal links (Terms, Privacy, etc.)
  - **Text**: Link text to display
  - **URL**: Link URL

## Usage in Templates

Options are available globally via the `options` variable:

```twig
{# Footer hours #}
{{ options.footer_hours_weekdays }}
{{ options.footer_hours_closed }}

{# Social links #}
{{ options.footer_facebook }}
{{ options.footer_instagram }}

{# Copyright with dynamic year #}
{{
  options.footer_copyright|replace({
    '{year}': 'now'|date('Y')
  })
}}

{# Legal links #}
{% for link in options.footer_legal_links %}
  <a href="{{ link.url }}">{{ link.text }}</a>
{% endfor %}
```

## File Locations

- **Options Page Class**: `src/Features/ThemeOptions.php`
- **ACF Fields**: `acf-json/group_theme_options.json`
- **Used in**: `timber/partials/footer.twig`
