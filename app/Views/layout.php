<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Noche Kitchen</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">

    <!-- Keep only one Bootstrap version -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
</head>

<body>

<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url('add-food'); ?>">Add Food</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url('food-list'); ?>">Foods List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url('orders-list'); ?>">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-danger" href="<?= base_url('log-in'); ?>">Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="content" style="padding: 15px; margin:10px; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);">
    <?= $this->renderSection('content'); ?>
</div>

</body>
</html>
