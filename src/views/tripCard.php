<?php
include_once __DIR__ . '/../controllers/ControllerImages.php';

$image = ControllerImages::getImageById($trip["cover"]);
?>
<div class="col-4 p-2">
    <div class="card shadow-sm">
        <a href="detailsTrip.php?id=<?php echo $trip["id"]; ?>">
            <img src="<?php echo htmlspecialchars($image->url); ?>" class="bd-placeholder-img card-img-top" width="100%" height="100%" alt="Imagen de <?php echo htmlspecialchars($trip["place"]); ?>">
        </a>
        <div class="card-body">
            <h2 class="card-title mb-0 blue"><?php echo htmlspecialchars($trip["place"]); ?></h2>
            <p class="card-text fs-6 text-end coral fw-bold"><?php echo htmlspecialchars($trip["date"]); ?></p>
        </div>
    </div>
</div>