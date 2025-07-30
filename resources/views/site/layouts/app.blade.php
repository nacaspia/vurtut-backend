<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="airbnb, booking, city guide, directory, events, hotel booking, listings, marketing, places, restaurant, restaurant">
    <meta name="description" content="Guido - Directory & Listing HTML Template">
    <meta name="CreativeLayers" content="ATFN">
    <title>vurtut.com</title>
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
