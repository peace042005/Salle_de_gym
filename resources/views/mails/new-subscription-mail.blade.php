@extends('layouts.mail')

@section('content')
    <tr style="width: 100%;">
        <td style="color: #5E5E5E; width: 100%; padding-left: 140px; padding-right: 140px; padding-top:20px ; padding-bottom: 35px; font-weight: 300; font-size: 25px;">
            Bonjour Mme/M. {{ $data['customer_info']['first_name'] }} {{ $data['customer_info']['last_name'] }},
        </td>
    </tr>

    <tr style="width: 100%;">
        <td style="color: #5E5E5E; width: 100%; padding-left: 140px; padding-right: 140px; padding-top:20px ; padding-bottom: 35px; font-weight: 300; font-size: 25px;">
            Nous sommes ravis de vous compter parmi nous.
            Votre abonnement est désormais actif et valide jusqu'à {{$data['subscription_info']['expiration_date']}}
        </td>
    </tr>

    <tr style="width: 100%;">
        <td style="color: #5E5E5E; width: 100%; padding-left: 20px; padding-top:18px ; font-weight: 300; font-size: 25px; padding-bottom: 120px;text-align: center;">
            Cordialement, l'équipe {{ env('APP_NAME') }}.
        </td>
    </tr>
@endsection
