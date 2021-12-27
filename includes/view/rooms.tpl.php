<?php include './includes/view/partials/header.php' ?>
<?php include './includes/view/partials/navbar.php' ?>
<?php include './includes/view/partials/bg.php' ?>

<div class="container p-3 my-5">
    <?php foreach($types as $type) : ?>
        <div class="p-5 m-4 rounded rounded-3 room-container">
            <div class="h3 text-center room-title">
                <?php echo $type['nume'] ?>
                <hr>
            </div>

            <!-- carousel start -->
            <div id="<?php echo str_replace(' ', '', $type['nume']) . '-carousel' ?>" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <!-- loop images -->
                    <?php foreach($type['imgs'] as $index => $img_src) : ?>
                        <div class="carousel-item <?php if($index === 0)echo "active"; ?>">
                            <img src="<?php echo $img_src ?>" class="d-block w-100" alt="...">
                        </div>
                    <?php endforeach ?>
                    <!-- end loop images -->
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#<?php echo str_replace(' ', '', $type['nume']) . '-carousel' ?>" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#<?php echo str_replace(' ', '', $type['nume']) . '-carousel' ?>" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <!-- carousel end -->
            <div class="fs-5 px-5 py-3 m-4">
                <?php echo $type['descriere'] ?>
            </div>

            <div class="fs-4 text-center">
                Maximum guests: <?php echo $type['capacitate'] ?>
            </div>
        </div>
    <?php endforeach ?>
</div>

<?php include './includes/view/partials/footer.php' ?>