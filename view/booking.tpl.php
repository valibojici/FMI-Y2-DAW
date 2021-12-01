<?php include './view/partials/header.php' ?>
<?php include './view/partials/navbar.php' ?>
<?php include './view/partials/bg.php' ?>

<?php if(!isset($_SESSION)) session_start(); ?>

<div class="container d-flex mt-5 justify-content-center">
    <form action="booking.php" class="p-5 rounded-3 login-form col-12 col-md-8 col-lg-5 col-xl-4" method="post">

        <div class="input-wrapper text-center">
            <div class="mt-3">Check in</div>
            <input type="date" id="checkin" name="checkin" class="p-1 w-100 user-select-none" value="<?php echo isset($_SESSION['booking_info']) ? $_SESSION['booking_info']['checkin'] : "" ?>">
        
            <div class="mt-3">Check out</div>
            <input type="date" id="checkout" name="checkout" class="p-1 w-100 user-select-none" value="<?php echo isset($_SESSION['booking_info']) ? $_SESSION['booking_info']['checkout'] : "" ?>">

            <div class="mt-3">Guests</div>
            <select name="guests" id="guests" class="p-1">
                <?php for($i = 1; $i <= 5; ++$i) : ?>
                    <option value=" <?php echo $i ?> " <?php if(isset($_SESSION['booking_info']) && $_SESSION['booking_info']['guests'] == $i) echo 'selected'?> ><?php echo $i ?></option>
                <?php endfor; ?>
            </select>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary mt-3">See available rooms</button>
        </div>
    </form>
</div>

<?php if(isset($available_types_error)) : ?>
    <div class="container p-5 bg-dark text-light mt-5">
            <div class="h4 p-0 m-0 text-center">
                <span>We're sorry, no rooms are available. Please change your check-in or check-out date or the number of guests.</span>
            </div>
    </div>
<?php elseif(isset($available_types)): ?>
    <div class="container p-5 text-light mt-5">
        
        <!-- loop types -->
        <?php foreach($available_types as $type => $values) : ?>
            <div class="bg-light p-3 m-4 text-dark row align-items-center rounded-3">
                <div class="carousel-container col-4">
                    <!-- carousel start -->
                    <div id="<?php echo str_replace(' ', '', $type) . '-carousel' ?>" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <!-- loop images -->
                            <?php foreach($values['imgs'] as $index => $img_src) : ?>
                                <div class="carousel-item <?php if($index === 0)echo "active"; ?>">
                                    <img src="<?php echo $img_src ?>" class="d-block w-100" alt="...">
                                </div>
                            <?php endforeach ?>
                            <!-- end loop images -->
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#<?php echo str_replace(' ', '', $type) . '-carousel' ?>" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#<?php echo str_replace(' ', '', $type) . '-carousel' ?>" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <!-- carousel end -->
                </div>

                <div class="col-8 bg-light text-dark p-3 border border-3">
                    <div class="h3 px-3"> <?php echo $type; ?> </div>
                    <hr>
                    <div class="px-3"> <?php echo $values['descriere'] ?> </div>
                    <div class="d-flex p-3 align-items-center justify-content-around flex-wrap gap-2">
                        <div class="">
                            <span class="fw-bold">Max. guests: </span>
                            <span> <?php echo $values['capacitate'] ?> </span>
                        </div>
                        <div class="">
                            <span class="fw-bold">Cost per night: </span>
                            <span> <?php echo $values['pret'] ?>$ </span>
                        </div>
                        <div class="text-danger">
                            <span class="fw-bold">Total cost for <?php echo $values['nopti'] . ' night' . ($values['nopti'] > 1 ? 's' : '') ?> : </span>
                            <span> <?php echo $values['total'] ?>$</span>
                        </div>
                    </div>

                    <form class="d-flex justify-content-center" method="post" action="process_booking.php">
                        <input type="hidden" name="room_type" value="<?php echo $type ?>">
                        <button class="btn btn-lg btn-success me-4 choose-button" type="submit">Choose room</button>
                    </form>
                </div>

            </div>  
        <?php endforeach ?>
        <!-- end loop types -->

    </div>
<?php endif ?>

<?php include './view/partials/footer.php' ?>

<script src="./view/js/booking.js"></script>