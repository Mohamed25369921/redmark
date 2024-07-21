<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($galleryImages as $galleryImage)
        <url>
            <loc>{{ app()->getLocale() == 'en' ? \LaravelLocalization::localizeUrl('/galleryImages'):\LaravelLocalization::localizeUrl('/galleryImages')}}</loc>
      
            <changefreq>weekly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
</urlset>