# 🚀 Adam Wathan's Laravel Frontend Preset

A Laravel frontend preset that scaffolds out new applications just the way I like 'em 👌🏻

What it includes:

- [Tailwind CSS](https://tailwindcss.com)
- [postcss-nesting](https://github.com/jonathantneal/postcss-nesting) for nested CSS support
- [Purgecss](https://www.purgecss.com/), via [spatie/laravel-mix-purgecss](https://github.com/spatie/laravel-mix-purgecss)
- [Vue.js](https://vuejs.org/)
- Removes Bootstrap and jQuery
- Adds compiled assets to `.gitignore`
- Adds a simple Tailwind-tuned default layout template
- Replaces the `welcome.blade.php` template with one that extends the main layout

## Installation

This package isn't on Packagist (yet), so to get started, add it as a repository to your `composer.json` file:

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/adamwathan/laravel-preset"
    }
]
```

Next, run this command to add the preset to your project:

```
composer require adamwathan/laravel-preset --dev
```

Finally, apply the scaffolding by running:

```
php artisan preset nothingworks
```

> What's `nothingworks`? NothingWorks Inc. is the absurd name I chose for my business, where I create products like [Refactoring to Collections](https://adamwathan.me/refactoring-to-collections/) and [Test-Driven Laravel](https://course.testdrivenlaravel.com/) 😄



