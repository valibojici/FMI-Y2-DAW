<?php include './includes/view/partials/header.php' ?>
<?php include './includes/view/partials/navbar.php' ?>
<?php include './includes/view/partials/bg.php' ?>
 
 
<div class="mx-auto row mt-2 justify-content-center p-2 gap-2">

    <div class="mt-5 col-12 row justify-content-center gap-2 p-0">
        <!-- reservation summary -->
        <div class="bg-dark text-light p-3 d-flex flex-column align-items-center rounded-2 col-md-4 col-xl-3">
            <div class="h4 text-center">Reservation summary:</div>
            <div class="d-flex flex-column align-items-center gap-2">
                <div>Check in: <?php echo $checkin ?> </div>
                <div>Check out: <?php echo $checkout ?> </div>
                <div>Nights: <?php echo $nights ?> </div>
                <div>Guests: <?php echo $guests ?> </div>
                <div>Room type: <?php echo $room_type ?> </div>
                <hr class="w-100">
                <div class="fw-bold">Total price: <?php echo $total ?>$ </div>
            </div>
        </div>
        <!-- end reservation summary -->

        <!-- exchange rates -->
        <div class="border bg-custom-light rounded-2 p-3 text-center col-md-4 col-xl-3">
            <h2>Exchange Rates</h2>
            <?php foreach($exchange_rates as $k => $v): ?>
                <div class="mt-2">
                    1 <?php echo $k ?> (<?php echo $v[0]; ?>) = <?php echo $v[1]; ?> RON
                </div>
            <?php endforeach ?>
            <hr>
            <div class="text-center">
                <div>
                    <?php echo $total ?> USD ~ <?php echo round($total * $exchange_rates['USD'][1]) ?> RON 
                </div>
                <?php foreach(array_slice($exchange_rates,1) as $k => $v): ?>
                    <div>
                        <?php echo $total ?> USD ~ <?php echo round($total * $exchange_rates['USD'][1] / $v[1]) ?> <?php echo $k ?>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <!-- end exchange rates -->
    </div>

    <form action="process_booking_confirmation.php" class="p-3 rounded-3 login-form col-md-8 col-xl-5 col-xxl-4" method="post">

        <div class="input-wrapper m-3">
            <div class="mt-3">Card number</div>
            <input type="text" id="card" name="card" class="p-1" pattern="\d{16}" size="16" maxlength="16" style="letter-spacing: 3px;">

            <div class="row">
                <div class="col-4">
                    <div class="mt-3">Exp. month</div>
                    <select name="month" class="w-100" size='1'>
                        <option selected disabled hidden size='1'>Choose here</option>
                        <?php for($i=1;$i<=12;++$i) : ?>
                            <option value="<?php echo $i ?>" size='1' > <?php echo $i ?> </option>
                        <?php endfor ?>
                    </select>
                </div>
                
                <div class="col-4">
                    <div class="mt-3">Exp. Year</div>
                    <select name="year" class="w-100">
                        <option selected disabled hidden>Choose here</option>
                        <?php for($i=date("Y");$i<=date("Y") + 5;++$i) : ?>
                            <option value="<?php echo $i ?>"> <?php echo $i ?> </option>
                        <?php endfor ?>
                    </select>
                </div>

                <div class="col-4 position-relative">
                    <div class="mt-3">Security code</div>
                    <input type="text" id="cvv" name="cvv" class="p-1 d-inline" maxlength="3" pattern="\d{3}" size="3" >
                </div>
            </div>     
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-pink text-light mt-5">Confirm booking</button>
        </div>
    </form>

</div>

<?php include './includes/view/partials/footer.php' ?>