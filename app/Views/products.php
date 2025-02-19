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
        ],
        "Pizzas" => [
            ["name" => "Pepperoni Pizza", "price" => "$9.99", "image" => "pizza1.jpg"],
            ["name" => "Margherita", "price" => "$8.99", "image" => "pizza2.jpg"],
            ["name" => "BBQ Chicken", "price" => "$10.49", "image" => "pizza3.jpg"],
            ["name" => "Hawaiian", "price" => "$9.29", "image" => "pizza4.jpg"],
            ["name" => "Meat Lovers", "price" => "$11.99", "image" => "pizza5.jpg"],
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
                            <img src="<?= base_url('assets/images/'.$food['image']) ?>" class="card-img-top" alt="<?= $food['name'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $food['name'] ?></h5>
                                <p class="card-text text-success fw-bold"><?= $food['price'] ?></p>
                                <button class="btn btn-outline-primary w-100 select-btn" onclick="toggleSelection(this, '<?= $food['name'] ?>')">Select</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    let selectedFoods = [];

    function toggleSelection(button, foodName) {
        if (selectedFoods.includes(foodName)) {
            selectedFoods = selectedFoods.filter(item => item !== foodName);
            button.classList.remove("btn-primary");
            button.classList.add("btn-outline-primary");
            button.innerText = "Select";
        } else {
            selectedFoods.push(foodName);
            button.classList.remove("btn-outline-primary");
            button.classList.add("btn-primary");
            button.innerText = "Selected";
        }
        toggleProcessOrderButton();
    }

    function toggleProcessOrderButton() {
        let processOrderBtn = document.getElementById("processOrderBtn");
        processOrderBtn.style.display = selectedFoods.length > 0 ? "inline-block" : "none";
    }

    function processOrder() {
        alert("Processing order for: " + selectedFoods.join(", "));
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
