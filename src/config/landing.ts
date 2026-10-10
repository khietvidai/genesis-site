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
	email: "dvkh@lunaholdingsvn.com",
	company: "CÔNG TY CỔ PHẦN KINH DOANH BẤT ĐỘNG SẢN LUNA HOLDINGS",
	companyShort: "Luna Holdings",
	taxCode: "0318925374",
	licenseDate: "23/04/2025",
	licensePlace: "Sở Kế hoạch và Đầu tư TP. Hồ Chí Minh",
	representative: "Nguyễn Ngọc Pháp",
	address: "427 Đường Số 1, Phường Bình Trị Đông B, Quận Bình Tân, Thành phố Hồ Chí Minh, Việt Nam",
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
	gtmId: "GTM-M79KB9X5",
	/** Google Analytics 4 / Google Ads, ví dụ "G-XXXXXXXXXX" hoặc "AW-XXXXXXXXX" */
	gtagId: "",
	/** Meta (Facebook) Pixel ID */
	metaPixelId: "",
	/** TikTok Pixel ID */
	tiktokPixelId: "",
};

export const SITE = {
	/** Tên miền chạy chính thức (dùng cho canonical & ảnh chia sẻ). Để trống nếu chưa có. */
	url: "https://ttgenesis-luna.com",
	title: "TT GENESIS – Căn hộ Tri thức Nhật Bản Nam Sài Gòn | Phân phối bởi Luna Holdings",
	description:
		"TT GENESIS – căn hộ cao cấp liền kề Phú Mỹ Hưng, liên doanh Việt Nam – Nhật Bản – Singapore. Tư vấn và phân phối bởi Công ty CP Kinh doanh Bất động sản Luna Holdings (MST 0318925374). Nhận bảng giá & chính sách đợt 1 mới nhất.",
};
