<div class="modal fade" id="showDetailsModal{{$purchase->user->id}}" tabindex="-1" aria-labelledby="showDetailsModal{{$purchase->user->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title">Details sur l'équipement acheté</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="close"><span aria-hidden="true"></span></button>
            </div>

            <div class="modal-body">
                <div class="clearfix mb-3 d-flex">
                    <ul>
                        <li><strong>Nom de l'équipement: </strong>{{$purchase->outfit->name}}</li>
                        <li><strong>Montant de l'équipement: </strong>@include('shared.format.price', ['value' => $purchase->amount])</li>
                        <li><strong>Statu de réception:</strong>
                            @switch($purchase->status)
                            @case('completed') Déjà livré @break
                            @case('failed') Annulé@break
                            @default En attente
                            @endswitch
                        </li>
                        <li><strong>Date de l'achat:</strong> @include('shared.format.date', ['value' => $purchase->created_at])</li>
                    </ul>
                </div>
            </div>

            <div class="modal-footer bg-light justify-content-center">
                <button class="btn btn-primary me-2" data-bs-dismiss="modal" aria-label="close">
                    <i class="fas fa-times-circle"> </i> Ok! Fermer
                </button>
            </div>
        </div>
    </div>
</div>