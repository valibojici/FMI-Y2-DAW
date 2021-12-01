<?php include './view/partials/header.php' ?>
<?php include './view/partials/navbar.php' ?>
<?php include './view/partials/bg.php' ?>

<?php if(!isset($_SESSION)) session_start(); ?>

<div class="container d-flex mt-5 justify-content-center">
    <form action="process_login.php" class="p-5 rounded-3 login-form col-12 col-md-8 col-lg-5 col-xl-4" method="post">

        <div class="input-wrapper m-3">
            <div class="mt-3">Email</div>
            <input type="text" id="email" name="email" class="p-1 w-100">
        
            <div class="mt-3">Password</div>
            <input type="password" id="parola" name="password" class="p-1 w-100">
        </div>

        <?php if(isset($_SESSION['login_error'])) : ?>
            <div class="mt-4 text-danger">
                <span>Error: <?php echo $_SESSION['login_error']; ?> </span>
            </div>
        <?php endif; ?>

        <div class="text-center">
            <button type="submit" class="btn btn-primary mt-5">Login</button>
        </div>
        
        <div class="mt-4">
            <span>Don't have an account?</span>
            <a href="signup.php">Sign up</a>
        </div>
    </form>

</div>

<?php include './view/partials/footer.php' ?>
 