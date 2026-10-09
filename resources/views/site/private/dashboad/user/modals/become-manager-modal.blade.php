<div class="modal fade" id="showBecomeManagerModal" tabindex="-1" aria-labelledby="showBecomeManagerModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title">Devenir gérant de salle</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="close"><span aria-hidden="true"></span></button>
            </div>

            <div class="modal-body ">
                <p>En devenant gérant, vous pouvez publier vos salles de sport et vos équipements sur la plateforme, et suivre les abonnements et les achats de vos clients.</p>
            </div>

            <div class="modal-footer bg-light justify-content-center">
                <button class="btn btn-danger light me-2" data-bs-dismiss="modal" aria-label="close">
                    <i class="fas fa-times-circle"></i> Annuler la transaction
                </button>
                <button onclick="payement(
                        '{{ config('services.fedapay.manager_fee') }}', 
                        '<?php echo (auth()->user()->email); ?>', 
                        '<?php echo (auth()->user()->last_name); ?>', 
                        '<?php echo (auth()->user()->first_name); ?>',
                        'subscription',
                        '<?php echo (auth()->user()->id); ?>',
                        'null',
                        'null',
                        'null'
                    )" class="btn btn-success">
                    <i class="fas fa-check-circle"></i> Payer {{ config('services.fedapay.manager_fee') }} FCFA
                </button>
            </div>

        </div>
    </div>
</div>