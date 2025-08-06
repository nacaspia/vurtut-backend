<!DOCTYPE html>
<html dir="ltr" lang="az">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Saytın başlığı -->
    <title>Vurtut - Hamısı bir ünvanda! Restoran, salon, otel və daha çox xidmət</title>

    <!-- Açar sözlər -->
    <meta name="keywords" content="Vurtut, xidmət platforması, restoran rezervasiyası, salon sifarişi, otel bronlama, biznes siyahısı, müştəri tapmaq, online rezervasiya, marketplace, Azərbaycan, yerli bizneslər">

    <!-- Təsvir (SEO üçün) -->
    <meta name="description" content="Vurtut – restoran, otel, salon və digər xidmət sahələrini bir araya gətirən onlayn platforma. Məkanını əlavə et, görünürlük qazan, müştəri tap. İlk ay ödənişsiz!">

    <!-- Müəllif -->
    <meta name="author" content="Vurtut Team">

    <!-- Open Graph (Facebook, LinkedIn və s. üçün) -->
    <meta property="og:title" content="Vurtut - Hamısı bir ünvanda!">
    <meta property="og:description" content="Restoran, salon, otel və digər məkanlar üçün onlayn rezervasiya, görünürlük və müştəri qazanmaq imkanı.">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vurtut">
    <meta property="og:url" content="https://vurtut.com">
    <meta property="og:image" content=""{{ asset("site/images/Vurtut logo icon/Vurtut.com.ico") }}"> <!-- bunu öz logo/banner linkinlə əvəz et -->

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Vurtut - Hamısı bir ünvanda!">
    <meta name="twitter:description" content="Xidmət biznesinizi onlayn görünən və rezervasiya alan bir formata çevirin.">
    <meta name="twitter:image" content=""{{ asset("site/images/Vurtut logo icon/Vurtut.com.ico") }}"> <!-- eyni şəkli buraya da əlavə et -->
    <meta name="twitter:site" content="@vurtut"> <!-- əgər Twitter varsa -->

    <!-- Canonical -->
    <link rel="canonical" href="https://vurtut.com">
    <link href="{{ asset("site/images/Vurtut logo icon/Vurtut.com.ico") }}" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
    <link href="{{ asset("site/images/Vurtut logo icon/Vurtut.com.ico") }}" sizes="128x128" rel="shortcut icon" />
    @yield('site.css')
</head>
<body>
<div class="wrapper">
    <div class="preloader"></div>
    <x-site.header />
    @yield('site.content')
    <!-- wrapper end-->
<x-site.footer />
