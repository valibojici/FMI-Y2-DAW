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
                <div class="p-3 mt-3 bg-dark text-light ">
                    <div>Check in: <?php echo $reservation['check_in'] ?> </div>
                    <div>Check out: <?php echo $reservation['check_out'] ?> </div>
                    <div>Guests: <?php echo $reservation['nr_pers'] ?> </div>
                    <div>Room type: <?php echo $reservation['room_type'] ?> </div>
                    <div>Room number: <?php echo $reservation['room_no'] ?> </div>
                    <div>Total: <?php echo $reservation['suma_plata'] ?>$ </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>

<?php include './includes/view/partials/footer.php' ?>