<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to CodeIgniter 4!</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- STYLES -->

    <style>
        body {
            display: flex;
        }
        #sidebar {
            width: 250px;
            height: 100vh;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
        }
        #sidebar a {
            color: white;
            display: block;
            padding: 10px;
            text-decoration: none;
        }
        #sidebar a:hover {
            background-color: #495057;
        }
        #content {
            flex-grow: 1;
            padding: 20px;
        }
    </style>
</head>
<body>

<div id="sidebar">
<!--    <h3 class="text-center">My Pos</h3>-->
    <a href="<?= base_url('food-list'); ?>">Foods List</a>
    <a href="<?= base_url('orders-list'); ?>">Orders</a>
    <a href="<?= base_url('log-in'); ?>" class="text-danger">Log Out</a>
</div>

<!-- Main Content -->
<div id="content">
    <?= $this->renderSection('content'); ?>
</div>


</body>
</html>
