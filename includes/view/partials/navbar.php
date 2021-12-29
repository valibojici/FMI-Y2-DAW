<?php if(!isset($_SESSION)) session_start(); ?>

<nav class="navbar navbar-expand-xl navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand me-4 fs-4" href="./index.php">Hillside Hotel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"     aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <div class="navbar-nav align-items-center">
                <a class="nav-item nav-link m-2 p-2 text-center" href="index.php"> Home </a>
                <a class="nav-item nav-link m-2 p-2 text-center" href="rooms.php"> Rooms </a>
                <a class="nav-item nav-link m-2 p-2 text-center" href="facilities.php"> Facilities </a>
                <a class="nav-item nav-link m-2 p-2 text-center" href="booking.php"> Booking </a>
                <a class="nav-item nav-link m-2 p-2 text-center" href="about_contact.php"> About Us & Contact </a>
                <a class="nav-item nav-link m-2 p-2 text-center" href="comments.php"> Comments </a>

                <?php if(isset($_SESSION['loggedin'])) : ?>
                    <a class="nav-item nav-link m-2 p-2 text-center" href="myaccount.php"> My account </a>
                    <a class="nav-item nav-link m-2 p-2 text-center" href="logout.php"> Logout </a>
                <?php else : ?>
                    <a class="nav-item nav-link m-2 p-2 text-center" href="signup.php"> Sign Up </a>
                    <a class="nav-item nav-link m-2 p-2 text-center" href="login.php"> Login </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>