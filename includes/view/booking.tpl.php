<?php include './includes/view/partials/header.php' ?>
<?php include './includes/view/partials/navbar.php' ?>
<?php include './includes/view/partials/bg.php' ?>

<div class="container d-flex mt-5 justify-content-center">
    <form action="booking.php" class="p-5 rounded-3 login-form col-12 col-md-8 col-lg-5 col-xl-4" method="post">

        <div class="input-wrapper text-center">
            <div class="mt-3">Check in</div>
            <input type="date" id="checkin" name="checkin" class="p-1 w-100 user-select-none" value="<?php echo isset($booking_info) ? $booking_info['checkin'] : "" ?>">
        
            <div class="mt-3">Check out</div>
            <input type="date" id="checkout" name="checkout" class="p-1 w-100 user-select-none" value="<?php echo isset($booking_info) ? $booking_info['checkout'] : "" ?>">

            <div class="mt-3">Guests</div>
            <select name="guests" id="guests" class="p-1">
                <?php for($i = $min_guests; $i <= $max_guests; ++$i) : ?>
                    <option value=" <?php echo $i ?> " <?php if(($booking_info['guests'] ?? null) == $i) echo 'selected' ?> ><?php echo $i ?></option>
                <?php endfor; ?>
            </select>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-pink mt-3 text-light">See available rooms</button>
        </div>
    </form>
</div>

<?php if(isset($available_types_error)) : ?>
    <div class="container p-5 bg-dark text-light mt-5">
            <div class="h4 p-0 m-0 text-center">
                <span>We're sorry, no rooms are available. Please change your check-in or check-out date or the number of guests.</span>
            </div>
    </div>
<?php elseif(isset($booking_info)): ?>
    <div class="container text-light mt-5">
        
        <!-- loop types -->
        <?php foreach($available_types as $type => $values) : ?>
            <div class="bg-light mx-1 text-dark row align-items-center rounded-3 my-5 p-lg-4">
                <div class="carousel-container col-12 col-lg-6 col-xl-5 p-0">
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

                <div class="col-12 col-lg-6 col-xl-7 bg-light text-dark my-1 p-3 p-lg-4">
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
                            <span class="fw-bold">Total cost for <?php echo $booking_info['nights'] . ' night' . ($booking_info['nights'] > 1 ? 's' : '') ?> : </span>
                            <span> <?php echo $values['total'] ?>$</span>
                        </div>
                    </div>

                    <form class="row justify-content-center" method="post" action="process_booking.php">
                        <input type="hidden" name="room_type" value="<?php echo $type ?>">
                        <button class="btn btn-lg btn-success col-8 col-lg-6 col-xl-4 py-1 px-2 py-xl-3 px-xl-4 my-xl-3 choose-button" type="submit">Choose room</button>
                    </form>
                </div>

            </div>  
        <?php endforeach ?>
        <!-- end loop types -->

    </div>
<?php endif ?>

<?php include './includes/view/partials/footer.php' ?>

<script src="./js/booking.js"></script>