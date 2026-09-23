# WordPress Landing Page Theme TT GENESIS Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Convert the current TT GENESIS landing page into a standalone, production-ready WordPress Theme with zero external plugin dependencies, an integrated Leads CRM in WP Admin, Google Sheets webhook sync, and customizable sales settings via WP Customizer.

**Architecture:** Pure modular WordPress Classic Theme architecture. Template parts represent distinct visual sections; `functions.php` enqueues assets and loads PHP modules (`inc/customizer.php`, `inc/leads-cpt.php`, `inc/lead-handler.php`). Frontend interactions and AJAX lead submissions run on Vanilla JavaScript.

**Tech Stack:** PHP 7.4+, WordPress Core APIs (Customizer, Custom Post Types, AJAX, Nonces, `wp_remote_post`), HTML5, CSS3, Vanilla JavaScript.

## Global Constraints

- Standalone theme located at `genesis-theme/`, installable via `genesis-theme.zip`.
- Zero required third-party plugins (no ACF Pro, no Contact Form 7, no Elementor).
- 100% visual fidelity to current Astro landing page design, color palette (Deep Blue `#253349`, Amber `#A97C50`, Gold `#D8B27A`), and typography (`Be Vietnam Pro`, `Playfair Display`).
- All lead form submissions saved in WP Admin under CPT `genesis_lead` + forwarded to Google Sheet Webhook if configured + Zalo fallback if webhook missing.

---

### Task 1: Theme Base & Asset Scaffolding

**Files:**
- Create: `genesis-theme/style.css`
- Create: `genesis-theme/assets/css/landing.css`
- Copy assets: `public/img/*` -> `genesis-theme/assets/img/*`
- Create: `genesis-theme/screenshot.png`

**Interfaces:**
- Consumes: Assets from `public/img` and styles from `src/styles/landing.css`.
- Produces: Base theme directory `genesis-theme/` and assets for subsequent PHP templates.

- [ ] **Step 1: Create theme directory structure**

```bash
mkdir -p genesis-theme/assets/css genesis-theme/assets/js genesis-theme/assets/img genesis-theme/template-parts genesis-theme/inc
```

- [ ] **Step 2: Copy image assets**

```bash
cp -R public/img/* genesis-theme/assets/img/
```

- [ ] **Step 3: Create `style.css` with WordPress theme metadata**

Write `genesis-theme/style.css`:
```css
/*
Theme Name: TT GENESIS Landing Page
Theme URI: https://khietvidai.github.io/genesis-site
Author: Luna Holdings / khietvidai
Author URI: https://zalo.me/0938912908
Description: Giao diện Landing Page bất động sản cao cấp TT GENESIS Nam Sài Gòn. Tối ưu tốc độ tải trang, chuẩn SEO, tích hợp sẵn quản lý khách hàng tiềm năng (Leads CRM) và tùy biến Customizer.
Version: 1.0.0
Requires at least: 5.8
Tested up to: 6.7
Requires PHP: 7.4
License: GNU General Public License v2 or later
Text Domain: genesis-theme
*/
```

- [ ] **Step 4: Create `genesis-theme/assets/css/landing.css`**

Port `src/styles/landing.css` to `genesis-theme/assets/css/landing.css`, replacing any absolute `/img/` paths with relative `../img/` paths.

- [ ] **Step 5: Create `screenshot.png`**

Copy or generate screenshot for WP Admin theme selection:
```bash
cp genesis-theme/assets/img/hero.webp genesis-theme/screenshot.png 2>/dev/null || cp public/img/favicon.png genesis-theme/screenshot.png
```

- [ ] **Step 6: Commit**

```bash
git add genesis-theme/
git commit -m "feat(theme): scaffold base theme files and assets"
```

---

### Task 2: Theme Setup & Customizer Controls

**Files:**
- Create: `genesis-theme/functions.php`
- Create: `genesis-theme/inc/customizer.php`

**Interfaces:**
- Consumes: `genesis_get_option($key, $default)` helper function.
- Produces: Enqueued styles/scripts, Customizer panel "Cài đặt TT GENESIS Landing Page", localized script parameters (ajax_url, nonce, webhook_url, zalo_url).

- [ ] **Step 1: Create `genesis-theme/inc/customizer.php`**

Write `genesis-theme/inc/customizer.php` defining the settings panel and options:
- `genesis_advisor_name` (default: "Phòng Kinh doanh Luna Holdings")
- `genesis_phone` (default: "0938912908")
- `genesis_phone_display` (default: "0938.912.908")
- `genesis_zalo` (default: "0938912908")
- `genesis_email` (default: "office@lunaholdingsvn.com")
- `genesis_company_name` (default: "CÔNG TY CP KINH DOANH BẤT ĐỘNG SẢN LUNA HOLDINGS")
- `genesis_company_short` (default: "Luna Holdings")
- `genesis_tax_code` (default: "0318925374")
- `genesis_address` (default: "427 Đường Số 1, Phường An Lạc, TP. Hồ Chí Minh, Việt Nam")
- `genesis_webhook_url` (default: "")
- `genesis_gtm_id` (default: "")
- `genesis_gtag_id` (default: "")
- `genesis_meta_pixel_id` (default: "")
- `genesis_tiktok_pixel_id` (default: "")
- `genesis_countdown_deadline` (default: "2026-10-06T23:59:59+07:00")

- [ ] **Step 2: Create `genesis-theme/functions.php`**

Write `genesis-theme/functions.php`:
- Declare theme features (`title-tag`, `post-thumbnails`).
- Register and enqueue fonts (`Be Vietnam Pro`, `Playfair Display`), `landing.css`, and `landing.js`.
- Localize script with `genesis_data` containing `ajax_url`, `nonce`, `webhook_url`, `zalo_href`.
- Provide helper function `genesis_get_option($key, $default = '')`.
- Require `inc/customizer.php`, `inc/leads-cpt.php`, `inc/lead-handler.php`.

- [ ] **Step 3: Validate PHP syntax**

Run: `php -l genesis-theme/functions.php && php -l genesis-theme/inc/customizer.php`
Expected: "No syntax errors detected"

- [ ] **Step 4: Commit**

```bash
git add genesis-theme/functions.php genesis-theme/inc/customizer.php
git commit -m "feat(theme): add theme setup, enqueues, and customizer panel"
```

---

### Task 3: Leads CRM & AJAX Form Handler

**Files:**
- Create: `genesis-theme/inc/leads-cpt.php`
- Create: `genesis-theme/inc/lead-handler.php`

**Interfaces:**
- Consumes: WordPress `wp_insert_post()`, `wp_remote_post()`, `add_menu_page()`.
- Produces: Custom Post Type `genesis_lead`, admin columns, CSV export tool, AJAX endpoint `genesis_submit_lead`.

- [ ] **Step 1: Create `genesis-theme/inc/leads-cpt.php`**

Write `genesis-theme/inc/leads-cpt.php`:
- Register post type `genesis_lead` with label "Khách hàng tiềm năng", icon `dashicons-id-alt`.
- Define custom admin columns:
  - Title: Họ và tên
  - phone: Số điện thoại (với link `tel:`)
  - contact_pref: Kênh ưu tiên (Zalo / Gọi điện)
  - interest: Loại căn quan tâm
  - form_id: Vị trí form (hero / final / plan)
  - utm_source: Nguồn chiến dịch
  - date: Thời gian gửi
- Register metabox displaying complete submission data:
  - Phone, Contact Preference, Interest, Form ID, IP Address, UTM fields, submission timestamp.
- Add "Xuất CSV" button and handle `admin_post_genesis_export_leads` export action with UTF-8 BOM encoding for Excel compatibility.

- [ ] **Step 2: Create `genesis-theme/inc/lead-handler.php`**

Write `genesis-theme/inc/lead-handler.php`:
- Hook into `wp_ajax_genesis_submit_lead` and `wp_ajax_nopriv_genesis_submit_lead`.
- Validate Nonce (`genesis_lead_nonce`).
- Check honeypot field (`$_POST['website']`). If filled, return simulated success `{ success: true }` without saving (bot trap).
- Sanitize and validate inputs (`fullname`, `phone`, `interest`, `contact_pref`, UTM parameters).
- Insert post into `genesis_lead` and populate all post meta keys.
- Check if `genesis_webhook_url` is configured; if present, dispatch `wp_remote_post` payload.
- Return JSON response `{ success: true, message: "..." }`.

- [ ] **Step 3: Validate PHP syntax**

Run: `php -l genesis-theme/inc/leads-cpt.php && php -l genesis-theme/inc/lead-handler.php`
Expected: "No syntax errors detected"

- [ ] **Step 4: Commit**

```bash
git add genesis-theme/inc/leads-cpt.php genesis-theme/inc/lead-handler.php
git commit -m "feat(leads): add Leads CPT, admin columns, CSV export, and AJAX handler"
```

---

### Task 4: Template Parts (Sections & Reusable Lead Form)

**Files:**
- Create: `genesis-theme/template-parts/form-lead.php`
- Create: `genesis-theme/template-parts/hero.php`
- Create: `genesis-theme/template-parts/stats.php`
- Create: `genesis-theme/template-parts/offers.php`
- Create: `genesis-theme/template-parts/strengths.php`
- Create: `genesis-theme/template-parts/location.php`
- Create: `genesis-theme/template-parts/amenities.php`
- Create: `genesis-theme/template-parts/apartments.php`
- Create: `genesis-theme/template-parts/handover.php`
- Create: `genesis-theme/template-parts/payment.php`
- Create: `genesis-theme/template-parts/partners.php`
- Create: `genesis-theme/template-parts/legal-timeline.php`
- Create: `genesis-theme/template-parts/faq.php`

**Interfaces:**
- Consumes: `genesis_get_option()` and `get_template_directory_uri()`.
- Produces: Complete section partials loaded via `get_template_part()`.

- [ ] **Step 1: Create `template-parts/form-lead.php`**
Implement reusable lead form matching `LeadForm.astro`, receiving `$args['id']`, `$args['title']`, `$args['subtitle']`, `$args['cta']`, `$args['compact']`.

- [ ] **Step 2: Create `template-parts/hero.php` & `template-parts/stats.php`**
Implement hero layout with responsive picture, price boxes, ticks, CTA buttons, and stats grid.

- [ ] **Step 3: Create `template-parts/offers.php` & `template-parts/strengths.php`**
Implement sales offers with countdown timer container and 6 strengths with night aerial picture.

- [ ] **Step 4: Create `template-parts/location.php` & `template-parts/amenities.php`**
Implement location section with distance cards, school network map, infrastructure list, and 88 amenities grid.

- [ ] **Step 5: Create `template-parts/apartments.php` & `template-parts/handover.php`**
Implement 7 apartment floor plans with tab buttons and handover specifications.

- [ ] **Step 6: Create `template-parts/payment.php`, `template-parts/partners.php`, `template-parts/legal-timeline.php`, `template-parts/faq.php`**
Implement 5 payment options, international JV partners and logos, legal dossier & project timeline, and FAQ accordion with embedded Schema.org JSON-LD.

- [ ] **Step 7: Validate PHP syntax on all template parts**

Run: `for f in genesis-theme/template-parts/*.php; do php -l "$f"; done`
Expected: All files pass syntax check.

- [ ] **Step 8: Commit**

```bash
git add genesis-theme/template-parts/
git commit -m "feat(templates): implement all modular section template parts"
```

---

### Task 5: Header, Footer, Front Page & Interactive Client JS

**Files:**
- Create: `genesis-theme/header.php`
- Create: `genesis-theme/footer.php`
- Create: `genesis-theme/front-page.php`
- Create: `genesis-theme/index.php`
- Create: `genesis-theme/assets/js/landing.js`

**Interfaces:**
- Consumes: Template parts, `genesis_data` JS global.
- Produces: Fully assembled WordPress site layout with interactive tabs, lightbox, countdown, and AJAX form submissions.

- [ ] **Step 1: Create `genesis-theme/header.php`**
- Outputs `<head>`, meta tags, theme color, favicon, preloaded images.
- Dynamically outputs GTM, GA4, Meta Pixel, and TikTok Pixel scripts if IDs are provided in Customizer.
- Renders sticky header with logo, navigation anchors, and direct call button.

- [ ] **Step 2: Create `genesis-theme/footer.php`**
- Renders 3-column footer and legal disclaimer.
- Sticky mobile contact bar (Gọi ngay / Zalo / Nhận bảng giá).
- Floating contact action buttons on desktop (Zalo / Hotline).
- Lightbox modal for zooming floor plans and amenity maps.
- Calls `wp_footer()`.

- [ ] **Step 3: Create `genesis-theme/front-page.php` & `genesis-theme/index.php`**
- Calls `get_header()`.
- Sequentially includes all template parts: hero, stats, offers, strengths, location, amenities, apartments, handover, payment, partners, legal-timeline, faq, final CTA form.
- Calls `get_footer()`.

- [ ] **Step 4: Create `genesis-theme/assets/js/landing.js`**
Port client-side logic:
- Header stickiness on scroll.
- Countdown timer calculating days, hours, minutes, seconds.
- Keyboard and click-accessible tab switcher for Apartments and Payment schedules.
- Lightbox popup for images with `data-zoom`.
- UTM parameter persistence in `sessionStorage`.
- AJAX Form submission via WordPress `ajax_url` with nonce, validation, state handling, pixel event dispatching, and Zalo fallback.

- [ ] **Step 5: Validate syntax**

Run: `php -l genesis-theme/header.php && php -l genesis-theme/footer.php && php -l genesis-theme/front-page.php && php -l genesis-theme/index.php`
Expected: All files pass syntax check.

- [ ] **Step 6: Commit**

```bash
git add genesis-theme/header.php genesis-theme/footer.php genesis-theme/front-page.php genesis-theme/index.php genesis-theme/assets/js/landing.js
git commit -m "feat(pages): integrate header, footer, front-page, and interactive landing JS"
```

---

### Task 6: Packaging Script, Documentation & ZIP Creation

**Files:**
- Create: `genesis-theme/README.md`
- Create: `scripts/package-theme.sh`
- Create: `genesis-theme.zip`

**Interfaces:**
- Consumes: Complete `genesis-theme/` directory.
- Produces: Installable `genesis-theme.zip` ready for upload in WP Admin.

- [ ] **Step 1: Create `genesis-theme/README.md`**
Detailed guide on installing the theme in WordPress, configuring Customizer, setting up Google Sheets webhook, and managing Leads.

- [ ] **Step 2: Create packaging script `scripts/package-theme.sh`**

```bash
mkdir -p scripts
cat << 'EOF' > scripts/package-theme.sh
#!/bin/bash
set -e
rm -f genesis-theme.zip
zip -r genesis-theme.zip genesis-theme -x "*.DS_Store" "*__MACOSX*"
echo "Successfully created genesis-theme.zip"
EOF
chmod +x scripts/package-theme.sh
```

- [ ] **Step 3: Run packaging script**

Run: `./scripts/package-theme.sh`
Expected: `genesis-theme.zip` created.

- [ ] **Step 4: Verify ZIP contents**

Run: `unzip -l genesis-theme.zip | head -n 30`
Expected: Correct root folder `genesis-theme/` containing all files.

- [ ] **Step 5: Commit**

```bash
git add scripts/ genesis-theme/README.md
git commit -m "feat(package): add theme documentation and packaging script"
```
