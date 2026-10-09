<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Fitsense - Gym and Fitness HTML Template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('template/favicon.ico') }}">
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

    <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>
</head>

<body>
    <!-- Loading -->
    <!-- <div id="pq-loading">
        <div id="pq-loading-center">
            <img src="{{ asset('template/application/images/logos/logo.png') }}" alt="loading">
        </div>
    </div> -->
    <!-- Loading -->

    <!-- importe the header.blade.php -->
    @include('layouts.partials.public.header')

    <!-- dynamically remplace the page content -->
    <div class="container">
        @yield('content')

        <!-- login modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <h5 class="modal-title">INSCRIPTION</h5> -->
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="close"><span aria-hidden="true"></span></button>
                    </div>
                    <div class="modal-body ">
                        <div class="text-center">
                            <h5 class="card-title my-3">CONNEXION</h5>
                            @if (Session::has('loginErrorMessage'))
                            <div class="alert alert-danger">{{ Session::get('loginErrorMessage')}}</div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-center">
                            <form method="POST" action="{{ route('doLogin') }}" class="row g-3">
                                @csrf
                                <input name="modal" value="true" type="text" hidden>
                                <div class="col-lg-12 mb-3">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Adresse mail :</label>
                                        <input name="email" value="{{old('email')}}" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Veuillez entrer votre mail...">
                                    </div>
                                    <span class="text-danger">
                                        @error('email')
                                        <small class="text-tiny">{{$message}}</small>
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Mot de passe :</label>
                                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Veuillez entrer votre mot de passe...">
                                    </div>
                                    <span class="text-danger">
                                        @error('password')
                                        <small class="text-tiny">{{$message}}</small>
                                        @enderror
                                    </span>
                                </div>

                                <!-- other field -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input type="checkbox" id="staty-connect">
                                            <label for="staty-connect">
                                                Rester connecter
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-end"><a href="{{ route('doRessetPassword') }}">Mot de passe oublié</a></p>
                                    </div>
                                </div>

                                <!-- submit boutton -->
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-2" type="submit">Se connecter</button>
                                </div>

                                <span class="text-end">Pas inscrire? <a href="{{ route('register') }}">Inscrivez-vous</a></span>
                            </form>
                        </div>
                    </div>
                    <!-- <div class="modal-footer justify-content-center">
                <button type="button"></button>
            </div> -->
                </div>
            </div>
        </div>
    </div>

    <!-- importe the footer.blade.php -->
    @include('layouts.partials.public.footer')



    <!--jquery js-->
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