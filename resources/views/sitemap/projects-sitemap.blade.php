<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($projects as $project)
        <url>
            <loc>{{ app()->getLocale() == 'en' ? \LaravelLocalization::localizeUrl('project/'.$project->link_en):\LaravelLocalization::localizeUrl('project/'.$project->link_ar)}}</loc>
            <lastmod>{{ $project->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
</urlset>