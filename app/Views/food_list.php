<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<h3>Foods List</h3>
<div class="container mt-4">


    <!-- Category Selection Grid -->
    <div class="row mb-4">
        <?php foreach ($categories as $category): ?>
            <div class="col-md-3 col-sm-6 mb-3" onclick="fetchFoods(<?= $category['id'] ?>)" style="cursor: pointer">
                <div class="card category-card shadow-sm">
                    <!--                        <img src="-->
                    <?php //= $category['image'] ?? 'https://via.placeholder.com/150' ?><!--" class="card-img-top" alt="-->
                    <?php //= $category['name'] ?><!--" style="width: 100%; height: 200px; object-fit: cover;">-->
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= $category['name'] ?></h5>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <hr>

    <!-- Food Items (Initially Hidden) -->
    <div id="foodContainer" style="display: none;">
        <h3 id="selectedCategoryTitle" class="mt-4"></h3>
        <div class="row" id="foodsList"></div>
    </div>


    <div id="selectedFoodsSummary" class="alert alert-info mt-4" style="display: none;">
        <h5>Total Items: <span id="totalQuantity">0</span></h5>
        <h5>Total Price: Rs.<span id="totalPrice">0</span></h5>
    </div>

    <!-- Selected Foods Table -->
    <div id="selectedFoodsTable" class="mt-4" style="display: none;">
        <hr>
        <h3>Selected Foods</h3>
        <button class="btn btn-success m-0 p-1" onclick="placeOrder(1)">Place</button>
        <button class="btn btn-danger m-0 p-1" onclick="placeOrder(0)">Hold</button>
        <table class="table table-bordered mt-1">
            <thead>
            <tr>
                <th>Food Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="selectedFoodsList">
            <!-- Selected foods will be dynamically added here -->
            </tbody>
        </table>
    </div>
</div>

<script>
    let selectedFoods = [];

    function placeOrder(status) {
        console.log('Placing order:', selectedFoods);

        fetch('/order/placeOrder', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                    selectedFoods: selectedFoods,
                    status: status
                }
            )
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                Swal.fire({
                    title: '',
                    text: status === 1 ? `Order placed successfully! Order ID: ${data.order_id}` : `Order hold successfully! Order ID: ${data.order_id}`,
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonText: 'Ok',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        resetOrder();
                    }
                })
            })
            .catch(error => console.error('Error:', error));
    }

    function fetchFoods(categoryId) {
        console.log('here')
        let foodContainer = document.getElementById("foodContainer");
        let foodsList = document.getElementById("foodsList");
        let categoryTitle = document.getElementById("selectedCategoryTitle");

        foodsList.innerHTML = "";
        foodContainer.style.display = "none";

        if (categoryId) {
            fetch(`/foods/${categoryId}`)
                .then(response => response.json())
                .then(foods => {
                    if (foods.length > 0) {
                        foodContainer.style.display = "block";

                        // Render food items
                        foods.forEach(food => {
                            let foodCard = `
                                <div class="col-md-4 col-lg-3 food-item">
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-body">
                                            <h5 class="card-title">${food.name}</h5>
                                            <p class="text-success fw-bold">Rs.${food.price}</p>
                                            <div class="input-group mb-3">
                                                <input type="number" class="form-control food-qty" id="qty-${food.id}" min="0" value="0" onchange="toggleSelectButton(${food.id})">
                                                <button class="btn btn-primary select-btn" id="btn-${food.id}" onclick="selectFood(${food.id}, '${food.name}', ${food.price})" disabled>Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            foodsList.innerHTML += foodCard;
                        });
                    }
                });
        }
    }

    function toggleSelectButton(foodId) {
        let qtyInput = document.getElementById(`qty-${foodId}`);
        let selectButton = document.getElementById(`btn-${foodId}`);
        selectButton.disabled = qtyInput.value <= 0;
    }

    function selectFood(foodId, foodName, foodPrice) {
        let qtyInput = document.getElementById(`qty-${foodId}`);
        let selectButton = document.getElementById(`btn-${foodId}`);
        let qty = parseInt(qtyInput.value);

        if (qty > 0) {
            // Disable input and button
            qtyInput.disabled = true;
            selectButton.disabled = true;

            // Add to selected foods list
            selectedFoods.push({id: foodId, name: foodName, price: foodPrice, quantity: qty, total: foodPrice * qty});
            updateSelectedFoodsTable(foodId);
        }
    }

    function updateSelectedFoodsTable() {
        let tableBody = document.getElementById("selectedFoodsList");
        let selectedFoodsTable = document.getElementById("selectedFoodsTable");

        let selectedFoodsSummary = document.getElementById("selectedFoodsSummary");
        let totalQuantitySpan = document.getElementById("totalQuantity");
        let totalPriceSpan = document.getElementById("totalPrice");

        tableBody.innerHTML = "";

        let totalQuantity = 0;
        let totalPrice = 0;

        selectedFoods.forEach((food, index) => {
            let total = food.price * food.quantity;
            totalQuantity += food.quantity;
            totalPrice += total;

            let row = `
                <tr>
                    <td>${food.name}</td>
                    <td>${food.quantity}</td>
                    <td>Rs.${food.price}</td>
                    <td>Rs.${total}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="removeSelectedFood(${index})">Remove</button>
                    </td>
                </tr>
            `;
            tableBody.innerHTML += row;
        });

        // Show the table if there are selected foods
        selectedFoodsTable.style.display = selectedFoods.length > 0 ? "block" : "none";

        selectedFoods.forEach((food) => {
            let qtyInput = document.getElementById(`qty-${food.id}`);
            let selectButton = document.getElementById(`btn-${food.id}`);

            qtyInput.disabled = false;
            qtyInput.value = 0; // Reset quantity to 0
            selectButton.disabled = true; // Disable select button
        });


        // Show or hide elements based on selection
        // selectedFoodsTable.style.display = selectedFoods.length > 0 ? "block" : "none";
        // selectedFoodsSummary.style.display = selectedFoods.length > 0 ? "block" : "none";

        // Update total values
        // totalQuantitySpan.textContent = totalQuantity;
        // totalPriceSpan.textContent = totalPrice
    }

    function resetOrder() {
        selectedFoods = []; // Clear selected foods array

        // Reset table content
        document.getElementById("selectedFoodsList").innerHTML = "";
        document.getElementById("selectedFoodsTable").style.display = "none";

        // Reset all quantity inputs and buttons
        document.querySelectorAll(".food-qty").forEach(input => {
            input.value = 0;
            input.disabled = false;
        });

        document.querySelectorAll(".select-btn").forEach(button => {
            button.disabled = true;
        });

        // Hide the food container
        // document.getElementById("foodContainer").style.display = "none";
    }

    function removeSelectedFood(index) {
        // Remove the food item from the selectedFoods array
        selectedFoods.splice(index, 1);

        // Re-enable the input and button for the deselected food
        let foodId = selectedFoods[index]?.id;
        if (foodId) {
            let qtyInput = document.getElementById(`qty-${foodId}`);
            let selectButton = document.getElementById(`btn-${foodId}`);
            if (qtyInput && selectButton) {
                qtyInput.disabled = false;
                selectButton.disabled = false;
            }
        }

        // Update the table
        updateSelectedFoodsTable();
    }
</script>

<?= $this->endSection() ?>
