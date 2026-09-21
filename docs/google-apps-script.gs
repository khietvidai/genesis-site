/**
 * TT GENESIS – nhận lead từ landing page vào Google Sheet.
 * Cách dùng: xem docs/HUONG-DAN-GOOGLE-SHEET.md
 */
const SHEET_NAME = "Leads";
const NOTIFY_EMAIL = "lunanguyen2626@gmail.com"; // để "" nếu không cần email báo lead mới
const COLUMNS = ["time", "name", "phone", "interest", "form", "utm_source", "utm_medium", "utm_campaign", "utm_content", "utm_term", "fbclid", "gclid", "ttclid", "page"];

function doPost(e) {
  const lock = LockService.getScriptLock();
  lock.waitLock(20000);
  try {
    const ss = SpreadsheetApp.getActiveSpreadsheet();
    let sh = ss.getSheetByName(SHEET_NAME);
    if (!sh) {
      sh = ss.insertSheet(SHEET_NAME);
      sh.appendRow(COLUMNS);
      sh.setFrozenRows(1);
    }
    const p = (e && e.parameter) || {};
    // Thêm dấu nháy để Sheet không bỏ số 0 đầu và không hiểu nhầm là công thức
    const safe = (v) => "'" + String(v || "").replace(/^[=+\-@]+/, "").slice(0, 500);
    sh.appendRow(COLUMNS.map((c) => safe(p[c])));
    if (NOTIFY_EMAIL) {
      MailApp.sendEmail(
        NOTIFY_EMAIL,
        "[TT GENESIS] Lead mới: " + (p.name || "") + " - " + (p.phone || ""),
        COLUMNS.map((c) => c + ": " + (p[c] || "")).join("\n")
      );
    }
    return ContentService.createTextOutput(JSON.stringify({ ok: true })).setMimeType(ContentService.MimeType.JSON);
  } finally {
    lock.releaseLock();
  }
}
