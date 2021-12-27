<?php include './includes/view/partials/header.php' ?>
<?php include './includes/view/partials/navbar.php' ?>
<?php include './includes/view/partials/bg.php' ?>

<?php if($can_leave_comment ?? false): ?>
    <div class="container p-3 my-3 rounded rounded-3 bg-custom-light">
        <div class="h2 text-center">Write a comment</div>
        <form action="process_comment.php" method="post" class="d-flex flex-column align-items-center">
            <textarea name="comment" id="comment" cols="50" rows="5" class=""></textarea>
            <button type="submit" class="btn btn-pink text-light mt-3">Submit</button>
        </form>
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
