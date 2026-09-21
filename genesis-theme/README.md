# TT GENESIS – WordPress Landing Page Theme

Theme WordPress độc lập chuyên dụng cho Landing Page Bất Động Sản cao cấp **TT GENESIS (Nam Sài Gòn)**. Được thiết kế chuẩn SEO, tải siêu tốc, tích hợp sẵn CRM quản lý Khách hàng tiềm năng (Leads) trong WP Admin và bảng điều khiển Tùy biến (Customizer).

---

## 🌟 Đặc Điểm Nổi Bật

- **Độc lập 100%**: Không phụ thuộc vào Elementor, Contact Form 7, ACF Pro hay bất kỳ plugin trả phí nào.
- **Tốc độ tải tối đa**: Toàn bộ tương tác (Tabs, Countdown, Lightbox, AJAX Lead Forms) chạy bằng Vanilla JavaScript thuần, tài nguyên hình ảnh định dạng WebP hiện đại.
- **Tích hợp CRM Leads trong WP Admin**:
  - Tự động lưu mọi thông tin đăng ký vào mục **Khách hàng (Leads)**.
  - Hiển thị Họ tên, Số điện thoại (bấm gọi ngay), Loại căn quan tâm, Kênh liên hệ ưu tiên (Zalo/Gọi điện).
  - Ghi nhận đầy đủ tham số quảng cáo UTM (`utm_source`, `utm_campaign`, `fbclid`, `gclid`, `ttclid`).
  - Nút **"Xuất danh sách Lead (CSV / Excel)"** hỗ trợ font tiếng Việt UTF-8 BOM chuẩn để xuất file báo cáo nhanh.
- **Đồng bộ 3 Lớp**:
  - **Lớp 1**: Lưu vào database WordPress (không lo mất lead).
  - **Lớp 2**: Gửi Webhook sang Google Sheets tự động.
  - **Lớp 3**: Tự động mở chat Zalo trực tiếp với chuyên viên tư vấn khi chưa thiết lập Sheet.
- **Tracking Conversion**: Tự động bắn event chuyển đổi tới Google Analytics 4, Meta Pixel, TikTok Pixel.
- **Chuẩn SEO & Schema.org**: Tích hợp sẵn Schema JSON-LD `FAQPage` cho phần hỏi đáp.

---

## 🚀 Hướng Dẫn Cài Đặt

### Cách 1: Cài đặt qua file nén ZIP (Khuyên dùng)
1. Tải file `genesis-theme.zip` (ở thư mục gốc của dự án).
2. Đăng nhập vào trang quản trị WordPress (`/wp-admin`).
3. Vào **Giao diện (Appearance) > Giao diện (Themes) > Thêm mới (Add New) > Tải giao diện lên (Upload Theme)**.
4. Chọn file `genesis-theme.zip` và nhấn **Cài đặt ngay (Install Now)**.
5. Nhấn **Kích hoạt (Activate)**.

### Cách 2: Copy thư mục qua FTP / File Manager
1. Copy toàn bộ thư mục `genesis-theme/` vào đường dẫn:
   `wp-content/themes/genesis-theme/`
2. Vào **Giao diện > Giao diện** và nhấn **Kích hoạt**.

---

## ⚙️ Hướng Dẫn Cấu Hình (Customizer)

Vào **Giao diện > Tùy biến (Appearance > Customize)**, chọn mục **"Cài đặt TT GENESIS Landing Page"**:

1. **Thông tin Bán hàng & Chuyên viên**:
   - *Tên chuyên viên tư vấn*: Hiển thị trên form và avatar (ví dụ: `Ms. Kim Thuý`).
   - *Số Hotline*: Định dạng số liền để gắn link gọi điện (ví dụ: `0903595058`).
   - *Số Hotline hiển thị*: Định dạng hiển thị đẹp mắt (ví dụ: `0903 595 058`).
   - *Số Zalo tư vấn*: Số điện thoại Zalo của chuyên viên.
   - *Email, Tên công ty, MST, Địa chỉ*: Hiển thị tại phần chân trang (Footer).

2. **Đồng bộ Google Sheets Webhook**:
   - Dán URL Web App Google Apps Script của bạn vào ô **URL Webhook Google Sheets**.
   - *Lưu ý*: Nếu để trống, hệ thống vẫn lưu lead vào WP Admin và mở Zalo tư vấn cho khách.

3. **Mã Tracking & Pixels Quảng Cáo**:
   - Nhập các mã GTM ID (`GTM-XXXXXX`), GA4 ID (`G-XXXXXX`), Meta Pixel ID, TikTok Pixel ID. Theme sẽ tự động chèn đúng vị trí chuẩn kỹ thuật.

4. **Cấu hình Chiến dịch Ưu đãi**:
   - Chỉnh sửa ngày kết thúc đếm ngược (Countdown Deadline) theo định dạng: `YYYY-MM-DDTHH:MM:SS+07:00`.

---

## 👥 Quản Lý Khách Hàng Tiềm Năng (Leads)

1. Vào menu **Khách hàng (Leads)** trên thanh menu bên trái của WP Admin.
2. Bấm vào tên từng khách để xem chi tiết đầy đủ (IP, toàn bộ UTM Tags, loại căn quan tâm).
3. Bấm nút **"Xuất danh sách Lead (CSV / Excel)"** ở góc trên bảng để tải dữ liệu về máy tính.

---

## 📦 Cấu Trúc Mã Nguồn

```text
genesis-theme/
├── style.css                  # Thông tin theme
├── screenshot.png             # Ảnh xem trước theme
├── functions.php              # Khởi tạo theme, enqueues
├── header.php                 # Head, Tracking Pixels, Navbar
├── footer.php                 # Footer, Sticky Mobile Bar, Floating Buttons, Lightbox
├── front-page.php             # Template trang chủ chính
├── index.php                  # Fallback template
├── template-parts/            # Các section giao diện chia nhỏ
│   ├── hero.php
│   ├── stats.php
│   ├── offers.php
│   ├── strengths.php
│   ├── location.php
│   ├── amenities.php
│   ├── apartments.php
│   ├── handover.php
│   ├── payment.php
│   ├── partners.php
│   ├── legal-timeline.php
│   ├── faq.php
│   ├── final-cta.php
│   └── form-lead.php          # Component form đăng ký
├── inc/
│   ├── customizer.php         # Bảng điều khiển Customizer
│   ├── leads-cpt.php          # Post Type Khách hàng & Xuất CSV
│   └── lead-handler.php       # Xử lý AJAX Form & Webhook
└── assets/
    ├── css/landing.css        # Toàn bộ stylesheet
    ├── js/landing.js          # Toàn bộ tương tác client
    └── img/                   # Thư mục hình ảnh WebP
```
