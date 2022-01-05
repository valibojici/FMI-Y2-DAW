<?php include './includes/view/partials/header.php' ?>
<?php include './includes/view/partials/navbar.php' ?>
<?php include './includes/view/partials/bg.php' ?>
 
<div class="container d-flex mt-5 justify-content-center">
    <form action="process_signup.php" class="signup-form p-1 p-md-5 rounded-3 col-12 col-md-8 col-lg-5 col-xl-4" method="post">

        <div class="input-wrapper m-2 m-sm-3">
            <div class="mt-3 text-center text-sm-start">First Name</div>
            <input type="text" id="nume" name="firstname"  class="p-1 w-100 border-0 rounded-2 py-2 py-md-1" value="<?php echo $fname ?? '' ?>">
            <?php if($fname_error) : ?>
                <div class="text-danger">Error: <?php echo $fname_error; ?> </div>
            <?php endif; ?>

            <div class="mt-3 text-center text-sm-start">Last Name</div>
            <input type="text" id="prenume" name="lastname" class="p-1 w-100 border-0 rounded-2 py-2 py-md-1" value = "<?php echo $lname ?? '' ?>">
            <?php if($lname_error) : ?>
                <div class="text-danger">Error: <?php echo $lname_error; ?> </div>
            <?php endif; ?>
        
            <div class="mt-3 text-center text-sm-start">Phone number</div>
            <input type="text" id="telefon" name="phone" class="p-1 w-100 border-0 rounded-2 py-2 py-md-1" value="<?php echo $phone ?? '' ?>">
            <?php if($phone_error) : ?>
                <div class="text-danger">Error: <?php echo $phone_error; ?> </div>
            <?php endif; ?>
        
            <div class="mt-3 text-center text-sm-start">Email</div>
            <input type="text" id="email" name="email" class="p-1 w-100 border-0 rounded-2 py-2 py-md-1" value="<?php echo $email ?? '' ?>">
            <?php if($email_error) : ?>
                <div class="text-danger">Error: <?php echo $email_error; ?> </div>
            <?php endif; ?>
        
            <div class="mt-3 text-center text-sm-start">Password</div>
            <input type="password" id="parola" name="password" class="p-1 w-100 border-0 rounded-2 py-2 py-md-1">
            <?php if($pass_error) : ?>
                <div class="text-danger">Error: <?php echo $pass_error; ?> </div>
            <?php endif; ?>
        </div>
        
        <div class="g-recaptcha d-flex justify-content-center align-items-center" data-sitekey="6Lczd7odAAAAAHImqW8Q6MqYYiq8_3rM4K5sJmSn"></div>
        <?php if($captcha_error) : ?>
                <div class="text-danger">Error: <?php echo $captcha_error; ?> </div>
        <?php endif; ?>

        <div class="text-center">
            <button type="submit" class="btn btn-primary mt-5">Sign up</button>
        </div>

        <div class="my-4 text-center">
            <span>Already have an account?</span>
            <a href="login.php">Login</a>
        </div>
    </form>

    
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<?php include './includes/view/partials/footer.php' ?>