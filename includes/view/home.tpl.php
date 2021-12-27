<?php include './includes/view/partials/header.php' ?>
<?php include './includes/view/partials/navbar.php' ?>
<?php include './includes/view/partials/bg.php' ?>


<div class="title-container">
    <div class="text-light text-center my-5" id="hotel-name">Hillside Hotel</div>
    <div class="text-center">
        <a class='book-button btn px-5 py-4' href="./booking.php">Book now</a>
    </div>
</div>

<div class="container my-5 " id='home-container'>
    <div id='description' class="p-3">
        <div>
            <div class="row pt-5 justify-content-center">
                <div class="col-2 col-lg-4 line"></div>
                <div class="col-5 col-lg-2 fs-3 text-light text-center">THE HOTEL</div>
                <div class="col-2 col-lg-4 line"></div>
            </div>
            <p class="fs-5 p-3 text-center">
                Located on the historic California cable car line and only a short walk to Union Square, the Embarcadero, Chinatown, the Ferry Building, and Fisherman’s Wharf, the Omni San Francisco is at the center of the city and provides a true respite for travelers with luxury accommodations and modern comforts. 
            </p>
        </div>

        <div>
        <div class="row pt-5 justify-content-center">
                <div class="col-2 col-lg-4 line"></div>
                <div class="col-5 col-lg-2 fs-3 text-light text-center">LOCATION</div>
                <div class="col-2 col-lg-4 line "></div>
            </div>
            <p class="fs-5 p-3  text-center">
                Situated in the heart of downtown, Hillside Hotel is located near world-class shopping, restaurants, arts districts and the cable car lines that make the city famous. Whether you are visiting for family fun, a staycation, business or romance, make your trip extra special with one of our packages. 
            </p>
            
        </div>
    </div>
</div>


<div class="container my-5" id='room-container'>
    <div id='description' class="p-3">
        <div>
            <div class="row pt-5 justify-content-center">
                <div class="col-2 col-lg-4 line"></div>
                <div class="col-5 col-lg-2 fs-3 text-center">ROOMS</div>
                <div class="col-2 col-lg-4 line"></div>
            </div>
            <p class="fs-5 p-3 text-center">
                All our guestrooms are elegantly furnished with handmade furniture include luxury en-suite facilities with complimentary amenities pack, flat screen LCD TV, tea/coffee making facilities, fan, hairdryer and the finest pure white linen and towels.
            </p>

            <div class="room-images-container row justify-content-center">
                <?php if(isset($room_img_src)): ?>
                    <?php foreach($room_img_src as $key => $src): ?>
                        <div class="col">
                            <img src="<?php echo $src ?>" alt="" class="img-fluid">
                        </div>
                    <?php endforeach; ?>
                <?php endif ?>
            </div>

            <div class="text-center mt-5">
                <a href="./rooms.php" class="btn px-5 py-3 text-light">Learn More About Our Rooms</a>
            </div>
        </div>
    </div>
</div>

<?php include './includes/view/partials/footer.php' ?>