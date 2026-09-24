/**
 * =========================================================================
 * TT GENESIS - TỰ ĐỘNG ĐỒNG BỘ LEAD VÀO GOOGLE SHEETS
 * Bảng tính: https://docs.google.com/spreadsheets/d/1RuQqfFSAiOiUjJuPc84FI1Yl9O2m9iKkXb-0hQDHxO0/edit
 * =========================================================================
 */

// Tên Tab trang tính cần lưu. Để "" sẽ tự động ghi vào Tab đầu tiên của Sheet.
const SHEET_NAME = ""; // Hoặc đặt "Leads"

// Email nhận thông báo ngay khi có lead (để "" nếu không muốn nhận email)
const NOTIFY_EMAIL = "office@lunaholdingsvn.com";

// Danh sách tiêu đề cột hiển thị trên Google Sheet
const HEADERS = [
  "Thời gian",
  "Họ và tên",
  "Số điện thoại",
  "Nhu cầu quan tâm",
  "Kênh liên hệ",
  "Vị trí Form",
  "Link trang",
  "UTM Source",
  "UTM Medium",
  "UTM Campaign",
  "UTM Content",
  "UTM Term",
  "FBCLID",
  "GCLID",
  "TTCLID"
];

function doPost(e) {
  const lock = LockService.getScriptLock();
  // Khóa 30 giây để tránh xung đột dữ liệu khi nhiều người gửi form cùng lúc
  lock.waitLock(30000);

  try {
    const ss = SpreadsheetApp.getActiveSpreadsheet();
    let sheet;

    if (SHEET_NAME && SHEET_NAME.trim() !== "") {
      sheet = ss.getSheetByName(SHEET_NAME);
      if (!sheet) {
        sheet = ss.insertSheet(SHEET_NAME);
      }
    } else {
      sheet = ss.getSheets()[0];
    }

    // Nếu Sheet trống (chưa có tiêu đề), tự động tạo hàng tiêu đề nổi bật
    if (sheet.getLastRow() === 0) {
      sheet.appendRow(HEADERS);
      const headerRange = sheet.getRange(1, 1, 1, HEADERS.length);
      headerRange.setBackground("#0f6d38"); // Xanh nhận diện TT Genesis
      headerRange.setFontColor("#ffffff");
      headerRange.setFontWeight("bold");
      headerRange.setHorizontalAlignment("center");
      sheet.setFrozenRows(1);
    }

    // Trích xuất dữ liệu gửi lên (hỗ trợ cả FormData, URL-encoded và JSON)
    let p = {};
    if (e && e.parameter && Object.keys(e.parameter).length > 0) {
      p = e.parameter;
    } else if (e && e.postData && e.postData.contents) {
      try {
        p = JSON.parse(e.postData.contents);
      } catch (err) {
        p = {};
      }
    }

    // Xử lý an toàn: chống formula injection (=, +, -) và cắt tối đa 500 ký tự
    const safe = (val) => {
      if (val === undefined || val === null) return "";
      let str = String(val).trim();
      if (/^[=+\-@]/.test(str)) {
        str = "'" + str;
      }
      return str.slice(0, 500);
    };

    // Số điện thoại bắt buộc thêm dấu ' để không bị Google Sheet tự mất số 0 đầu
    let phone = safe(p.phone || "");
    if (phone && !phone.startsWith("'")) {
      phone = "'" + phone;
    }

    const rowData = [
      safe(p.time || Utilities.formatDate(new Date(), "Asia/Ho_Chi_Minh", "dd/MM/yyyy HH:mm:ss")),
      safe(p.name || ""),
      phone,
      safe(p.interest || "Chưa xác định"),
      safe(p.contact_pref || "Zalo"),
      safe(p.form || "default"),
      safe(p.page || ""),
      safe(p.utm_source || ""),
      safe(p.utm_medium || ""),
      safe(p.utm_campaign || ""),
      safe(p.utm_content || ""),
      safe(p.utm_term || ""),
      safe(p.fbclid || ""),
      safe(p.gclid || ""),
      safe(p.ttclid || "")
    ];

    sheet.appendRow(rowData);

    // Gửi email thông báo cho phòng kinh doanh nếu có cài email
    if (NOTIFY_EMAIL && NOTIFY_EMAIL.trim() !== "") {
      try {
        MailApp.sendEmail({
          to: NOTIFY_EMAIL,
          subject: "[TT GENESIS] Có Lead Mới: " + (p.name || "Khách hàng") + " - " + (p.phone || ""),
          body:
            "THÔNG BÁO CÓ KHÁCH HÀNG MỚI ĐĂNG KÝ TƯ VẤN TT GENESIS:\n\n" +
            "• Họ và tên: " + (p.name || "") + "\n" +
            "• Số điện thoại: " + (p.phone || "") + "\n" +
            "• Nhu cầu quan tâm: " + (p.interest || "") + "\n" +
            "• Kênh ưu tiên liên hệ: " + (p.contact_pref || "Zalo") + "\n" +
            "• Vị trí form gửi: " + (p.form || "") + "\n" +
            "• Nguồn chiến dịch: " + (p.utm_source || "Tự nhiên") + " " + (p.utm_campaign ? "(" + p.utm_campaign + ")" : "") + "\n" +
            "• Thời gian gửi: " + (p.time || "") + "\n\n" +
            "Xem danh sách đầy đủ tại Google Sheet:\n" + ss.getUrl()
        });
      } catch (mailErr) {
        // Không chặn tiến trình nếu quota gửi mail của Google bị giới hạn
      }
    }

    return ContentService.createTextOutput(JSON.stringify({ ok: true, message: "Lưu lead thành công!" }))
      .setMimeType(ContentService.MimeType.JSON);

  } catch (error) {
    return ContentService.createTextOutput(JSON.stringify({ ok: false, error: error.toString() }))
      .setMimeType(ContentService.MimeType.JSON);
  } finally {
    lock.releaseLock();
  }
}

