<?php include '../includes/view/partials/header.php'  ?>

    <div class="text-center mt-5">
        <div>
            <a href="signout.php" class="btn btn-primary">Sign out</a>
        </div>
        <div class="mt-4">
            hello <?php echo $username ?>, your permissions are: 
            <?php foreach($permissions as $p): ?>
                <span> <?php echo $p ?></span>
            <?php endforeach; ?>
        </div>
        
        <div class="mt-3">
            <form action="process_table.php" method="post" class="p-5 d-flex align-items-center justify-content-center">
                <select name="table" class="mx-3">
                    <?php foreach($tables as $t): ?>
                        <option value="<?php echo $t ?>"><?php echo $t ?></option>
                    <?php endforeach ?>
                </select>
                <button type="submit" class="btn btn-secondary"> Select table </button>
            </form>
        </div>

        <?php if(isset($error)): ?>
            <div class="text-danger mt-4"> <?php echo $error ?> </div>
        <?php endif; ?>
    </div>
    
    
</body>
</html>