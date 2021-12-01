<?php include './view/partials/header.php' ?>
<?php include './view/partials/navbar.php' ?>
<?php include './view/partials/bg.php' ?>

<div class="container-fluid p-3 my-5">
    <?php foreach($facilities as $fac) : ?>
        <div class="p-0 m-5 rounded rounded-3 bg-dark text-light d-flex gap-3 align-items-center">
            <div class="col-8">
                <!-- carousel start -->
                <div id="<?php echo str_replace(' ', '', $fac['denumire']) . '-carousel' ?>" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <!-- loop images -->
                        <?php foreach($fac['imgs'] as $index => $img_src) : ?>
                            <div class="carousel-item <?php if($index === 0)echo "active"; ?>">
                                <img src="<?php echo $img_src ?>" class="d-block w-100" alt="...">
                            </div>
                        <?php endforeach ?>
                        <!-- end loop images -->
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#<?php echo str_replace(' ', '', $fac['denumire']) . '-carousel' ?>" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#<?php echo str_replace(' ', '', $fac['denumire']) . '-carousel' ?>" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <!-- carousel end -->
            </div>
            <div class="col p-3">
                <div class="h3 text-center">
                    <?php echo $fac['denumire'] ?>
                    <hr>
                </div>
                <div class="fs-5 px-3 py-3 m-3">
                    <?php echo $fac['descriere'] ?>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>

<?php include './view/partials/footer.php' ?>