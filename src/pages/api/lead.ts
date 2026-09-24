import type { APIRoute } from 'astro';
import { appendLeadToGoogleSheet } from '../../utils/google-sheets';

export const prerender = false;

export const POST: APIRoute = async ({ request }) => {
	try {
		let body: Record<string, string> = {};

		const contentType = request.headers.get('content-type') || '';
		if (contentType.includes('application/json')) {
			body = await request.json();
		} else if (
			contentType.includes('multipart/form-data') ||
			contentType.includes('application/x-www-form-urlencoded')
		) {
			const formData = await request.formData();
			formData.forEach((value, key) => {
				if (typeof value === 'string') {
					body[key] = value;
				}
			});
		} else {
			const text = await request.text();
			const params = new URLSearchParams(text);
			params.forEach((value, key) => {
				body[key] = value;
			});
		}

		// Honeypot spam prevention
		if (body.website) {
			return new Response(JSON.stringify({ success: true }), {
				status: 200,
				headers: { 'Content-Type': 'application/json' },
			});
		}

		const name = (body.name || '').trim();
		const rawPhone = (body.phone || '').trim();
		const phone = rawPhone.replace(/[\s.\-()]/g, '').replace(/^\+?84/, '0');

		if (name.length < 2) {
			return new Response(
				JSON.stringify({ success: false, message: 'Vui lòng nhập họ tên (tối thiểu 2 ký tự).' }),
				{ status: 400, headers: { 'Content-Type': 'application/json' } }
			);
		}

		if (!/^0(3|5|7|8|9)\d{8}$/.test(phone)) {
			return new Response(
				JSON.stringify({ success: false, message: 'Số điện thoại không đúng định dạng.' }),
				{ status: 400, headers: { 'Content-Type': 'application/json' } }
			);
		}

		await appendLeadToGoogleSheet({
			name,
			phone,
			interest: (body.interest && body.interest !== 'Chưa xác định') ? body.interest : 'Nhận báo giá Đợt 1',
			contact_pref: body.contact_pref || 'Zalo',
			form: body.form,
			page: body.page,
			time: body.time,
			utm_source: body.utm_source,
			utm_medium: body.utm_medium,
			utm_campaign: body.utm_campaign,
			utm_content: body.utm_content,
			utm_term: body.utm_term,
			fbclid: body.fbclid,
			gclid: body.gclid,
			ttclid: body.ttclid,
		});

		return new Response(
			JSON.stringify({
				success: true,
				message: `Đăng ký thành công! Chuyên viên sẽ liên hệ ${phone} sớm nhất.`,
			}),
			{
				status: 200,
				headers: {
					'Content-Type': 'application/json',
					'Access-Control-Allow-Origin': '*',
				},
			}
		);
	} catch (error: any) {
		console.error('Error submitting lead to Google Sheet:', error);
		return new Response(
			JSON.stringify({
				success: false,
				message: 'Hệ thống đang bận. Vui lòng liên hệ hotline.',
				error: error?.message || String(error),
			}),
			{
				status: 500,
				headers: {
					'Content-Type': 'application/json',
					'Access-Control-Allow-Origin': '*',
				},
			}
		);
	}
};

export const OPTIONS: APIRoute = async () => {
	return new Response(null, {
		status: 204,
		headers: {
			'Access-Control-Allow-Origin': '*',
			'Access-Control-Allow-Methods': 'POST, OPTIONS',
			'Access-Control-Allow-Headers': 'Content-Type',
		},
	});
};
