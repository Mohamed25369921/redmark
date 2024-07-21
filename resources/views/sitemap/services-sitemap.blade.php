<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($services as $service)
        <url>
            <loc>{{ app()->getLocale() == 'en' ? \LaravelLocalization::localizeUrl('service/'.$service->link_en):\LaravelLocalization::localizeUrl('service/'.$service->link_ar)}}</loc>
            <lastmod>{{ $service->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
</urlset>