<?php include './includes/view/partials/header.php' ?>
<?php include './includes/view/partials/navbar.php' ?>
<?php include './includes/view/partials/bg.php' ?>

<?php if($can_leave_comment ?? false): ?>
    <div class="container mt-4 px-0">
        <div class="rounded rounded-3 bg-custom-light row mx-1 px-0 py-2 py-md-4 px-md-5 justify-content-center">
            <div class="h2 col-12 text-center">Write a comment</div>
            <form action="process_comment.php" method="post" class="col-12 row justify-content-center align-items-center">
                <textarea name="comment" id="comment" cols="" rows="5" class="col-12"></textarea>
                <button type="submit" class="btn btn-pink text-light mt-3 col-12 col-md-6 col-lg-3">Submit</button>
            </form>
        </div>
    </div>
<?php endif; ?>

<?php if(!isset($comments)): ?>
    <div class="container text-center p-3 bg-custom-light text-dark my-5 fs-2">No comments yet...</div>
<?php else: ?>
    <div class="container my-5">
        <?php foreach($comments as $c): ?>
            <div class="p-3 mt-3 bg-custom-light text-dark">
                <div class="mx-3 my-2"> <?php echo $c['text'] ?> </div>
                <div class="m-3 mt-5"> written by: <span class="fw-bold"> <?php echo $c['prenume'] . ' ' . $c['nume'] ?> </span>  </div>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>

<?php include './includes/view/partials/footer.php' ?>
