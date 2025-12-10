<?php
include_once __DIR__ . '/../controllers/ControllerImages.php';

$image = ControllerImages::getImageById($summer["cover"]);
?>
<div class="col-4 p-2">
    <div class="card shadow-sm border border-1 border-dark-subtle">
        <a href="detailsSummer.php?id=<?php echo $summer["id"]; ?>">
            <img src="<?php echo htmlspecialchars($image->url); ?>" class="bd-placeholder-img card-img-top" width="100%" height="100%">
        </a>
        <div class="card-body">
            <h2 class="card-title mb-0 blue"><?php echo htmlspecialchars($summer["date"]); ?></h2>
        </div>
    </div>
</div>