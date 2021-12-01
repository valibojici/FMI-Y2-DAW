<?php if(!isset($_SESSION)) session_start(); ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand me-5 fs-3" href="./index.php">Hillside Hotel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"     aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <div class="navbar-nav align-items-center">
                <a class="nav-item nav-link m-2 p-2 fs-5" href="index.php"> Home </a>
                <a class="nav-item nav-link m-2 p-2 fs-5" href="rooms.php"> Rooms </a>
                <a class="nav-item nav-link m-2 p-2 fs-5" href="facilities.php"> Facilities </a>
                <a class="nav-item nav-link m-2 p-2 fs-5" href="booking.php"> Booking </a>
                <a class="nav-item nav-link m-2 p-2 fs-5" href="about_contact.php"> About Us & Contact </a>

                <?php if(isset($_SESSION['loggedin'])) : ?>
                    <a class="nav-item nav-link m-2 p-2 fs-5" href="myaccount.php"> <?php echo $_SESSION['user_email'] ?> </a>
                    <a class="nav-item nav-link m-2 p-2 fs-5" href="logout.php"> Logout </a>
                <?php else : ?>
                    <a class="nav-item nav-link m-2 p-2 fs-5" href="signup.php"> Sign Up </a>
                    <a class="nav-item nav-link m-2 p-2 fs-5" href="login.php"> Login </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>