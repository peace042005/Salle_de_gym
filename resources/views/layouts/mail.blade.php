<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mails Notifications</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Barlow:wght@100;200;300;400;500;600;700;800;900&display=swap');

        body {
            /* width: 100% !important; */
            height: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
            font-family: 'Barlow', sans-serif;
        }

        table {
            border-collapse: collapse !important;
        }

        a {
            text-decoration: none !important;
        }

        @media (max-width: 800px) {
            .table-contain {
                width: 70% !important;
            }
        }

        @media (max-width: 500px) {
            .table-contain {
                width: 95% !important;
            }

            .copyright {
                font-size: 14px;
            }
        }
    </style>
</head>

<body style="background-color: #ffffff ; ">

    <table class="table-contain" border="0px" style="width: 60vw ; margin: 0px auto;" cellpadding="0" cellspacing="0">
        <!-- header -->
        <tr>
            <td style="text-align: center; background-color:transparent; padding-top: 40px;">
                <img width="100%" src="{{ asset('template/logo.png') }}" alt="" srcset="">
            </td>
        </tr>

        <!-- body -->
        @yield('content')

        <!-- footer -->
        <tr style="padding-left: 25px; padding-top: 40px;">
            <td style="padding-left: 30px; padding: 15px; background-color: #000; color: white; height: 60px;">
                <table style="width: 100%;">
                    <tr>
                        <td class="copyright"
                            style="padding-left: 10px; font-size: 16px; font-weight: 400; min-width: 180px;">
                            {{ env('APP_NAME') }}
                        </td>
                        
                        <td>
                            <table style=" font-size: 13px; font-weight:500 ;">
                                <tr>
                                    <td><img src="{{ asset('template/mail.png') }}" alt=""
                                            style="height: 1.5rem; width: 1.5rem;">
                                    </td>
                                    <td>contact@gymroom.info</td>
                                </tr>
                                <tr>
                                    <td style="padding-top: 8px !important; ">
                                        <img src="{{ asset('template/website.png') }}" alt=""
                                            style="height: 1.5rem; width: 1.5rem;">
                                    </td>
                                    <td style=" padding-top: 8px !important; font-weight: 500;">
                                        https://gymroom.com</td>
                                </tr>
                                <tr>
                                    <td style="padding-top: 8px !important; ">
                                        <img src="{{ asset('template/phone.png') }}" alt=""
                                            style="height: 1.5rem; width: 1.5rem;">
                                    </td>
                                    <td style=" padding-top: 8px !important; font-weight: 500;">+229 00 00 00 00</td>
                                </tr>
                                <tr>
                                    <td style="padding-top: 8px !important; ">
                                        <img src="{{ asset('template/location.png') }}" alt=""
                                            style="height: 1.5rem; width: 1.5rem;">
                                    </td>
                                    <td style=" padding-top: 8px !important; font-weight: 500;">Lot 0000 Cotonou, Bénin
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
