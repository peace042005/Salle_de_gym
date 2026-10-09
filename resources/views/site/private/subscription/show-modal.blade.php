<div class="modal fade" id="showSubscriptionDetailsModal{{$user->id}}" tabindex="-1" aria-labelledby="showSubscriptionDetailsModal{{$user->id}}" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title">{{ $user->first_name }} {{ $user->last_name }} | Details des abonements</strong>"</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="close"><span aria-hidden="true"></span></button>
            </div>

            <div class="modal-body ">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Inventore in nemo omnis accusamus deserunt minus eveniet maiores itaque a quasi officiis, optio blanditiis voluptate. Voluptatum veniam delectus non eum suscipit?</p>

                <div class="table">
                    <div class="table-responsive">
                        <table class="table table-striped table-responsive-sm">
                            <thead>
                                <tr>
                                    <th class="text-start">#</th>
                                    <th class="text-start">Nom de la salle</th>
                                    <th class="text-start">Nom de l'abonnement</th>
                                    <th class="text-start">Validité de l'abonnement</th>
                                    <th class="text-start">D'ate de l'abonnement</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->subscriptions as $subscription)
                                <tr>
                                    <td class="text-start">{{ $loop->index + 1 }}</td>
                                    <td class="text-start">{{ $subscription->room->name }}</td>
                                    <td class="text-start">{{ $subscription->pricing->name }}</td>
                                    <td class="text-start">{{ $subscription->pricing->duration }} jours</td>
                                    <td class="text-start">@include('shared.format.date', ['value' => $subscription->created_at])</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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