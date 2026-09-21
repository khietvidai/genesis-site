# TT GENESIS – Landing page bán hàng

Trang chủ `/` là landing page chạy quảng cáo cho dự án **TT GENESIS – Căn hộ Tri thức Nhật Bản tại Nam Sài Gòn**, do Luna Holdings (đơn vị tư vấn & phân phối) vận hành. Blog/CMS EmDash vẫn hoạt động tại `/posts` để làm SEO.

| Việc cần làm | Sửa ở đâu |
|---|---|
| Đổi hotline, Zalo, tên công ty | `src/config/landing.ts` → `CONTACT` |
| Nhận lead về Google Sheet | `docs/HUONG-DAN-GOOGLE-SHEET.md` → dán URL vào `LEAD.webhookUrl` |
| Gắn GTM / GA4 / Meta Pixel / TikTok Pixel | `src/config/landing.ts` → `TRACKING` |
| Đổi nội dung, giá, chính sách | mảng dữ liệu đầu file `src/pages/index.astro` |
| Đổi hình ảnh | `public/img/` (WebP) |
| Giao diện | `src/styles/landing.css` |

Trang được prerender tĩnh (`export const prerender = true`) nên tải rất nhanh và không phụ thuộc database.

> Tài liệu gốc của dự án (thư mục `OneDrive_*`, ~2 GB) **không** đưa lên git – xem `.gitignore`.

---

# EmDash Blog Template (Cloudflare)

A clean, minimal blog built with [EmDash](https://github.com/emdash-cms/emdash) and deployed on Cloudflare Workers with D1 and R2.

[![Deploy to Cloudflare](https://deploy.workers.cloudflare.com/button)](https://deploy.workers.cloudflare.com/?url=https://github.com/emdash-cms/templates/tree/main/blog-cloudflare)

![Blog template homepage](https://raw.githubusercontent.com/emdash-cms/emdash/main/assets/templates/blog/latest/homepage-light-desktop.jpg)

## What's Included

- Featured post hero on the homepage
- Post archive with reading time estimates
- Category and tag archives
- Full-text search
- RSS feed
- SEO metadata and JSON-LD
- Dark/light mode
- Forms plugin and webhook notifier

## Pages

| Page | Route |
|---|---|
| Homepage | `/` |
| All posts | `/posts` |
| Single post | `/posts/:slug` |
| Category archive | `/category/:slug` |
| Tag archive | `/tag/:slug` |
| Search | `/search` |
| Static pages | `/pages/:slug` |
| 404 | fallback |

## Screenshots

| | Desktop | Mobile |
|---|---|---|
| Light | ![homepage light desktop](https://raw.githubusercontent.com/emdash-cms/emdash/main/assets/templates/blog/latest/homepage-light-desktop.jpg) | ![homepage light mobile](https://raw.githubusercontent.com/emdash-cms/emdash/main/assets/templates/blog/latest/homepage-light-mobile.jpg) |
| Dark | ![homepage dark desktop](https://raw.githubusercontent.com/emdash-cms/emdash/main/assets/templates/blog/latest/homepage-dark-desktop.jpg) | ![homepage dark mobile](https://raw.githubusercontent.com/emdash-cms/emdash/main/assets/templates/blog/latest/homepage-dark-mobile.jpg) |

## Infrastructure

- **Runtime:** Cloudflare Workers
- **Database:** D1
- **Storage:** R2
- **Framework:** Astro with `@astrojs/cloudflare`

## Local Development

```bash
pnpm install
pnpm bootstrap
pnpm dev
```

## Deploying

```bash
pnpm deploy
```

Or click the deploy button above to set up the project in your Cloudflare account.

## See Also

- [Node.js variant](../blog) -- same template using SQLite and local file storage
- [All templates](../)
- [EmDash documentation](https://github.com/emdash-cms/emdash/tree/main/docs)
