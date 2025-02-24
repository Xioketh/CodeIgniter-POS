<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<h3>Orders List</h3>

<div class="p-3">
    <div class="mb-3">
        <div class="row">
            <label for="orderDate" class="form-label col-md-2">Order Date:</label>
            <div class="col-md-6">
                <input type="date" class="form-control" id="orderDate" name="orderDate">
            </div>
            <div class="col-md-2">
                <button class="btn btn-success w-100" onclick="searchOrder()">Search</button>
            </div>
        </div>
    </div>

    <ul class="nav nav-tabs" id="orderTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="placed-tab" data-bs-toggle="tab" href="#placedOrders" role="tab">Placed Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="hold-tab" data-bs-toggle="tab" href="#holdOrders" role="tab">Hold Orders</a>
        </li>
    </ul>

    <div class="tab-content mt-3">
        <div class="tab-pane fade show active" id="placedOrders">
            <table class="table table-striped display nowrap" id="placedOrdersTable" style="width:100%">
                <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="holdOrders">
            <table class="table table-striped display nowrap" id="holdOrdersTable" style="width:100%">
                <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Order Items Modal -->
<div class="modal fade" id="orderItemsModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Items</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Food Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody id="orderItemsTableBody"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#placedOrdersTable').DataTable({
            responsive: true,
            scrollX: true
        });

        $('#holdOrdersTable').DataTable({
            responsive: true,
            scrollX: true
        });
    });

    function searchOrder() {
        const orderDate = document.getElementById('orderDate').value;

        fetch('/orders/search', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'orderDate=' + orderDate
        })
            .then(response => response.json())
            .then(data => {
                updateTable('placedOrdersTable', data.placedOrders);
                updateTable('holdOrdersTable', data.holdOrders);
            })
            .catch(error => console.error('Error:', error));
    }

    function updateTable(tableId, orders) {
        const table = $('#' + tableId).DataTable();
        table.clear().draw();

        orders.forEach(order => {
            table.row.add([
                order.order_id,
                order.order_date,
                order.tot_qty,
                order.total_price,
                `<button class="btn btn-primary btn-sm" onclick="viewOrderItems('${order.order_id}', '${tableId}')">View</button>`
            ]).draw();
        });
    }

    function viewOrderItems(orderId, tableId) {
        fetch('/orders/getOrderItems', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'order_id=' + orderId
        })
            .then(response => response.json())
            .then(data => {
                updateOrderItemsTable(data, tableId);
                $('#orderItemsModal').modal('show');
            })
            .catch(error => console.error('Error fetching order items:', error));
    }

    function updateOrderItemsTable(items, tableId) {
        const tbody = document.getElementById('orderItemsTableBody');
        tbody.innerHTML = '';

        if (items.length === 0) {
            tbody.innerHTML = '<tr><td colspan="4" class="text-center">No items found.</td></tr>';
            return;
        }

        items.forEach(item => {
            const row = tbody.insertRow();
            row.insertCell().textContent = item.food_name;
            row.insertCell().textContent = item.qty;
            row.insertCell().textContent = item.unit_price;
            row.insertCell().textContent = item.total;
        });

        if (tableId !== 'placedOrdersTable') {
            addPlaceOrderButton(items[0].order_id);
        }
    }

    function addPlaceOrderButton(orderId) {
        const modalBody = document.querySelector('#orderItemsModal .modal-body');

        const existingButton = document.getElementById('placeOrderButton');
        if (existingButton) existingButton.remove();

        const placeOrderBtn = document.createElement('button');
        placeOrderBtn.id = 'placeOrderButton';
        placeOrderBtn.textContent = 'Place Order';
        placeOrderBtn.className = 'btn btn-success mt-3';
        placeOrderBtn.onclick = () => changeStatusOfOrder(orderId);

        modalBody.appendChild(placeOrderBtn);
    }

    function changeStatusOfOrder(orderId) {
        fetch('/orders/changeOrderStatus', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'order_id=' + orderId
        })
            .then(response => response.json())
            .then(data => {
                Swal.fire({
                    text: `Order placed successfully! Order ID: ${orderId}`,
                    icon: 'success',
                    confirmButtonText: 'Ok'
                }).then(() => {
                    $('#orderItemsModal').modal('hide');
                    searchOrder();
                });
            })
            .catch(error => console.error('Error updating order:', error));
    }
</script>

<?= $this->endSection() ?>
