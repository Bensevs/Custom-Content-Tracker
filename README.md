# Custom Content Ticker for Elementor

A lightweight and customizable WordPress plugin that adds a **Content Ticker** widget to the Elementor Page Builder. This widget lets you display a scrolling ticker of content sourced either from WordPress posts or manually created items — all fully customizable within Elementor.

________________

## ✨ Features

### 🔁 Dual Content Modes
- **WordPress Posts**: Automatically fetch and display the latest posts from your site.
- **Custom Items**: Add custom ticker entries using a repeater field with:
  - Title
  - Description
  - Image

### 🎨 Full Elementor Integration
- Adjust animation **speed**, **direction** (LTR or RTL), and **pause-on-hover**.
- Toggle navigation arrows (next/prev).
- Use Elementor's built-in **Style** tab to customize:
  - Colors
  - Typography
  - Spacing

### 🔐 Secure & Translatable
- All outputs are **escaped and sanitized** following WordPress best practices.
- Fully **translatable** using `__()` and `_e()` functions with a custom text domain.

### ⚙️ Optimized & Modern Development
- Uses **Webpack** to bundle and minify JS/SCSS assets.
- JavaScript is **transpiled with Babel** for wide browser support.
- **Composer-based autoloading** using PSR-4 standards.
- Lean, modular PHP structure.

---

## 🧱 Technical Requirements

- WordPress 5.0 or higher  
- Elementor 3.0 or higher  
- PHP 7.4 or higher  
- Node.js & npm (for development)  
- Composer (for development)

---

## 📦 Installation

### 1️⃣ Standard Installation (for WordPress Users)

1. Download `custom-content-ticker.zip` from the [Releases](#) page.
2. Go to **Plugins → Add New** in your WordPress dashboard.
3. Click **Upload Plugin** and select the ZIP file.
4. Click **Install Now**, then **Activate**.
5. The widget will appear in Elementor under the name **Content Ticker**.

---

### 2️⃣ Development Setup (for Developers)

To customize the plugin or contribute to development:

```bash
# Clone the repository
git clone https://github.com/your-username/your-repo.git
cd custom-content-ticker

# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install

# Build assets (production)
npm run build

# OR: Watch for changes (development)
npm run watch
