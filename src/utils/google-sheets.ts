const SPREADSHEET_ID = '1RuQqfFSAiOiUjJuPc84FI1Yl9O2m9iKkXb-0hQDHxO0';
const SHEET_TAB = 'Trang tính1';

interface GoogleCredentials {
	client_email: string;
	private_key: string;
	token_uri?: string;
}

async function getEnvVar(key: string): Promise<string | undefined> {
	if (typeof process !== 'undefined' && process.env && process.env[key]) {
		return process.env[key];
	}
	if (typeof import.meta !== 'undefined' && (import.meta as any).env && (import.meta as any).env[key]) {
		return (import.meta as any).env[key];
	}
	try {
		const cf = await import('cloudflare:workers');
		if (cf.env && (cf.env as any)[key]) {
			return (cf.env as any)[key];
		}
	} catch {
		// Not in workerd environment or module unavailable
	}
	return undefined;
}

async function getLocalCreds(): Promise<GoogleCredentials | null> {
	if (typeof process !== 'undefined' && process.cwd) {
		try {
			const fs = await import('node:fs');
			const path = await import('node:path');
			const filePath = path.resolve(process.cwd(), 'gscapi.json');
			if (fs.existsSync(filePath)) {
				const content = fs.readFileSync(filePath, 'utf-8');
				return JSON.parse(content);
			}
		} catch {
			// Filesystem unavailable or file not found
		}
	}
	return null;
}

async function getCredentials(): Promise<GoogleCredentials | null> {
	// 1. Try full JSON or base64 JSON from GOOGLE_SERVICE_ACCOUNT_KEY
	const rawKey = await getEnvVar('GOOGLE_SERVICE_ACCOUNT_KEY');
	if (rawKey) {
		try {
			const trimmed = rawKey.trim();
			if (trimmed.startsWith('{')) {
				return JSON.parse(trimmed);
			}
			const decoded = Buffer.from(trimmed, 'base64').toString('utf-8');
			return JSON.parse(decoded);
		} catch (e) {
			console.error('Failed to parse GOOGLE_SERVICE_ACCOUNT_KEY env var:', e);
		}
	}

	// 2. Try individual environment variables
	const clientEmail = await getEnvVar('GOOGLE_CLIENT_EMAIL');
	const privateKey = await getEnvVar('GOOGLE_PRIVATE_KEY');
	if (clientEmail && privateKey) {
		return {
			client_email: clientEmail,
			private_key: privateKey.replace(/\\n/g, '\n'),
			token_uri: (await getEnvVar('GOOGLE_TOKEN_URI')) || 'https://oauth2.googleapis.com/token',
		};
	}

	// 3. Fallback to local gscapi.json if present (local dev)
	const local = await getLocalCreds();
	if (local && local.client_email && local.private_key) {
		return local;
	}

	return null;
}

function base64url(buffer: ArrayBuffer | string): string {
	if (typeof buffer === 'string') {
		return Buffer.from(buffer, 'utf-8').toString('base64url');
	}
	return Buffer.from(buffer).toString('base64url');
}

function pemToPkcs8(pem: string): ArrayBuffer {
	const b64 = pem
		.replace(/-----BEGIN PRIVATE KEY-----/, '')
		.replace(/-----END PRIVATE KEY-----/, '')
		.replace(/\\n/g, '')
		.replace(/\s+/g, '');
	const buf = Buffer.from(b64, 'base64');
	return buf.buffer.slice(buf.byteOffset, buf.byteOffset + buf.byteLength);
}

let cachedToken: { token: string; exp: number } | null = null;

async function getAccessToken(): Promise<string> {
	const now = Math.floor(Date.now() / 1000);
	if (cachedToken && cachedToken.exp > now + 60) {
		return cachedToken.token;
	}

	const creds = await getCredentials();
	if (!creds || !creds.client_email || !creds.private_key) {
		throw new Error(
			'Chưa cấu hình tài khoản Google Cloud Service Account (vui lòng đặt GOOGLE_SERVICE_ACCOUNT_KEY trong Cloudflare hoặc cung cấp file gscapi.json khi chạy local).'
		);
	}

	const binaryKey = pemToPkcs8(creds.private_key);
	const key = await crypto.subtle.importKey(
		'pkcs8',
		binaryKey,
		{ name: 'RSASSA-PKCS1-v1_5', hash: 'SHA-256' },
		false,
		['sign']
	);

	const tokenUri = creds.token_uri || 'https://oauth2.googleapis.com/token';

	const header = base64url(JSON.stringify({ alg: 'RS256', typ: 'JWT' }));
	const claim = base64url(
		JSON.stringify({
			iss: creds.client_email,
			scope: 'https://www.googleapis.com/auth/spreadsheets',
			aud: tokenUri,
			exp: now + 3600,
			iat: now,
		})
	);

	const unsigned = `${header}.${claim}`;
	const sigBuf = await crypto.subtle.sign(
		'RSASSA-PKCS1-v1_5',
		key,
		new TextEncoder().encode(unsigned)
	);
	const sig = base64url(sigBuf);
	const jwt = `${unsigned}.${sig}`;

	const res = await fetch(tokenUri, {
		method: 'POST',
		headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
		body: new URLSearchParams({
			grant_type: 'urn:ietf:params:oauth:grant-type:jwt-bearer',
			assertion: jwt,
		}),
	});

	const data = (await res.json()) as { access_token?: string; error?: string };
	if (!data.access_token) {
		throw new Error(`Google Auth Failed: ${JSON.stringify(data)}`);
	}

	cachedToken = {
		token: data.access_token,
		exp: now + 3500,
	};

	return data.access_token;
}

export interface LeadPayload {
	name: string;
	phone: string;
	interest?: string;
	contact_pref?: string;
	form?: string;
	page?: string;
	time?: string;
	utm_source?: string;
	utm_medium?: string;
	utm_campaign?: string;
	utm_content?: string;
	utm_term?: string;
	fbclid?: string;
	gclid?: string;
	ttclid?: string;
}

export async function appendLeadToGoogleSheet(lead: LeadPayload) {
	const token = await getAccessToken();

	const safe = (val: string | undefined | null) => {
		if (val === undefined || val === null) return '';
		let str = String(val).trim();
		if (/^[=+\-@]/.test(str)) str = "'" + str;
		return str.slice(0, 500);
	};

	let phone = safe(lead.phone);
	if (phone && !phone.startsWith("'")) {
		phone = "'" + phone;
	}

	const row = [
		safe(lead.time || new Date().toLocaleString('vi-VN', { timeZone: 'Asia/Ho_Chi_Minh' })),
		safe(lead.name),
		phone,
		safe(lead.interest || 'Chưa xác định'),
		safe(lead.contact_pref || 'Zalo'),
		safe(lead.form || 'default'),
		safe(lead.page || ''),
		safe(lead.utm_source || ''),
		safe(lead.utm_medium || ''),
		safe(lead.utm_campaign || ''),
		safe(lead.utm_content || ''),
		safe(lead.utm_term || ''),
		safe(lead.fbclid || ''),
		safe(lead.gclid || ''),
		safe(lead.ttclid || ''),
	];

	const appendUrl = `https://sheets.googleapis.com/v4/spreadsheets/${SPREADSHEET_ID}/values/${encodeURIComponent(
		`${SHEET_TAB}!A1`
	)}:append?valueInputOption=USER_ENTERED`;

	const res = await fetch(appendUrl, {
		method: 'POST',
		headers: {
			Authorization: `Bearer ${token}`,
			'Content-Type': 'application/json',
		},
		body: JSON.stringify({
			values: [row],
		}),
	});

	const resData = (await res.json()) as { error?: any; updates?: any };
	if (resData.error) {
		throw new Error(`Google Sheets Append Error: ${JSON.stringify(resData.error)}`);
	}

	return resData;
}
