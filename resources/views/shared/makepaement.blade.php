<!-- available subscriptions modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#availableSubsciption">M'enre gister à la salle</button>
<div class="modal fade" id="availableSubsciption" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content ">
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    @foreach($room->pricings as $pricing)
                    <div class="col-lg-3 mx-3">
                        <button onclick="payement(
                                '<?php echo ($pricing->id); ?>',
                                '<?php echo ($room->id); ?>',
                                'null',
                                '<?php echo ($authenticatedUser->id); ?>',
                                '<?php echo ($pricing->price); ?>', 
                                '<?php echo ($authenticatedUser->email); ?>', 
                                '<?php echo ($authenticatedUser->last_name); ?>', 
                                '<?php echo ($authenticatedUser->first_name); ?>'
                            )" class="btn btn-outline-primary">
                            Payer {{ $pricing->price }} FCFA
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>




<div class="d-flex justify-content-center">
    @foreach($room->pricings as $pricing)
    <div class="col-lg-3 mx-3">
        <button onclick="payement(
                                        '<?php echo ($pricing->id); ?>',
                                        '<?php echo ($room->id); ?>',
                                        'null',
                                        '<?php echo ($authenticatedUser->id); ?>',
                                        '<?php echo ($pricing->price); ?>', 
                                        '<?php echo ($authenticatedUser->email); ?>', 
                                        '<?php echo ($authenticatedUser->last_name); ?>', 
                                        '<?php echo ($authenticatedUser->first_name); ?>'
                                    )" class="btn btn-primary">
            Payer {{ $pricing->price }} FCFA
        </button>
    </div>
    @endforeach
</div>