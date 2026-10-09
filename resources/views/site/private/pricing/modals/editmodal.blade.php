<div class="modal fade" id="updateModal{{ $pricing->id }}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <form method="POST" action="{{ route('management.pricing.update', $pricing->id) }}" class="row g-3">
        @csrf
        @method('PUT')
        
        <div class="modal-dialog modal-default">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title">Modifier le type d'abonnement</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="close"><span aria-hidden="true"></span></button>
                </div>

                <div class="modal-body">
                    <div class="col-lg-12 mb-3">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom de l'abonnement :</label>
                            <input name="name" value="{{ $pricing->name }}" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Le titre de l'abonnement" required>
                        </div>
                        <span class="text-danger">
                            @error('name')
                            <small class="text-tiny">{{$message}}</small>
                            @enderror
                        </span>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <div class="mb-3">
                                <label for="price" class="form-label">Prix (en Fcfa):</label>
                                <input name="price" value="{{ $pricing->price }}" type="number" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Le prix de l'abonnement" required>
                            </div>
                            <span class="text-danger">
                                @error('price')
                                <small class="text-tiny">{{$message}}</small>
                                @enderror
                            </span>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div class="mb-3">
                                <label for="duration" class="form-label">Périod (en jours) :</label>
                                <input name="duration" value="{{ $pricing->duration }}" type="number" class="form-control @error('duration') is-invalid @enderror" id="duration" placeholder="La durée de l'abonnement" required>
                            </div>
                            <span class="text-danger">
                                @error('duration')
                                <small class="text-tiny">{{$message}}</small>
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light justify-content-center">
                    <button class="btn btn-danger light me-2" data-bs-dismiss="modal" aria-label="close">
                        <i class="fas fa-times-circle"></i> Annuler les modifications
                    </button>
                    <button class="btn btn-success" type="submit" data-bs-toggle="modal" data-bs-target="#modalcenter">
                        <i class="fas fa-check-circle"></i> Valider les modifications
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>