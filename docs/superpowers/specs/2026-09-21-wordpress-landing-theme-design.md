# Thiết Kế Kỹ Thuật: WordPress Landing Page Theme TT GENESIS

## 1. Tổng Quan & Mục Tiêu
Chuyển đổi giao diện landing page hiện tại của dự án TT GENESIS (đang viết bằng Astro) thành một WordPress Theme độc lập (Standalone Theme) hoàn chỉnh, có thể nén thành tệp `.zip` và cài đặt trực tiếp trên bất kỳ website WordPress nào mà không cần cài đặt thêm plugin bên thứ ba (như Contact Form 7, Elementor hay ACF Pro).

## 2. Yêu Cầu & Tiêu Chuẩn Kỹ Thuật
- **Nền tảng**: WordPress Theme độc lập chuẩn PHP/HTML5/CSS3/Vanilla JS.
- **Tương thích PHP**: PHP 7.4 - PHP 8.2+.
- **Tốc độ & Tối ưu**:
  - Tận dụng tài nguyên WebP có sẵn trong thư mục assets.
  - Sử dụng Vanilla JS cho các tương tác (Tabs, Lightbox, Countdown, UTM Tracker, AJAX Form), không phụ thuộc jQuery hay thư viện nặng.
  - Hỗ trợ đầy đủ Schema JSON-LD `FAQPage` cho SEO.
- **Bảo mật & Chống Spam**:
  - Sử dụng WordPress Nonce (`wp_create_nonce('genesis_lead_nonce')`) để bảo vệ request form.
  - Sử dụng Honeypot field (`website`) để loại bỏ bot spam.
  - Sanitize và validate dữ liệu chặt chẽ ở cả client-side và server-side.

## 3. Kiến Trúc Thư Mục Theme
Theme sẽ được tạo tại thư mục `genesis-theme/`:
```text
genesis-theme/
├── style.css                  # Metadata của theme (Theme Name, Version, Author...)
├── screenshot.png             # Ảnh xem trước theme trong WP Admin
├── functions.php              # Khởi tạo theme, nạp assets, include các module logic
├── header.php                 # Thẻ <head>, SEO meta, Google Fonts, tracking pixels, header bar
├── footer.php                 # Footer, sticky mobile bar, floating buttons, lightbox, modal
├── front-page.php             # Template trang chủ chính (chứa/gọi các section)
├── index.php                  # Fallback template chuẩn theo quy chuẩn WP
├── template-parts/
│   ├── hero.php               # Phối cảnh, tiêu đề, giá/chính sách, form hero
│   ├── stats.php              # Thống kê dự án (1.9 ha, 2 tháp, 1.438 căn...)
│   ├── offers.php             # Ưu đãi đợt 1 + đồng hồ đếm ngược countdown
│   ├── strengths.php          # 6 yếu tố gia tăng giá trị + ảnh toàn cảnh đêm
│   ├── location.php           # Vị trí chiến lược, khoảng cách, mạng lưới trường học, hạ tầng
│   ├── amenities.php          # 88 tiện ích Compound Resort, ảnh kim tự tháp, grid 9 phân khu
│   ├── apartments.php         # Thiết kế căn hộ + hệ thống tab tương tác 7 mẫu căn (Studio -> 3PN+)
│   ├── handover.php           # Tiêu chuẩn bàn giao thương hiệu Nhật Bản/Châu Âu
│   ├── payment.php            # Phương thức thanh toán + tabs 5 lịch thanh toán + ngân hàng
│   ├── partners.php           # Liên doanh Việt Nam - Nhật Bản - Singapore, logos & tư vấn
│   ├── legal-timeline.php     # Hồ sơ pháp lý minh bạch & lộ trình tiến độ dự án
│   ├── faq.php                # FAQ accordion câu hỏi thường gặp + Schema JSON-LD FAQPage
│   └── form-lead.php          # Component form đăng ký (tái sử dụng ở Hero và Final CTA)
├── inc/
│   ├── customizer.php         # Quản lý cài đặt Hotline, Zalo, Chuyên viên, Webhook, Pixels
│   ├── leads-cpt.php          # Đăng ký Custom Post Type "Khách hàng tiềm năng", cột dữ liệu & metabox
│   └── lead-handler.php       # Xử lý AJAX nhận form, lưu CPT, bắn Webhook Google Sheet
└── assets/
    ├── css/
    │   └── landing.css        # Toàn bộ CSS phong cách Deep Blue & Amber Gold
    ├── js/
    │   └── landing.js         # Countdown, Tabs, Lightbox, UTM tracker, Form AJAX handler
    └── img/                   # Toàn bộ hình ảnh WebP, logo đối tác, favicon
```

## 4. Quản Lý Khách Hàng Tiềm Năng (Leads CRM) Trong WP Admin
### 4.1. Custom Post Type `genesis_lead`
- Đăng ký post type với tên hiển thị: **Khách hàng tiềm năng** (`dashicons-id-alt`).
- Không hiển thị ra frontend (public = false, show_ui = true).
- **Cột hiển thị trong bảng Admin (Manage Columns)**:
  - Họ và tên khách hàng (Post title)
  - Số điện thoại (dạng link `tel:...` có thể nhấn gọi ngay)
  - Kênh ưu tiên nhận tin (Nhắn Zalo trước / Gọi điện)
  - Căn hộ quan tâm (Studio / 1PN / 2PN / 3PN...)
  - Vị trí gửi (Hero form / Final CTA / Nút xem giá căn hộ)
  - Nguồn chiến dịch (UTM Source, UTM Campaign, Fbclid...)
  - Thời gian gửi
- **Metabox chi tiết**:
  - Hiển thị đầy đủ thông số: Họ tên, Điện thoại, Kênh ưu tiên, Loại căn quan tâm, Form ID, IP Address, Toàn bộ tham số UTM (utm_source, utm_medium, utm_campaign, utm_content, utm_term, fbclid, gclid, ttclid), Thời gian tạo.
- **Tính năng Xuất CSV**:
  - Nút bấm "Xuất danh sách Lead (CSV)" trên trang danh sách admin để tải dữ liệu về máy.

### 4.2. Luồng Xử Lý Form Đăng Ký (3 Lớp)
1. **Frontend Validation & Honeypot**:
   - Kiểm tra họ tên tối thiểu 2 ký tự.
   - Kiểm tra định dạng số điện thoại Việt Nam (`/^0(3|5|7|8|9)\d{8}$/`).
   - Kiểm tra trường ẩn `website` (honeypot): nếu có dữ liệu => bỏ qua âm thầm (chống spam bot).
   - Tự động lưu và gửi kèm các tham số UTM lưu trong `sessionStorage`.
2. **Backend Lưu Trữ (AJAX / REST API)**:
   - Nhận POST request tại `admin-ajax.php?action=genesis_submit_lead` (hoặc REST API endpoint).
   - Verify Nonce.
   - **Lớp 1**: Thêm bài viết mới vào CPT `genesis_lead` với trạng thái `publish`, lưu toàn bộ thông tin vào post meta.
   - **Lớp 2**: Kiểm tra cấu hình `Google Sheet Webhook URL` trong Theme Customizer:
     - Nếu có URL: sử dụng `wp_remote_post` gửi dữ liệu sang Google Sheet Webhook (chạy ngầm).
   - **Lớp 3 (Client Feedback & Tracking)**:
     - Phản hồi JSON `{ success: true, message: "..." }`.
     - Kích hoạt sự kiện conversion: GA4 `generate_lead`, Meta Pixel `Lead`, TikTok Pixel `SubmitForm`.
     - Nếu không cấu hình webhook và chế độ Zalo fallback kích hoạt: hiển thị thông báo và mở chat Zalo với chuyên viên tư vấn.

## 5. Bảng Cài Đặt Tùy Biến (WordPress Customizer)
Thêm Panel **"Cài đặt TT GENESIS Landing Page"** trong `Giao diện > Tùy biến`:
- **Thông tin Bán hàng & Chuyên viên**:
  - `genesis_advisor_name` (Mặc định: `PkD TT Genesis`)
  - `genesis_phone` (Mặc định: `0938912908`)
  - `genesis_phone_display` (Mặc định: `0938.912.908`)
  - `genesis_zalo` (Mặc định: `0938912908`)
  - `genesis_email` (Mặc định: `office@lunaholdingsvn.com`)
  - `genesis_company_name` (Mặc định: `CÔNG TY CP KINH DOANH BẤT ĐỘNG SẢN LUNA HOLDINGS`)
  - `genesis_company_short` (Mặc định: `Luna Holdings`)
  - `genesis_tax_code` (Mặc định: `0318925374`)
  - `genesis_address` (Mặc định: `427 Đường Số 1, Phường An Lạc, TP. Hồ Chí Minh, Việt Nam`)
- **Tích Hợp Google Sheets**:
  - `genesis_webhook_url` (URL Google Apps Script Web App)
- **Mã Tracking Quảng Cáo**:
  - `genesis_gtm_id` (Google Tag Manager ID)
  - `genesis_gtag_id` (Google Analytics 4 / Google Ads ID)
  - `genesis_meta_pixel_id` (Facebook Pixel ID)
  - `genesis_tiktok_pixel_id` (TikTok Pixel ID)
- **Cấu hình Đếm Ngược**:
  - `genesis_countdown_deadline` (Mặc định: `2026-10-06T23:59:59+07:00`)

## 6. Đóng Gói Cài Đặt
- Tạo script đóng gói tự động thành file `genesis-theme.zip` tại thư mục gốc của workspace.
- Hướng dẫn cài đặt nhanh qua WP Admin được đính kèm trong tài liệu.
