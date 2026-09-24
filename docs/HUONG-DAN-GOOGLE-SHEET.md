# Hướng Dẫn Đồng Bộ Lead Về Google Sheets (5 Phút)

Hệ thống Landing Page TT GENESIS đã được lập trình sẵn cơ chế Webhook đồng bộ thời gian thực về Google Sheet. Dưới đây là các bước thực hiện chi tiết cho bảng tính của bạn:

👉 **Link Google Sheet:** [https://docs.google.com/spreadsheets/d/1RuQqfFSAiOiUjJuPc84FI1Yl9O2m9iKkXb-0hQDHxO0/edit](https://docs.google.com/spreadsheets/d/1RuQqfFSAiOiUjJuPc84FI1Yl9O2m9iKkXb-0hQDHxO0/edit)

---

## Bước 1: Cài đặt Apps Script trên Google Sheet

1. Mở link Google Sheet ở trên.
2. Trên thanh menu, chọn: **Tiện ích mở rộng** (Extensions) → **Apps Script**.
3. Xóa sạch đoạn mã mặc định `function myFunction() { ... }`.
4. Mở file [`google-apps-script.gs`](./google-apps-script.gs) trong dự án, copy toàn bộ code và dán vào Apps Script.
5. Bấm biểu tượng 💾 **Lưu** (Save project).

---

## Bước 2: Triển khai thành Web App lấy URL Webhook

1. Ở góc trên bên phải màn hình Apps Script, bấm nút xanh **Triển khai** (Deploy) → **Tùy chọn triển khai mới** (New deployment).
2. Bấm biểu tượng bánh răng ⚙️ (Chọn loại) → chọn **Ứng dụng web** (Web app).
3. Thiết lập chính xác 3 mục sau:
   - **Mô tả (Description):** `Genesis Lead Webhook`
   - **Thực thi dưới dạng (Execute as):** `Tôi` (địa chỉ Gmail của bạn)
   - **Người có quyền truy cập (Who has access):** `Bất kỳ ai` (Anyone) *(⚠️ Bắt buộc chọn "Bất kỳ ai" để website đẩy dữ liệu về được).*
4. Bấm **Triển khai** (Deploy).
5. Google sẽ hiện hộp thoại yêu cầu cấp quyền:
   - Bấm **Ủy quyền truy cập** (Authorize access) và chọn tài khoản Google của bạn.
   - Nếu hiện cảnh báo *"Google chưa xác minh ứng dụng này"*, bấm vào **Nâng cao** (Advanced) ở góc dưới.
   - Bấm tiếp vào **Đi tới [Tên dự án] (không an toàn)**.
   - Bấm **Cho phép** (Allow).
6. Copy đường link **URL ứng dụng web** (Web app URL, có dạng: `https://script.google.com/macros/s/AKfycb.../exec`).

---

## Bước 3: Gắn URL Webhook vào Website

### Cách A: Nếu bạn đang sử dụng WordPress (Theme TT Genesis)
1. Đăng nhập trang quản trị **WordPress Admin**.
2. Vào menu: **Khách hàng (Leads)** → **⚙️ Cài đặt Ads & Hotline**.
3. Kéo xuống mục **2. 📊 Đồng Bộ Lead Về Google Sheets (Webhook)**.
4. Dán link vừa copy vào ô **URL Google Apps Script Web App**.
5. Bấm **Lưu cấu hình chiến dịch**.

### Cách B: Nếu bạn đang chạy bản Astro / Static
1. Mở file `src/config/landing.ts`.
2. Dán link vừa copy vào `LEAD.webhookUrl`:
   ```ts
   export const LEAD = {
       webhookUrl: "https://script.google.com/macros/s/AKfycb.../exec",
   };
   ```
3. Lưu file và build / deploy lại website.

---

## Bước 4: Kiểm tra thử nghiệm

1. Mở website trên trình duyệt (hoặc tab ẩn danh).
2. Điền form đăng ký tư vấn với thông tin mẫu (Họ tên, SĐT) và bấm gửi.
3. Mở Google Sheet: Dòng thông tin khách hàng mới sẽ tự động hiển thị ngay lập tức kèm đầy đủ UTM tracking, vị trí form và thời gian đăng ký.

