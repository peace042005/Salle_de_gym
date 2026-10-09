<div class="modal fade" id="showSubscriptionDetailsModal{{$subscription->id}}" tabindex="-1" aria-labelledby="showSubscriptionDetailsModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title">Details sur mon abonement</strong>"</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="close"><span aria-hidden="true"></span></button>
            </div>

            <div class="modal-body ">
                <li>
                    <strong>Nom de l'abonnement:</strong> {{$subscription->pricing->name}}
                </li>
                <li>
                    <strong>Prix de l'abonnement:</strong> @include('shared.format.price', ['value' => $subscription->pricing->price])
                </li>
                <li>
                    <strong>Etat de l'abonnement:</strong>
                    @switch($subscription->status)
                        @case(true) Actif @break
                        @case(false) Innactif @break
                        @default En attente
                    @endswitch
                </li>
                <li>
                    <strong>DAte de création:</strong> @include('shared.format.date', ['value' => $subscription->created_at])
                </li>
            </div>

            <div class="modal-footer bg-light justify-content-center">
                <button class="btn btn-primary me-2" data-bs-dismiss="modal" aria-label="close">
                    <i class="fas fa-times-circle"> </i> Ok! Fermer
                </button>
            </div>

        </div>
    </div>
</div>