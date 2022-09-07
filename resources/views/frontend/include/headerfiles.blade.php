<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Glasschweiz | Home</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="@yield('meta_description')">
    <meta name="title" content="@yield('meta_title')">
    <meta name="keywords" content="@yield('meta_keywords')">


    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontendassets/images/favicon.ico')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontendassets/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('frontendassets/css/slicknav.css')}}">
    <!-- <link rel="stylesheet" href="css/jquery.fancybox.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontendassets/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('frontendassets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontendassets/css/responsive.css')}}">

    <meta name="google-signin-client_id" content="523174149326-vdd9cl1gkavbcqpo6peaavh4ckqpl60e.apps.googleusercontent.com">
    <!--<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>  -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    
    
</head>

<body>