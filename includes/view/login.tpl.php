<?php include './includes/view/partials/header.php' ?>
<?php include './includes/view/partials/navbar.php' ?>
<?php include './includes/view/partials/bg.php' ?>

<div class="container d-flex mt-5 justify-content-center">
    <form action="process_login.php" class="p-1 p-md-5 rounded-3 login-form col-12 col-md-8 col-lg-5 col-xl-4" method="post">

        <div class="input-wrapper m-2 m-sm-3">
            <div class="mt-3 text-center text-sm-start">Email</div>
            <input type="text" id="email" name="email" class="p-1 w-100 border-0 rounded-2 py-2 py-md-1" value="<?php echo $login_email ?? ''; ?>">
        
            <div class="mt-3 text-center text-sm-start">Password</div>
            <input type="password" id="parola" name="password" class="p-1 w-100 border-0 rounded-2 py-2 py-md-1">
        </div>

        <?php if($login_error) : ?>
            <div class="my-3 text-danger text-center">
                <span>Error: <?php echo $login_error; ?> </span>
            </div>
        <?php endif; ?>

        <div class="g-recaptcha d-flex justify-content-center align-items-center" data-sitekey="6Lczd7odAAAAAHImqW8Q6MqYYiq8_3rM4K5sJmSn"></div>
        <?php if($captcha_error) : ?>
                <div class="text-danger text-center">Error: <?php echo $captcha_error; ?> </div>
        <?php endif; ?>

        <div class="text-center">
            <button type="submit" class="btn btn-primary mt-5">Login</button>
        </div>
        
        <div class="my-4 text-center">
            <span>Don't have an account?</span>
            <a href="signup.php">Sign up</a>
        </div>
    </form>

</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<?php include './includes/view/partials/footer.php' ?>
 