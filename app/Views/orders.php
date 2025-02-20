<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

    <h3>Orders List</h3>

    <div class="p-3">
        <div class="mb-3">
            <div class="row">
                <label for="orderDate" class="form-label">Order Date:</label>
                <div class="col-md-6">
                    <input type="date" class="form-control" id="orderDate" name="orderDate">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-success" onclick="searchOrder()">Search</button>
                </div>
            </div>
        </div>

        <ul class="nav nav-tabs" id="orderTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="placed-tab" data-bs-toggle="tab" href="#placedOrders" role="tab" aria-controls="placedOrders" aria-selected="true">Placed Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="hold-tab" data-bs-toggle="tab" href="#holdOrders" role="tab" aria-controls="holdOrders" aria-selected="false">Hold Orders</a>
            </li>
        </ul>

        <div class="tab-content" id="orderTabsContent">
            <div class="tab-pane fade show active" id="placedOrders" role="tabpanel" aria-labelledby="placed-tab">
                <table class="table" id="placedOrdersTable">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order ID (from table)</th>
                        <th>Date</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="holdOrders" role="tabpanel" aria-labelledby="hold-tab">
                <table class="table" id="holdOrdersTable">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order ID (from table)</th>
                        <th>Date</th>
                        <th>Reason</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        function searchOrder() {
            const orderDate = document.getElementById('orderDate').value;

            // Make an AJAX request to your CodeIgniter controller
            fetch('/orders/search', { // Replace /orders/search with your actual route
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded', // Important for form data
                    'X-Requested-With': 'XMLHttpRequest' // Identify as AJAX request
                },
                body: 'orderDate=' + orderDate // Send the date as POST data
            })
                .then(response => response.json())
                .then(data => {
                    // Update the tables with the received data
                    updateTable('placedOrdersTable', data.placedOrders);
                    updateTable('holdOrdersTable', data.holdOrders);
                })
                .catch(error => console.error('Error:', error));
        }

        function updateTable(tableId, orders) {
            const table = document.getElementById(tableId);
            const tbody = table.querySelector('tbody');
            tbody.innerHTML = ''; // Clear existing rows

            console.log('orders')
            console.log(orders)
            if (orders.length === 0) {
                tbody.innerHTML = '<tr><td colspan="4">No orders found.</td></tr>';
                return; // Exit early
            }

            orders.forEach(order => {
                const row = tbody.insertRow();
                row.insertCell().textContent = order.id; // Or order.order_id if it's in the data
                row.insertCell().textContent = order.order_id; // The actual order_id from the database
                row.insertCell().textContent = order.order_date;
                if (tableId === 'placedOrdersTable') {
                    row.insertCell().textContent = order.total_price;
                } else {
                    row.insertCell().textContent = order.status === 0 ? 'Hold' : 'Unknown';  // Or a more descriptive reason
                }
            });
        }
    </script>

<?= $this->endSection() ?>
