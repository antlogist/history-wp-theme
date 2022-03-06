<?php
include_once('../Database/Database.php');
include_once('Order.php');
include_once('../../app/Controllers/VieworderController.php');

class OrderController extends Order {

    public function orderStore($orderToken, $homeUrl) {
      $vieworderController = new VieworderController();
      $order = $vieworderController->getOrder($homeUrl, $orderToken);

      $email = $order->shipping_email;
      $items = $order->order_metas;


      foreach ($items as $item ) {

        $orderId    = $item->order_id;
        $productId  = $item->product_id;
        $quantity   = $item->quantity;

        $query = "INSERT INTO " . $this->table . " (order_id, email, product_id, quantity, created_at)
        VALUES (
          '" . $orderId . "', '" . $email . "', '" . $productId . "', '" . $quantity . "', NOW()
        )";

        $req = $this->conn->prepare($query);
        $req->execute();
      }



      return $order;
    }
}

