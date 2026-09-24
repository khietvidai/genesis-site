/**
 * CẤU HÌNH LANDING PAGE TT GENESIS
 * ---------------------------------------------------------------
 * Đổi thông tin liên hệ, webhook nhận lead và mã tracking quảng cáo
 * tại ĐÂY — toàn bộ trang sẽ tự cập nhật, không cần sửa index.astro.
 */

export const CONTACT = {
	/**
	 * Tên người/bộ phận tư vấn hiển thị trên form & footer.
	 * ⚠️ Không dùng tên gợi ý là chủ đầu tư hoặc phòng kinh doanh của CĐT (vd "PkD TT Genesis")
	 * – Google Ads có thể đánh giá là trình bày sai danh tính doanh nghiệp.
	 */
	advisor: "Phòng Kinh doanh Luna Holdings",
	/** Chữ viết tắt trên avatar ở form */
	advisorInitials: "LH",
	/** Số hotline (chỉ chữ số) */
	phone: "0938912908",
	/** Số hiển thị */
	phoneDisplay: "0938.912.908",
	/** Số Zalo (thường trùng hotline) */
	zalo: "0938912908",
	email: "office@lunaholdingsvn.com",
	company: "CÔNG TY CP KINH DOANH BẤT ĐỘNG SẢN LUNA HOLDINGS",
	companyShort: "Luna Holdings",
	taxCode: "0318925374",
	address: "427 Đường Số 1, Phường An Lạc, TP. Hồ Chí Minh, Việt Nam",
};

export const LEAD = {
	/**
	 * URL Web App của Google Apps Script hoặc internal API.
	 * Mặc định dùng internal API /api/lead kết nối Google Cloud Service Account.
	 */
	webhookUrl: "/api/lead",
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
