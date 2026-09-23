/**
 * TT GENESIS Landing Page Interactive Scripts
 * Handles: Header stickiness, Countdown timer, Accessible Tabs, Lightbox, UTM tracking, AJAX Lead forms.
 *
 * @package Genesis_Theme
 */

(function () {
	'use strict';

	var $ = function (s, r) {
		return Array.prototype.slice.call((r || document).querySelectorAll(s));
	};

	/* ---- tracking helper: push events to active pixels ---- */
	function track(name, data) {
		try {
			window.dataLayer = window.dataLayer || [];
			window.dataLayer.push(Object.assign({ event: name }, data || {}));
			if (window.gtag) {
				window.gtag('event', name, data || {});
			}
			if (name === 'generate_lead') {
				if (window.fbq) {
					window.fbq('track', 'Lead');
				}
				if (window.ttq) {
					window.ttq.track('SubmitForm');
				}
			} else if (/^call_|^zalo_/.test(name)) {
				if (window.fbq) {
					window.fbq('track', 'Contact');
				}
				if (window.ttq) {
					window.ttq.track('Contact');
				}
			}
		} catch (e) {}
	}

	document.addEventListener('click', function (e) {
		var a = e.target.closest('[data-track]');
		if (!a) return;
		track(a.getAttribute('data-track'));
		var it = a.getAttribute('data-interest');
		if (it) {
			$('select[name=interest]').forEach(function (s) {
				for (var i = 0; i < s.options.length; i++) {
					if (s.options[i].value.indexOf(it.split(' ')[0]) === 0) {
						s.selectedIndex = i;
					}
				}
			});
		}
	});

	/* ---- header shadow ---- */
	var hd = document.querySelector('.hd');
	if (hd) {
		var onScroll = function () {
			hd.classList.toggle('is-stuck', window.scrollY > 24);
		};
		window.addEventListener('scroll', onScroll, { passive: true });
		onScroll();
	}

	/* ---- countdown timer ---- */
	$('.countdown').forEach(function (el) {
		var deadlineAttr = el.getAttribute('data-deadline') || (window.genesis_data && window.genesis_data.deadline);
		var end = new Date(deadlineAttr).getTime();
		function tick() {
			var t = Math.max(0, end - Date.now());
			if (t === 0) {
				var hdEl = el.closest('.sec__hd');
				if (hdEl) hdEl.classList.add('cd-ended');
				return;
			}
			var v = {
				d: Math.floor(t / 864e5),
				h: Math.floor(t / 36e5) % 24,
				m: Math.floor(t / 6e4) % 60,
				s: Math.floor(t / 1e3) % 60,
			};
			Object.keys(v).forEach(function (k) {
				var b = el.querySelector('[data-cd=' + k + ']');
				if (b) {
					b.textContent = (v[k] < 10 ? '0' : '') + v[k];
				}
			});
			setTimeout(tick, 1000);
		}
		tick();
	});

	/* ---- accessible tabs ---- */
	$('[data-tabs]').forEach(function (root) {
		var tabs = $('[role=tab]', root);
		function select(tab) {
			tabs.forEach(function (t) {
				var on = t === tab;
				t.setAttribute('aria-selected', on ? 'true' : 'false');
				t.tabIndex = on ? 0 : -1;
				var panel = document.getElementById(t.getAttribute('aria-controls'));
				if (panel) {
					panel.hidden = !on;
				}
			});
		}
		tabs.forEach(function (t, i) {
			t.addEventListener('click', function () {
				select(t);
				track('tab_' + t.id.replace('tab-', ''));
			});
			t.addEventListener('keydown', function (e) {
				var d = e.key === 'ArrowRight' ? 1 : e.key === 'ArrowLeft' ? -1 : 0;
				if (!d) return;
				var n = tabs[(i + d + tabs.length) % tabs.length];
				n.focus();
				select(n);
			});
		});
	});

	/* ---- lightbox zoom ---- */
	var lb = document.querySelector('.lb');
	if (lb) {
		var lbImg = lb.querySelector('img');
		$('[data-zoom]').forEach(function (im) {
			im.addEventListener('click', function () {
				lbImg.src = im.currentSrc || im.src;
				lbImg.alt = im.alt;
				lb.hidden = false;
			});
		});
		function closeLb() {
			lb.hidden = true;
			if (lbImg) lbImg.removeAttribute('src');
		}
		lb.addEventListener('click', closeLb);
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && !lb.hidden) closeLb();
		});
	}

	/* ---- UTM parameters capture ---- */
	var qs = new URLSearchParams(location.search);
	var utmKeys = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term', 'fbclid', 'gclid', 'ttclid'];
	var savedUtm = {};
	try {
		savedUtm = JSON.parse(sessionStorage.getItem('utm') || '{}');
		utmKeys.forEach(function (k) {
			if (qs.get(k)) savedUtm[k] = qs.get(k);
		});
		sessionStorage.setItem('utm', JSON.stringify(savedUtm));
	} catch (e) {
		savedUtm = {};
		utmKeys.forEach(function (k) {
			if (qs.get(k)) savedUtm[k] = qs.get(k);
		});
	}

	/* ---- AJAX Lead forms handler ---- */
	var config = window.genesis_data || {
		ajax_url: '/wp-admin/admin-ajax.php',
		nonce: '',
		webhook_url: '',
		zalo_href: 'https://zalo.me/0938912908',
	};

	$('form[data-lead]').forEach(function (form) {
		var msg = form.querySelector('.lf__msg');
		var btn = form.querySelector('button[type=submit]');

		form.addEventListener('submit', function (e) {
			e.preventDefault();

			// Honeypot spam bot check
			if (form.website && form.website.value) return;

			var name = form.fullname.value.trim();
			var phone = form.phone.value.replace(/[\s.\-()]/g, '').replace(/^\+?84/, '0');

			if (name.length < 2) {
				return fail('Vui lòng nhập họ tên của bạn (tối thiểu 2 ký tự).', form.fullname);
			}
			if (!/^0(3|5|7|8|9)\d{8}$/.test(phone)) {
				return fail('Số điện thoại chưa đúng định dạng, vui lòng kiểm tra lại.', form.phone);
			}

			var data = new FormData();
			data.append('action', 'genesis_submit_lead');
			data.append('nonce', config.nonce);
			data.append('name', name);
			data.append('phone', phone);
			data.append('interest', (form.interest ? form.interest.value : 'Chưa xác định'));
			data.append('contact_pref', (form.contact_pref ? form.contact_pref.value : 'Zalo'));
			data.append('form', form.getAttribute('data-lead') || 'default');
			data.append('page', location.href.split('#')[0]);
			data.append('time', new Date().toLocaleString('vi-VN', { timeZone: 'Asia/Ho_Chi_Minh' }));

			utmKeys.forEach(function (k) {
				data.append(k, savedUtm[k] || '');
			});

			btn.disabled = true;
			btn.dataset.label = btn.textContent;
			btn.textContent = 'Đang gửi…';
			msg.className = 'lf__msg';
			msg.textContent = '';

			fetch(config.ajax_url, {
				method: 'POST',
				body: data,
			})
				.then(function (res) {
					return res.json();
				})
				.then(function (result) {
					if (result.success) {
						track('generate_lead', {
							form_id: form.getAttribute('data-lead'),
							interest: form.interest ? form.interest.value : 'Chưa xác định',
						});

						var successMsg = result.data && result.data.message ? result.data.message : 'Đăng ký thành công! Chuyên viên sẽ liên hệ ' + phone + ' sớm nhất.';

						// Fallback: If Google Sheet webhook is not set, assist customer via Zalo
						if (!config.webhook_url) {
							done('Cảm ơn ' + name + '! Đang mở Zalo để chuyên viên gửi bảng giá cho bạn…');
							setTimeout(function () {
								window.open(config.zalo_href, '_blank');
							}, 1000);
						} else {
							done(successMsg);
						}
					} else {
						var errMsg = result.data && result.data.message ? result.data.message : 'Đã có lỗi xảy ra. Vui lòng thử lại.';
						btn.disabled = false;
						btn.textContent = btn.dataset.label;
						msg.className = 'lf__msg is-err';
						msg.textContent = errMsg;
					}
				})
				.catch(function () {
					btn.disabled = false;
					btn.textContent = btn.dataset.label;
					msg.className = 'lf__msg is-err';
					msg.textContent = 'Chưa gửi được do lỗi mạng. Vui lòng thử lại hoặc gọi hotline.';
				});
		});

		function fail(text, el) {
			msg.className = 'lf__msg is-err';
			msg.textContent = text;
			if (el) el.focus();
		}

		function done(text) {
			form.classList.add('is-done');
			msg.className = 'lf__msg is-ok';
			msg.textContent = text;
			btn.textContent = 'Đã gửi ✓';
		}
	});
})();
