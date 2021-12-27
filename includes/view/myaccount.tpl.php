<?php include './includes/view/partials/header.php' ?>
<?php include './includes/view/partials/navbar.php' ?>
<?php include './includes/view/partials/bg.php' ?>

<div class="container mt-5 user-info-container p-5">
    <div class="title h1">My account</div>
    <div class="user-info-inner-container">
        <div class="mt-4" >First name: <?php echo $firstname; ?> </div>
        <div class="mt-4">Last name: <?php echo $lastname; ?> </div>
        <div class="mt-4">Phone number: <?php echo $phone; ?> </div>
        <div class="mt-4">Email: <?php echo $email; ?> </div>
    </div>
</div>

<div class="container mt-5 user-info-container p-5">
    <div class="title h1">My reservations</div>
    <div class="user-info-inner-container">
        <?php if(count($reservations) == 0): ?>
            <div>You have no reservations.</div>
        <?php else: ?>
            <?php foreach($reservations as $key => $reservation): ?>
                <div class="p-3 mt-3 bg-dark text-light d-flex align-items-center justify-content-around">
                    <!-- check in -->
                    <div class="d-flex flex-column align-items-center">
                        <div class="m-1 text-center">Check in:</div>
                        <?php  echo date('d M Y' , strtotime($reservation['check_in'])) ?> 
                    </div>

                    <!-- check out -->
                    <div class="d-flex flex-column align-items-center" >
                        <div class="m-1 text-center">Check out:</div>
                        <div>  <?php echo date('d M Y' , strtotime($reservation['check_out'])) ?>  </div>
                    </div>

                    <!-- nr pers -->
                    <div class="d-flex flex-column align-items-center">
                        <div class="m-1 text-center">Guests:</div>
                        <div> <?php echo $reservation['nr_pers'] ?> </div>
                    </div>

                    <!-- room type -->
                    <div class="d-flex flex-column align-items-center">
                        <div class="m-1 text-center">Room type: </div>
                        <div> <?php echo $reservation['room_type'] ?>  </div>
                    </div>

                    <!-- room no -->
                    <div class="d-flex flex-column align-items-center">
                        <div class="m-1 text-center">Room number: </div>
                        <div> <?php echo $reservation['room_no'] ?> </div>
                    </div>
                    
                    <!-- total -->
                    <div class="d-flex flex-column align-items-center">
                        <div class="m-1 text-center">Total:</div>
                        <div> <?php echo $reservation['suma_plata'] ?>$ </div>
                    </div>
                    
                    <!-- message / cancel button -->
                    <?php if($reservation['status'] == 1): ?>
                        <div class="col-3 text-success fw-bold"> We hope you enjoyed your stay! </div>
                    <?php elseif($reservation['status'] == -1): ?>
                        <div class="text-center col-3 text-danger fw-bold"> Reservation not completed, you didn't check in. </div>
                    <?php elseif($reservation['status'] == 0): ?>
                        <div class="m-3 d-flex flex-column align-items-center col-3 fw-bold">
                            <div class="text-center my-2 text-wrap"> Reservation not completed yet, we are waiting for you. </div>
                            <?php if($reservation['can_cancel']): ?>
                                <form action="cancel_reservation.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $reservation['id'] ?>">
                                    <button class="btn btn-danger" type="submit" >Cancel Reservation</button>
                                </form>
                            <?php endif ?>
                        </div>
                    <?php endif ?>

                    <!-- pdf button -->
                    <a class="btn btn-success p-2 btn-sm d-flex flex-column" href="invoice.php?id=<?php echo $reservation['id'] ?>">
                        <span>Download</span>
                        <span>Invoice</span>
                    </a>

                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>

<?php include './includes/view/partials/footer.php' ?>