<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Fitsense - Gym and Fitness HTML Template</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('template/application/images/favicon.ico') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('template/application/css/bootstrap.min.css') }}">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{ asset('template/application/css/owl.carousel.min.css') }}">
    <!-- LOADING FONTS AND ICONS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/application/rev/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/application/rev/fonts/font-awesome/css/font-awesome.css') }}">
    <!-- REVOLUTION STYLE SHEETS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/application/rev/css/rs6.css') }}">
    <!-- Simplebar CSS -->
    <link rel="stylesheet" href="{{ asset('template/application/css/simplebar.min.css') }}">
    <!-- Animation CSS -->
    <link rel="stylesheet" href="{{ asset('template/application/css/animations.min.css') }}">
    <!-- Magnefic Popup CSS -->
    <link rel="stylesheet" href="{{ asset('template/application/css/magnific-popup.min.css') }}">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('template/application/fonts/flaticon/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('template/application/fonts/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/application/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/application/fonts/themify-icons/themify-icons.css') }}">
    <!--  Style CSS -->
    <link rel="stylesheet" href="{{ asset('template/application/css/style.css') }}">
    <!--  Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('template/application/css/responsive.css') }}">
</head>

<body class="bg-dark">

    <!-- dynamically remplace the page content -->
    <div class="container">
        @yield('content')
    </div>



    <!--jquery js-->
    <!-- <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
    <script src="{{ asset('template/application/js/jquery.min.js') }}"></script>
    <!--bootstrap js-->
    <script src="{{ asset('template/application/js/bootstrap.min.js') }}"></script>
    <!--owl-carousal-->
    <script src="{{ asset('template/application/js/owl.carousel.min.js') }}"></script>
    <!--isotope js-->
    <script src="{{ asset('template/application/js/isotope.pkgd.min.js') }}"></script>
    <!--countTo js-->
    <script src="{{ asset('template/application/js/jquery.countTo.min.js') }}"></script>
    <!--Maginfic-Popup js-->
    <script src="{{ asset('template/application/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Animation JS -->
    <script src="{{ asset('template/application/js/wow.min.js') }}"></script>
    <!-- Rev Slider js -->
    <script src="{{ asset('template/application/rev/js/rbtools.min.js') }}"></script>
    <script src="{{ asset('template/application/rev/js/rs6.min.js') }}"></script>
    <script src="{{ asset('template/application/js/rev-custom.js') }}"></script>
    <!-- Mouse Follower js -->
    <script src="{{ asset('template/application/js/mouse-follower.js') }}"></script>
    <!-- Simplebar js -->
    <script src="{{ asset('template/application/js/simplebar.min.js') }}"></script>
    <!--custom js-->
    <script src="{{ asset('template/application/js/custom.js') }}"></script>
</body>

</html>