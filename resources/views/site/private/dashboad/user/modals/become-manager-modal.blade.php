<div class="modal fade" id="showBecomeManagerModal" tabindex="-1" aria-labelledby="showBecomeManagerModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title">Changer de status : Devenir un MAGANER</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="close"><span aria-hidden="true"></span></button>
            </div>

            <div class="modal-body ">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio corporis deleniti aliquid? Praesentium architecto pariatur tenetur harum veniam voluptatem sint. Quam, quod labore tenetur consectetur culpa in accusamus temporibus rem!</p>
            </div>

            <div class="modal-footer bg-light justify-content-center">
                <button class="btn btn-danger light me-2" data-bs-dismiss="modal" aria-label="close">
                    <i class="fas fa-times-circle"></i> Annuler la transaction
                </button>
                <button onclick="payement(
                        '30000', 
                        '<?php echo (auth()->user()->email); ?>', 
                        '<?php echo (auth()->user()->last_name); ?>', 
                        '<?php echo (auth()->user()->first_name); ?>',
                        'subscription',
                        '<?php echo (auth()->user()->id); ?>',
                        'null',
                        'null',
                        'null'
                    )" class="btn btn-success">
                    <i class="fas fa-check-circle"></i> Payer 30000 FCFA
                </button>
            </div>

        </div>
    </div>
</div>