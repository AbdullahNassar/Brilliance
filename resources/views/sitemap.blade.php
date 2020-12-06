<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
    <url>
        <loc>https://edu.marj3.com/ar/</loc>
        <lastmod>{{ gmdate(DateTime::W3C, strtotime($now)) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>https://edu.marj3.com/en/</loc>
        <lastmod>{{ gmdate(DateTime::W3C, strtotime($now)) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>https://edu.marj3.com/ar/programs/</loc>
        <lastmod>{{ gmdate(DateTime::W3C, strtotime($now)) }}</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.1</priority>
    </url>
    <url>
        <loc>https://edu.marj3.com/en/programs/</loc>
        <lastmod>{{ gmdate(DateTime::W3C, strtotime($now)) }}</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.1</priority>
    </url>
@foreach($programs as $program)
    <url>
        <loc>https://edu.marj3.com/ar/program/{{$program->id}}/{{$program->translate('en', true)->slug}}/</loc>
        <lastmod>{{ gmdate(DateTime::W3C, strtotime($program->updated_at)) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://edu.marj3.com/ar/program/{{$program->id}}/{{$program->translate('ar', true)->slug}}/</loc>
        <lastmod>{{ gmdate(DateTime::W3C, strtotime($program->updated_at)) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
@endforeach

@foreach($universities as $university)
    <url>
        <loc>https://edu.marj3.com/ar/university/{{$university->id}}/{{$university->translate('en', true)->slug}}/</loc>
        <lastmod>{{ gmdate(DateTime::W3C, strtotime($university->updated_at)) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://edu.marj3.com/ar/university/{{$university->id}}/{{$university->translate('ar', true)->slug}}/</loc>
        <lastmod>{{ gmdate(DateTime::W3C, strtotime($university->updated_at)) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
@endforeach
</urlset>