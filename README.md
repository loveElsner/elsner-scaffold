# 🚀 elsner-scaffold

**Description:**
A modern WordPress starter theme built with **ACF Flexible Content** and **PostCSS**.
Designed for **scalability, performance, and excellent developer experience**.

---

## 📦 Installation & Build

Navigate to the theme directory:

```bash
cd wp-content/themes/elsner-scaffold
```

Install dependencies:

```bash
npm install
```

Run build commands:

```bash
npm run build   # Production build
npm run dev     # Development (watch mode)
```

---

## 🏗️ Architecture

```bash
elsner-scaffold/
├── functions.php              # Bootstraps inc/ files
├── inc/
│   ├── setup.php              # Theme supports, menus, widgets, image sizes
│   ├── enqueue.php            # Scripts/styles + cleanup
│   ├── helpers.php            # Utility functions
│   ├── template-tags.php      # Custom template tags
│   ├── template-functions.php # Theme logic enhancements
│   ├── walker-nav.php         # Custom navigation walker (ARIA supported)
│   ├── customizer.php         # Theme options + live preview
│   └── acf/
│       ├── acf-setup.php      # ACF options + JSON config
│       └── flexible-content.php # Flexible layouts registration
│
├── template-parts/
│   ├── flexible/              # ACF flexible layouts
│   ├── header/                # Header components
│   ├── footer/                # Footer components
│   └── content/               # Content templates
│
├── assets/
│   ├── src/css/               # PostCSS structure
│   │   ├── base/              # Reset, typography, variables
│   │   ├── layout/            # Grid, header, footer
│   │   ├── components/        # UI components
│   │   ├── flexible/          # Layout-specific styles
│   │   ├── templates/         # Page templates
│   │   └── utilities/         # Helpers & animations
│   │
│   └── src/js/                # ES Modules (no jQuery)
│       ├── modules/           # Core JS modules
│       └── flexible/          # Layout-specific JS
│
├── postcss.config.js          # PostCSS pipeline
├── webpack.config.js          # JS bundling (Babel)
└── package.json               # Scripts: build, dev, lint
```

---

## ⚡ Key Features

* ✅ ACF Flexible Content-based architecture
* ✅ Modular CSS with PostCSS
* ✅ ES Modules (no jQuery dependency)
* ✅ Optimized for performance & scalability
* ✅ Clean and maintainable structure
* ✅ Developer-friendly workflow

---

## 🛠️ Tech Stack

* WordPress (Theme Development)
* ACF Pro
* PostCSS
* Webpack
* Babel
* Modern JavaScript (ES6+)

---

## 📌 Notes

* Ensure **ACF Pro** is installed and activated
* Use `npm run dev` during development for live updates
* Use `npm run build` before deployment

---
