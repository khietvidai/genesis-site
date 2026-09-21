/**
 * CẤU HÌNH LANDING PAGE TT GENESIS
 * ---------------------------------------------------------------
 * Đổi thông tin liên hệ, webhook nhận lead và mã tracking quảng cáo
 * tại ĐÂY — toàn bộ trang sẽ tự cập nhật, không cần sửa index.astro.
 */

export const CONTACT = {
	/** Tên người tư vấn hiển thị trên nút gọi / form */
	advisor: "Ms. Kim Thuý",
	/** Số hotline (chỉ chữ số) */
	phone: "0903595058",
	/** Số hiển thị */
	phoneDisplay: "0903 595 058",
	/** Số Zalo (thường trùng hotline) */
	zalo: "0903595058",
	email: "lunanguyen2626@gmail.com",
	company: "CÔNG TY CP KINH DOANH BẤT ĐỘNG SẢN LUNA HOLDINGS",
	companyShort: "Luna Holdings",
	taxCode: "0318925374",
	address: "427 Đường Số 1, Phường An Lạc, TP. Hồ Chí Minh, Việt Nam",
};

export const LEAD = {
	/**
	 * URL Web App của Google Apps Script (xem docs/HUONG-DAN-GOOGLE-SHEET.md).
	 * Ví dụ: "https://script.google.com/macros/s/AKfycb.../exec"
	 * Khi để trống, form sẽ chuyển khách sang Zalo thay vì lưu vào Sheet.
	 */
	webhookUrl: "",
};

export const TRACKING = {
	/** Google Tag Manager, ví dụ "GTM-XXXXXXX" */
	gtmId: "",
	/** Google Analytics 4 / Google Ads, ví dụ "G-XXXXXXXXXX" hoặc "AW-XXXXXXXXX" */
	gtagId: "",
	/** Meta (Facebook) Pixel ID */
	metaPixelId: "",
	/** TikTok Pixel ID */
	tiktokPixelId: "",
};

export const SITE = {
	/** Tên miền chạy chính thức (dùng cho canonical & ảnh chia sẻ). Để trống nếu chưa có. */
	url: "",
	title: "TT GENESIS – Căn hộ Tri thức Nhật Bản tại Nam Sài Gòn | Từ 69 triệu/m²",
	description:
		"TT GENESIS – căn hộ cao cấp liền kề Phú Mỹ Hưng, liên doanh Việt Nam – Nhật Bản – Singapore. 88 tiện ích Compound Resort, giá từ 69 triệu/m², thanh toán cố định 29 triệu/tháng không vay. Nhận bảng giá & chính sách mới nhất.",
};
