# Nhận lead về Google Sheet (5 phút)

1. Vào <https://sheets.new> để tạo một Google Sheet mới, đặt tên ví dụ **TT Genesis – Leads**.
2. Menu **Tiện ích mở rộng → Apps Script**. Xoá code mẫu, dán toàn bộ nội dung file [`google-apps-script.gs`](./google-apps-script.gs). Bấm **Lưu**.
3. Bấm **Triển khai → Tuỳ chọn triển khai mới**:
   - Loại: **Ứng dụng web**
   - Thực thi dưới dạng: **Tôi**
   - Người có quyền truy cập: **Bất kỳ ai**
   - Bấm **Triển khai**, cấp quyền khi Google hỏi.
4. Sao chép **URL ứng dụng web** (dạng `https://script.google.com/macros/s/…/exec`).
5. Mở `src/config/landing.ts`, dán URL vào `LEAD.webhookUrl`, rồi commit + deploy lại.
6. Điền thử form trên trang → kiểm tra tab **Leads** trong Sheet và email báo lead.

> Khi `webhookUrl` còn để trống, form sẽ chuyển khách sang Zalo của chuyên viên để không mất lead, nhưng **không lưu** vào Sheet.

## Gắn mã quảng cáo

Trong `src/config/landing.ts` → `TRACKING`, điền ID tương ứng (GTM, GA4/Google Ads, Meta Pixel, TikTok Pixel). Trang tự bắn các sự kiện:

| Sự kiện | Khi nào | Meta Pixel | TikTok |
|---|---|---|---|
| `generate_lead` | Gửi form thành công | `Lead` | `SubmitForm` |
| `call_*`, `zalo_*` | Bấm nút gọi / Zalo | `Contact` | `Contact` |
| `cta_*`, `tab_*` | Bấm CTA, đổi tab căn hộ / thanh toán | – | – |

UTM (`utm_source`, `utm_campaign`…), `fbclid`, `gclid`, `ttclid` được lưu kèm mỗi lead để đo hiệu quả từng mẫu quảng cáo.
