<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Foods List</h2>

    <!-- Search Bar -->
    <div class="mb-4">
        <input type="text" id="searchInput" class="form-control" placeholder="Search for food..." onkeyup="filterFoods()">
    </div>

    <!-- Process Order Button (Hidden Initially) -->
    <div class="mb-4 text-center">
        <button id="processOrderBtn" class="btn btn-success" style="display: none;" onclick="processOrder()">Process Order</button>
    </div>

    <?php
    $categories = [
        "Burgers" => [
            ["name" => "Cheese Burger", "price" => "$5.99", "image" => "burger1.jpg"],
            ["name" => "Chicken Burger", "price" => "$6.49", "image" => "burger2.jpg"],
            ["name" => "Veggie Burger", "price" => "$5.29", "image" => "burger3.jpg"],
            ["name" => "BBQ Burger", "price" => "$7.99", "image" => "burger4.jpg"],
            ["name" => "Double Burger", "price" => "$8.49", "image" => "burger5.jpg"],
        ]
    ];
    ?>

    <div id="foodContainer">
        <?php foreach ($categories as $category => $foods): ?>
            <h3 class="mt-4 category-title"><?= $category ?></h3>
            <div class="row">
                <?php foreach ($foods as $food): ?>
                    <div class="col-md-4 col-lg-3 food-item">
                        <div class="card shadow-sm mb-4">
                            <div class="card-body">
                                <h5 class="card-title"><?= $food['name'] ?></h5>
                                <p class="card-text text-success fw-bold">Price: <?= $food['price'] ?></p>
                                <input type="number" class="form-control mb-2 qty-input" min="0" value="0" oninput="updateSelection(this, '<?= $food['name'] ?>')">
                                <button class="btn btn-outline-primary w-100 select-btn" onclick="toggleSelection(this, '<?= $food['name'] ?>')" disabled>Select</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    let selectedFoods = {};

    function updateSelection(input, foodName) {
        let qty = parseInt(input.value) || 0;
        let selectBtn = input.nextElementSibling;

        selectBtn.disabled = qty === 0;
        if (qty === 0) {
            delete selectedFoods[foodName];
            selectBtn.classList.remove("btn-primary");
            selectBtn.classList.add("btn-outline-primary");
            selectBtn.innerText = "Select";
        }
        toggleProcessOrderButton();
    }

    function toggleSelection(button, foodName) {
        let qtyInput = button.previousElementSibling;
        let qty = parseInt(qtyInput.value) || 0;

        if (selectedFoods[foodName]) {
            delete selectedFoods[foodName];
            button.classList.remove("btn-primary");
            button.classList.add("btn-outline-primary");
            button.innerText = "Select";
            qtyInput.disabled = false;
        } else if (qty > 0) {
            selectedFoods[foodName] = qty;
            button.classList.remove("btn-outline-primary");
            button.classList.add("btn-primary");
            button.innerText = "Selected";
            qtyInput.disabled = true;
        }
        toggleProcessOrderButton();
    }

    function toggleProcessOrderButton() {
        let processOrderBtn = document.getElementById("processOrderBtn");
        processOrderBtn.style.display = Object.keys(selectedFoods).length > 0 ? "inline-block" : "none";
    }

    function processOrder() {
        let orderSummary = Object.entries(selectedFoods).map(([name, qty]) => `${name} (Qty: ${qty})`).join(", ");
        alert("Processing order for: " + orderSummary);
    }

    function filterFoods() {
        let searchInput = document.getElementById('searchInput').value.toLowerCase();
        let foodItems = document.querySelectorAll('.food-item');
        let categories = document.querySelectorAll('.category-title');

        foodItems.forEach(item => {
            let foodName = item.querySelector('.card-title').textContent.toLowerCase();
            item.style.display = foodName.includes(searchInput) ? "block" : "none";
        });

        categories.forEach(category => {
            let categoryRow = category.nextElementSibling;
            let visibleItems = categoryRow.querySelectorAll('.food-item[style="display: block;"]').length;
            category.style.display = visibleItems > 0 ? "block" : "none";
        });
    }
</script>

<?= $this->endSection() ?>
