<?php include './includes/view/partials/header.php' ?>
<?php include './includes/view/partials/navbar.php' ?>
<?php include './includes/view/partials/bg.php' ?>

<div class="container px-0">
    <div class="mt-5 user-info-container py-3 text-center text-md-start mx-1 px-md-4 py-md-4">
        <div class="title h1">My account</div>
        <div class="user-info-inner-container">
            <div class="mt-4" >First name: <?php echo $firstname; ?> </div>
            <div class="mt-4">Last name: <?php echo $lastname; ?> </div>
            <div class="mt-4">Phone number: <?php echo $phone; ?> </div>
            <div class="mt-4">Email: <?php echo $email; ?> </div>
        </div>
    </div>
</div>

<div class="container px-1" >
    <div class="container mt-5 bg-custom-light py-3 mx-0">
        <div class="h1 text-center">My reservations</div>
        
        <div class="px-1 px-md-4">
            <?php if(count($reservations) == 0): ?>
                <div>You have no reservations.</div>
            <?php else: ?>
                <?php foreach($reservations as $key => $reservation): ?>
                    <div class="bg-dark text-light row justify-content-center my-5 py-3">
                    
                        <!-- reservation info container -->
                        <div class="row col-12">
                            <!-- check in -->
                            <div class="d-flex flex-column align-items-center my-2 col-6 col-md-4 col-lg-2">
                                <div class="m-1 text-center">Check in:</div>
                                <?php  echo date('d M Y' , strtotime($reservation['check_in'])) ?> 
                            </div>
                            
                            <!-- check out -->
                            <div class="d-flex flex-column align-items-center my-2 col-6 col-md-4 col-lg-2">
                                <div class="m-1 text-center">Check out:</div>
                                <div>  <?php echo date('d M Y' , strtotime($reservation['check_out'])) ?>  </div>
                            </div>
                            
                            <!-- nr pers -->
                            <div class="d-flex flex-column align-items-center my-2 col-6 col-md-4 col-lg-2">
                                <div class="m-1 text-center">Guests:</div>
                                <div> <?php echo $reservation['nr_pers'] ?> </div>
                            </div>
                            
                            <!-- room type -->
                            <div class="d-flex flex-column align-items-center my-2 col-6 col-md-4 col-lg-2">
                                <div class="m-1 text-center">Room type: </div>
                                <div> <?php echo $reservation['room_type'] ?>  </div>
                            </div>
                            
                            <!-- room no -->
                            <div class="d-flex flex-column align-items-center my-2 col-6 col-md-4 col-lg-2">
                                <div class="m-1 text-center">Room number: </div>
                                <div> <?php echo $reservation['room_no'] ?> </div>
                            </div>
                            
                            <!-- total -->
                            <div class="d-flex flex-column align-items-center my-2 col-6 col-md-4 col-lg-2">
                                <div class="m-1 text-center">Total:</div>
                                <div> <?php echo $reservation['suma_plata'] ?>$ </div>
                            </div>
                        </div>
                        <!-- end reservation info container -->
                            
                        <!-- message / button container -->
                        <div class="row mt-4 justify-content-center gap-5 align-items-center">
                            <!-- message / cancel button -->
                            <?php if($reservation['status'] == 1): ?>
                                <!-- ok -->
                                <div class="col-12 col-md-6 col-lg-3 text-success fw-bold text-center mt-2 row align-items-center"> We hope you enjoyed your stay! </div>
                            <?php elseif($reservation['status'] == -1): ?>
                                <!-- rezervation not completed, not checked in -->
                                <div class="col-12 col-md-6 col-lg-3 text-danger fw-bold mt-2 row align-items-center text-center "> Reservation not completed, you didn't check in. </div>
                            <?php elseif($reservation['status'] == 0): ?>
                                <!-- rezervation not completed, not checked in yet -->  
                                <div class="col-12 col-md-6 row justify-content-center fw-bold">
                                    <div class="text-center my-2 text-wrap col-12"> Reservation not completed yet, we are waiting for you. </div>
                                    <?php if($reservation['can_cancel']): ?>
                                        <!-- cancel form -->
                                        <form action="cancel_reservation.php" method="post" class="my-2 row justify-content-center col-12">
                                            <input type="hidden" name="id" value="<?php echo $reservation['id'] ?>">
                                            <button class="btn btn-danger col-12 col-md-6 col-lg-4" type="submit" >Cancel Reservation</button>
                                        </form>
                                    <?php endif ?>
                                </div>
                            <?php endif ?>
                                            
                            <!-- pdf button -->
                            <a class="btn btn-success col-12 col-md-4 col-lg-2" href="invoice.php?id=<?php echo $reservation['id'] ?>">
                                <span>Download</span>
                                <span>Invoice</span>
                            </a>
                        </div>
                        <!-- end message  / button container -->
                        
                    </div>
                    <!-- end reservation container -->
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>                          
</div>

<?php include './includes/view/partials/footer.php' ?>