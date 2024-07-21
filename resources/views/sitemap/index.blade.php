<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ LaravelLocalization::localizeUrl('/') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>
    
    <url>
        <loc>{{ LaravelLocalization::localizeUrl('/about-us') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>
    
    <url>
        <loc>{{ LaravelLocalization::localizeUrl('/contact-us') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>
    
    <url>
        <loc>{{ LaravelLocalization::localizeUrl('/blogs') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>
    
    
    <url>
        <loc>{{ LaravelLocalization::localizeUrl('/services') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>
    
    <!--<url>-->
    <!--    <loc>{{ url('/galleryImages') }}</loc>-->
    <!--    <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>-->
    <!--    <changefreq>daily</changefreq>-->
    <!--    <priority>0.6</priority>-->
    <!--</url>-->
</urlset>
