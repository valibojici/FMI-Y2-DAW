<?php include './includes/view/partials/header.php' ?>
<?php include './includes/view/partials/navbar.php' ?>
<?php include './includes/view/partials/bg.php' ?>

<?php if(!isset($_SESSION)) session_start(); ?>
 
<div class="container d-flex mt-5 justify-content-center">
    <form action="process_signup.php" class="signup-form p-5 rounded-3 col-12 col-md-8 col-lg-5 col-xl-4" method="post">

        <div class="input-wrapper m-3">
            <div class="mt-3">First Name</div>
            <input type="text" id="nume" name="firstname"  class="p-1 w-100">
            <?php if(isset($_SESSION['fname_error'])) : ?>
                <div class="text-danger">Error: <?php echo $_SESSION['fname_error']; ?> </div>
            <?php endif; ?>

            <div class="mt-3">Last Name</div>
            <input type="text" id="prenume" name="lastname" class="p-1 w-100">
            <?php if(isset($_SESSION['lname_error'])) : ?>
                <div class="text-danger">Error: <?php echo $_SESSION['lname_error']; ?> </div>
            <?php endif; ?>
        
            <div class="mt-3">Phone number</div>
            <input type="text" id="telefon" name="phone" class="p-1 w-100">
            <?php if(isset($_SESSION['phone_error'])) : ?>
                <div class="text-danger">Error: <?php echo $_SESSION['phone_error']; ?> </div>
            <?php endif; ?>
        
            <div class="mt-3">Email</div>
            <input type="text" id="email" name="email" class="p-1 w-100">
            <?php if(isset($_SESSION['email_error'])) : ?>
                <div class="text-danger">Error: <?php echo $_SESSION['email_error']; ?> </div>
            <?php endif; ?>
        
            <div class="mt-3">Password</div>
            <input type="password" id="parola" name="password" class="p-1 w-100">
            <?php if(isset($_SESSION['pass_error'])) : ?>
                <div class="text-danger">Error: <?php echo $_SESSION['pass_error']; ?> </div>
            <?php endif; ?>
        </div>
        

        <div class="text-center">
            <button type="submit" class="btn btn-primary mt-5">Sign up</button>
        </div>

        <div class="mt-4">
            <span>Already have an account?</span>
            <a href="login.php">Login</a>
        </div>
    </form>

    
</div>

<?php include './includes/view/partials/footer.php' ?>