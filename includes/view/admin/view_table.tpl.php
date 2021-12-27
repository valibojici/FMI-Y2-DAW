<?php include '../includes/view/partials/header.php'  ?>

    <?php if(isset($insert_error)): ?>
        <div class="alert alert-danger text-center" role="alert">
            <?php echo $insert_error ?>
        </div>
    <?php elseif(isset($insert_success)): ?>
        <div class="alert alert-success text-center" role="alert">
            <?php echo 'row inserted' ?>
        </div>
    <?php endif ?>

    <?php if(isset($delete_error)): ?>
        <div class="alert alert-danger text-center" role="alert">
            <?php echo $delete_error ?>
        </div>
    <?php elseif(isset($delete_success)): ?>
        <div class="alert alert-success text-center" role="alert">
            <?php echo 'row deleted' ?>
        </div>
    <?php endif ?>

    <?php if(isset($update_error)): ?>
        <div class="alert alert-danger text-center" role="alert">
            <?php echo $update_error ?>
        </div>
    <?php elseif(isset($update_success)): ?>
        <div class="alert alert-success text-center" role="alert">
            <?php echo 'row updated' ?>
        </div>
    <?php endif ?>

    <div class="container-fluid my-5 px-5">
        <a href="index.php" class = 'text-center btn btn-primary' >Choose another table</a>
        <div class="my-3 text-center h3"> <?php echo $table_name ?> </div>
        <hr class="w-100">
        
        <!-- start insert -->
        <form action="insert.php" method="post" class="d-flex flex-row flex-wrap gap-2 align-items-center p-2 border border-3 my-3" id="insert_form">
            
            <?php foreach($col_names as $col): ?>
                <div class="d-inline m-2">
                    <span> <?php echo $col ?> </span>
                    <br>
                    <textarea name="<?php echo $col ?>"  rows="1" style="resize:both; height:auto" class="p-0"></textarea>
                </div>
            <?php endforeach ?>
            <button type="submit" class="btn btn-primary">Insert</button>
        </form>
        <!-- end insert -->

        <!-- start update -->
        <form action="update.php" method="post" class="d-flex flex-row flex-wrap gap-2 align-items-center p-2 border border-3 my-3" id="update_form">
            
            <input type="hidden" name='old_id' id="old_id" value="">
            <?php foreach($col_names as $col): ?>
                <div class="d-inline m-2">
                    <span> <?php echo $col ?> </span>
                    <br>
                    <textarea name="<?php echo $col ?>"  rows="1" style="resize:both; height:auto" class="p-0"></textarea>
                </div>
            <?php endforeach ?>
            <div class="my-2">
                <button type="submit" class="btn btn-primary mx-3">Confirm</button>
                <button type="button" class="btn btn-primary mx-3" id="cancel_update">Cancel</button>
            </div>
        </form>
        <!-- end update -->

        <?php if(isset($empty_table)): ?>
            <div class="my-3 h2 text-center">Table is empty</div>
        <?php else: ?>
            <!-- start table -->
            <div>
                <table class="table table-sm">
                    <tr>
                        <?php foreach($col_names as $col): ?>
                           <th class="text-center"> <?php echo $col ?> </th>
                        <?php endforeach ?>

                        <th class="text-center">Action</th>
                    </tr>

                    <?php foreach($rows as $row): ?>
                        <tr rowid = "<?php echo $row['id'] ?>" >
                            <?php foreach($row as $k => $v): ?>
                                <td class="align-middle text-center table-value" colname = <?php echo $k ?> > <?php echo $v ?> </td>
                            <?php endforeach ?>

                            <td class="text-center">
                                <form action="delete.php" method="post" class="d-inline-block m-1 my-3">
                                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                    <button type='button' class="btn btn-primary update_btn m-1" rowid = "<?php echo $row['id'] ?>" >Update</button>
                                    <button type="submit" class="btn btn-warning m-1">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
            <!-- end table -->
        <?php endif ?>
    </div>
    
    <script src='../js/script.js'></script>
</body>
</html>