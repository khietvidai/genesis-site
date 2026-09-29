import type { APIRoute } from "astro";

export const prerender = false;

export const GET: APIRoute = async () => {
	return new Response("5c1da588ec73beb9a336e87577292e2b94275e3c45deb6e1b84c8efa93ca0e11", {
		status: 200,
		headers: {
			"Content-Type": "text/html; charset=utf-8",
			"Cache-Control": "public, max-age=0, must-revalidate",
		},
	});
};
