<?php

namespace App\Helpers;

class SEOHelper
{
    /**
     * Generate meta tags for a page
     */
    public static function generateMetaTags(array $data = []): array
    {
        $siteName = config('app.name', 'Centre de Ressources du Préscolaire');
        $siteUrl = config('app.url');
        $defaultTitle = 'Centre de Ressources du Préscolaire - Éducation Préscolaire au Maroc';
        $defaultDescription = 'Centre de Ressources du Préscolaire offrant des ressources pédagogiques, formations en ligne et documentation spécialisée pour l\'éducation préscolaire au Maroc.';

        $title = $data['title'] ?? $defaultTitle;
        $description = $data['description'] ?? $defaultDescription;
        $image = $data['image'] ?? asset('storage/images/logo.png');
        $type = $data['type'] ?? 'website';
        $url = $data['url'] ?? url()->current();
        $locale = app()->getLocale();
        $localeAlternate = $locale === 'fr' ? 'ar' : 'fr';

        // Ensure absolute URL for images
        if ($image && !filter_var($image, FILTER_VALIDATE_URL)) {
            $image = asset($image);
        }

        return [
            'title' => $title,
            'description' => $description,
            'type' => $type,
            'url' => $url,
            'image' => $image,
            'site_name' => $siteName,
            'locale' => str_replace('_', '-', $locale),
            'locale_alternate' => str_replace('_', '-', $localeAlternate),
            'site_url' => $siteUrl,
        ];
    }

    /**
     * Generate structured data (JSON-LD) for Organization
     */
    public static function generateOrganizationSchema(): string
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'EducationalOrganization',
            'name' => 'Centre de Ressources du Préscolaire',
            'alternateName' => 'مركز موارد التعليم الأولي',
            'description' => 'Centre de Ressources du Préscolaire - Éducation Préscolaire au Maroc',
            'url' => config('app.url'),
            'logo' => asset('storage/images/logo.png'),
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Oujda',
                'addressCountry' => 'MA',
            ],
            'sameAs' => [
                // Add social media links if available
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'contactType' => 'Administration',
                'email' => 'crp@markaz-oujda.com',
            ],
        ];

        return json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Generate structured data (JSON-LD) for WebSite
     */
    public static function generateWebSiteSchema(): string
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => 'Centre de Ressources du Préscolaire',
            'url' => config('app.url'),
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => config('app.url') . '/documentation?search={search_term_string}',
                'query-input' => 'required name=search_term_string',
            ],
        ];

        return json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Generate structured data (JSON-LD) for Page
     */
    public static function generatePageSchema(array $data = []): string
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => $data['title'] ?? 'Centre de Ressources du Préscolaire',
            'description' => $data['description'] ?? 'Centre de Ressources du Préscolaire',
            'url' => $data['url'] ?? url()->current(),
        ];

        if (isset($data['breadcrumbs'])) {
            $schema['breadcrumb'] = [
                '@type' => 'BreadcrumbList',
                'itemListElement' => array_map(function ($index, $crumb) {
                    return [
                        '@type' => 'ListItem',
                        'position' => $index + 1,
                        'name' => $crumb['name'],
                        'item' => $crumb['url'],
                    ];
                }, array_keys($data['breadcrumbs']), $data['breadcrumbs']),
            ];
        }

        return json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}

