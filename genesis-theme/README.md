# TT GENESIS – WordPress Landing Page Theme

Theme WordPress độc lập chuyên dụng cho Landing Page Bất Động Sản cao cấp **TT GENESIS (Nam Sài Gòn)**. Được thiết kế chuẩn SEO, tải siêu tốc, tích hợp sẵn CRM quản lý Khách hàng tiềm năng (Leads) trong WP Admin và bảng điều khiển Tùy biến (Customizer).

> **💡 SAMPLE DATA SẴN SÀNG CHẠY ADS:**
> Toàn bộ nội dung dự án, hình ảnh phối cảnh, bảng giá, lịch thanh toán và chính sách Đợt 1 đã được thiết lập sẵn làm **Sample Data chuẩn**. Các bạn Marketers / Sales chỉ cần cài đặt theme, vào màn hình **"⚙️ Cài đặt Ads & Hotline"** chỉnh lại Số điện thoại, Zalo và mã Pixel là có thể chạy quảng cáo Facebook, Google, TikTok được ngay!

---

## 🌟 Đặc Điểm Nổi Bật

- **Độc lập 100%**: Không phụ thuộc vào Elementor, Contact Form 7, ACF Pro hay bất kỳ plugin trả phí nào.
- **Tốc độ tải tối đa**: Toàn bộ tương tác (Tabs, Countdown, Lightbox, AJAX Lead Forms) chạy bằng Vanilla JavaScript thuần, tài nguyên hình ảnh định dạng WebP hiện đại.
- **Tích hợp CRM Leads trong WP Admin**:
  - Tự động tạo sẵn 4 khách hàng mẫu (Facebook, Google, TikTok Ads) khi kích hoạt theme để bạn kiểm tra giao diện CRM.
  - Tự động lưu mọi thông tin khách đăng ký mới vào mục **Khách hàng (Leads)**.
  - Hiển thị Họ tên, Số điện thoại (bấm gọi ngay), Loại căn quan tâm, Kênh liên hệ ưu tiên (Zalo/Gọi điện).
  - Ghi nhận đầy đủ tham số quảng cáo UTM (`utm_source`, `utm_campaign`, `fbclid`, `gclid`, `ttclid`).
  - Nút **"Xuất danh sách Lead (CSV / Excel)"** hỗ trợ font tiếng Việt UTF-8 BOM chuẩn để xuất file báo cáo nhanh.
- **Trang Cài Đặt Nhanh Dành Cho Marketers**:
  - Menu riêng: **Khách hàng (Leads) > ⚙️ Cài đặt Ads & Hotline**.
  - Đổi Hotline, Zalo, Tên chuyên viên, Giá bán Hero, Mã Pixel và link Google Sheet trong 1 màn hình duy nhất.
- **Đồng bộ 3 Lớp**:
  - **Lớp 1**: Lưu vào database WordPress (không lo mất lead).
  - **Lớp 2**: Gửi Webhook sang Google Sheets tự động.
  - **Lớp 3**: Tự động mở chat Zalo trực tiếp với chuyên viên tư vấn khi chưa thiết lập Sheet.
- **Tracking Conversion**: Tự động bắn event chuyển đổi tới Google Analytics 4 (`generate_lead`), Meta Pixel (`Lead`), TikTok Pixel (`SubmitForm`).
- **Chuẩn SEO & Schema.org**: Tích hợp sẵn Schema JSON-LD `FAQPage` cho phần hỏi đáp.

---

## 🚀 Hướng Dẫn Cài Đặt & Sử Dụng (Dành Cho Marketer / Sales)

### Bước 1: Cài đặt Theme
1. Tải file `genesis-theme.zip` (ở thư mục gốc của dự án).
2. Đăng nhập vào trang quản trị WordPress (`/wp-admin`).
3. Vào **Giao diện (Appearance) > Giao diện (Themes) > Thêm mới (Add New) > Tải giao diện lên (Upload Theme)**.
4. Chọn file `genesis-theme.zip` và nhấn **Cài đặt ngay (Install Now)**.
5. Nhấn **Kích hoạt (Activate)**.

### Bước 2: Chỉnh Sửa Thông Tin Để Chạy Ads
Sau khi kích hoạt, vào menu **Khách hàng (Leads) > ⚙️ Cài đặt Ads & Hotline**:
1. **Hotline & Zalo**: Nhập số điện thoại của bạn hoặc tổng đài (ví dụ: `0938912908`).
2. **Tên chuyên viên**: Nhập tên bạn muốn hiển thị trên form và avatar (ví dụ: `Phòng Kinh doanh Luna Holdings`). ⚠️ Không dùng tên gợi ý là chủ đầu tư hoặc phòng kinh doanh của chủ đầu tư (ví dụ “PkD TT Genesis”) – Google Ads có thể đánh giá là trình bày sai danh tính doanh nghiệp.
   Trước khi chạy ads thật, xoá các Lead mẫu (nhãn “Sample”) để số liệu không bị lẫn.
3. **Mã Pixel**: Dán Meta Pixel ID, TikTok Pixel ID hoặc Google Ads / GA4 ID của chiến dịch.
4. **Google Sheets Webhook**: Dán link Web App Google Sheets nếu muốn đồng bộ về Sheet riêng. *(Nếu để trống, khách gửi form sẽ được lưu trong WP Admin và tự động mở Zalo của bạn)*.
5. Bấm **"💾 Lưu Cài Đặt Chiến Dịch"** &mdash; Website đã sẵn sàng chạy ads!

---

## 👥 Quản Lý Khách Hàng Tiềm Năng (Leads)

1. Vào menu **Khách hàng (Leads)** trên thanh menu bên trái của WP Admin.
2. Bấm vào tên từng khách để xem chi tiết đầy đủ (Địa chỉ IP, toàn bộ UTM Campaign, Content, Term, loại căn quan tâm).
3. Bấm nút **"Xuất Lead (CSV / Excel)"** ở góc trên bảng để tải dữ liệu về máy tính (file UTF-8 BOM hiển thị chuẩn tiếng Việt trong Excel).
4. Bạn có thể bấm nút **"+ Tạo thêm Lead mẫu"** để tạo thêm dữ liệu thử nghiệm nếu muốn.

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
│   ├── hero.php               # Hero section (hỗ trợ giá động qua cài đặt)
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
│   ├── leads-cpt.php          # CRM Leads, Cài đặt Ads & Sample Data
│   └── lead-handler.php       # Xử lý AJAX Form & Webhook
└── assets/
    ├── css/landing.css        # Toàn bộ stylesheet
    ├── js/landing.js          # Toàn bộ tương tác client
    └── img/                   # Thư mục hình ảnh WebP
```
