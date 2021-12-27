<?php include '../includes/view/partials/header.php'  ?>

    <div class="text-center mt-5">
        <form action="process_login.php" method="post" class="">
            <div> Username </div>
            <input type="text" name="username">
            <div> Parola </div>
            <input type="password" name="password">
            <div class="">
                <button type="submit" class="mt-3 btn btn-primary">Login</button>
            </div>

            <?php if(isset($login_error)): ?>
                <div class="text-danger"> <?php echo $login_error ?> </div>
            <?php endif; ?>
        </form>
    </div>
    
    
</body>
</html>