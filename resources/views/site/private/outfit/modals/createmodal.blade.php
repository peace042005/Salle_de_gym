<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <form method="POST" action="{{ route('management.outfit.store') }}" enctype="multipart/form-data" class="row g-3">
        @csrf
        @method('POST')
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title">Ajouter un équipement</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="close"><span aria-hidden="true"></span></button>
                </div>

                <div class="modal-body ">
                    <div class="row">

                        <div class="row">
                            <div class="col-lg-8 mb-3">
                            @include('shared.form.input', [ 'label' => "Nom de l'équipement", 'name' => "name", 'type' => "text", 'placeholder' => "Entrer le nom de l'équipement"])
                            </div>

                            <div class="col-lg-4">
                            @include('shared.form.input', [ 'label' => "Prix de vente (Fcfa)", 'name' => "sale_price", 'type' => "number", 'placeholder' => "Entrer le prix de l'équipement"])
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-8 mb-3">
                                <!-- @include('shared.form.input', ['label' => "Image de couverture", 'name' => "cover_image", 'type' => "file"]) -->
                                @include('shared.form.fileimage', [
                                    'label' => 'Image de couverture',
                                    'name' => 'cover_image',
                                ])
                            </div>

                            <div class="col-lg-4 mb-3 form-check form-switch">
                                <br><br>
                                @include('shared.form.checkswitch', [ 'label' => 'Disponible?', 'name' => 'status' ] )
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3">
                            @include('shared.form.textarea', [ 'label' => "Description", 'name' => "description", 'placeholder' => "Entrer une description"])
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light justify-content-center">
                    <button class="btn btn-danger light me-2" data-bs-dismiss="modal" aria-label="close">
                        <i class="fas fa-times-circle"> </i> Annuler l'ajout
                    </button>
                    <button class="btn btn-success" type="submit" data-bs-toggle="modal" data-bs-target="#modalcenter">
                        <i class="fas fa-check-circle"></i> Oui, ajouter !
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>