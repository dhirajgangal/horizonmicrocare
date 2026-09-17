@php
    $pageTitle = $title ?? $site->get('seo.default_title');
    $metaDescription = $description ?? $site->get('seo.default_description');
    $canonical = $canonical ?? url()->current();
    $ogImage = isset($ogImage) ? $ogImage : $site->logoUrl();
@endphp

<title>{{ $pageTitle }} | {{ $site->get('general.company_name') }}</title>
<meta name="description" content="{{ $metaDescription }}">
<link rel="canonical" href="{{ $canonical }}">
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $pageTitle }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
