<?php include './includes/view/partials/header.php' ?>
<?php include './includes/view/partials/navbar.php' ?>
<?php include './includes/view/partials/bg.php' ?>
 
<div class="container d-flex mt-5 align-items-center flex-column">

    <div class="bg-dark text-light m-2 p-4 col-6 d-flex flex-column align-items-center">
        <div class="h4">Reservation summary:</div>
        <div class="d-flex flex-column mt-4 align-items-center gap-2">
            <div>Check in: <?php echo $checkin ?> </div>
            <div>Check out: <?php echo $checkout ?> </div>
            <div>Nights: <?php echo $nights ?> </div>
            <div>Guests: <?php echo $guests ?> </div>
            <div>Room type: <?php echo $room_type ?> </div>
            <hr class="w-100">
            <div class="fw-bold">Total price: <?php echo $total ?>$ </div>
        </div>
    </div>

    <form action="process_booking_confirmation.php" class="p-5 rounded-3 login-form col-12 col-md-8 col-lg-6" method="post">

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
                        <?php for($i=date("Y");$i<=date("Y") + 10;++$i) : ?>
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
            <button type="submit" class="btn btn-primary mt-5">Confirm booking</button>
        </div>
    </form>

</div>

<?php include './includes/view/partials/footer.php' ?>