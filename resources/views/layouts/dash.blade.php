<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>@yield('title') | Gym Room Dashboard</title>

    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('template/favicon.ico') }}">
    <!-- Custom Stylesheet -->
    <link href="{{ asset('template/dashboad/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/dashboad/vendor/select2/css/select2.min.css') }}"  rel="stylesheet">
    <link href="{{ asset('template/dashboad/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('template/dashboad/css/style.css') }}" rel="stylesheet">

    <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>
    
    @stack('style')
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('sweetalert::alert')
    
    <!-- dynamically remplace the page content -->
    <div id="main-wrapper">
        @include('layouts.partials.private.header')

        @include('layouts.partials.private.aside')

        <div class="content-body" style="min-height: 735px;">
            <!-- show session msg -->
            <!-- @if(session()->has('creatSucessifullMessage'))
            <div class="alert alert-success text-white">
                {{ session()->get('creatSucessifullMessage') }}
            </div>
            @endif -->

            @yield('content')
        </div>
    </div>

    {{-- footer --}}
    <div class="footer">
        <div class="copyright">
            <p>Copyright © Designed &amp; Developed by <a href="../index.htm" target="_blank">DexignLab</a> 2021</p>
        </div>
    </div>


    <!-- Required vendors -->
    <script src="{{ asset('template/dashboad/vendor/global/global.min.js') }}"></script>
    
    {{-- sweet-alert --}}
    <script src="{{ asset('template/dashboad/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('template/dashboad/js/plugins-init/sweetalert.init.js') }}"></script>

    <script src="{{ asset('template/dashboad/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('template/dashboad/vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('template/dashboad/js/plugins-init/select2-init.js') }}"></script>

    <script src="{{ asset('template/dashboad/js/custom.min.js') }}"></script>
    <script src="{{ asset('template/dashboad/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('template/dashboad/js/demo.js') }}"></script>
    <script src="{{ asset('template/dashboad/js/styleSwitcher.js') }}"></script>



<script type="text/javascript">
    function setCookie(name, value, delay) {
        var expires = "";

        if (delay) {
            var date = new Date();
            date.setTime(date.getTime() + (delay * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    function payement(
        transAmount, transUserEmail, transUserLastname, transUserFirstname,
        option, userId, pricingId, roomId, outfitId
    ) {
        let widget = FedaPay.init({
            public_key: '<?php echo (env('FEDAPAY_PUBLIC_KEY')); ?>',
            transaction: {
                amount: transAmount,
                description: 'Acheter mon produit',
                custom_metadata: {
                    "option": option,
                    "pricing_id": pricingId,
                    "room_id": roomId,
                    "outfit_id": outfitId,
                    "user_id": userId,
                },
            },
            customer: {
                email: transUserEmail,
                lastname: transUserLastname,
                firstname: transUserFirstname,
            },
            onComplete(response) {
                if (response.transaction.status === "approved") {
                    setCookie('approuvedTransaction', JSON.stringify(response.transaction), 1)
                    // localStorage.setItem('transaction', JSON.stringify(response.transaction));
                    location.reload();
                }
            }
        });

        widget.open();
    }
</script>
    @stack('script')
</body>

</html>