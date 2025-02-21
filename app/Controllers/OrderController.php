<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\OrderItemsModel;
use CodeIgniter\Controller;

class OrderController extends Controller
{

    public function placeOrder()
    {
        $request = service('request');
        $requestData = $request->getJSON(true); // Get JSON data from frontend

        if (!$requestData || empty($requestData['selectedFoods'])) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'No items in order']);
        }

        $selectedFoods = $requestData['selectedFoods'];
        $status = isset($requestData['status']) ? (int)$requestData['status'] : 1; // Default status = 1

        $orderModel = new OrderModel();
        $orderItemsModel = new OrderItemsModel();

        // Fetch the last order ID
        $lastOrder = $orderModel->orderBy('id', 'DESC')->first();
        if ($lastOrder && isset($lastOrder['order_id'])) {
            $lastOrderId = $lastOrder['order_id'];
            $numericPart = (int)substr($lastOrderId, 3); // Extract number part
            $newOrderId = 'ORD' . str_pad($numericPart + 1, 4, '0', STR_PAD_LEFT); // Increment and format
        } else {
            $newOrderId = 'ORD0001'; // Default starting order ID
        }

        // Calculate total quantity and price
        $totalQty = array_sum(array_column($selectedFoods, 'quantity'));
        $totalPrice = array_sum(array_column($selectedFoods, 'total'));

        // Save order
        $orderData = [
            'order_id' => $newOrderId,  // Use the formatted order ID
            'order_date' => date('Y-m-d H:i:s'),
            'tot_qty' => $totalQty,
            'total_price' => $totalPrice,
            'status' => $status
        ];

        $orderModel->insert($orderData);

        // Save order items
        foreach ($selectedFoods as $food) {
            $orderItemData = [
                'order_id' => $newOrderId,  // Use the same formatted order ID
                'food_name' => $food['name'],
                'food_id' => $food['id'],
                'qty' => $food['quantity'],
                'unit_price' => $food['price'],
                'total' => $food['total']
            ];
            $orderItemsModel->insert($orderItemData);
        }

        return $this->response->setJSON(['status' => 'success', 'message' => 'OrderModel placed successfully', 'order_id' => $newOrderId]);
    }


    public function search()
    {
        $orderDate = $this->request->getPost('orderDate');
        $orderModel = new OrderModel();

        if ($orderDate) {
            $placedOrders = $orderModel
                ->like('order_date', $orderDate)
                ->where('status', 1)
                ->findAll();
            $holdOrders = $orderModel
                ->like('order_date', $orderDate)
                ->where('status', 0)
                ->findAll();

        } else {
            // Handle the case where no date is selected (e.g., show all orders or a message)
            $placedOrders = $orderModel->where('status', 1)->findAll();
            $holdOrders = $orderModel->where('status', 0)->findAll();
        }

        return $this->response->setJSON([
            'placedOrders' => $placedOrders,
            'holdOrders' => $holdOrders,
        ]);
    }


    public function getOrderItems()
    {
        $orderItemsModel = new \App\Models\OrderItemsModel();
        $orderId = $this->request->getPost('order_id');

        if (!$orderId) {
            return $this->response->setJSON(['error' => 'Missing order ID']);
        }

        $orderItems = $orderItemsModel->where('order_id', $orderId)->findAll();
        return $this->response->setJSON($orderItems);
    }

    public function changeOrderStatus()
    {
        $orderModel = new \App\Models\OrderModel();
        $orderId = $this->request->getPost('order_id');

        if (!$orderId) {
            return $this->response->setJSON(['error' => 'Missing order ID']);
        }

        $updated = $orderModel->set('status', 1)
            ->where('order_id', $orderId)
            ->update();


        if ($updated) {
            return $this->response->setJSON(['success' => 'Order placed successfully']);
        } else {
            return $this->response->setJSON(['error' => 'Failed to place order']);
        }
    }


}
