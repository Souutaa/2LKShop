<?php foreach ($orders->orders as $order): ?>
  <tr>
    <td>
      <a href="apps-ecommerce-orders-details.html" class="text-body fw-bold">#
        <?php echo $order->getId() ?>
      </a>
    </td>
    <td>
      <?php echo $order->getCreatedAt() ?>
    </td>
    <td>
      <h5>
        <?php echo $order->getUsername() ?>
      </h5>
    </td>
    <td>
      <?php echo number_format($order->getTotal()) ?>₫
    </td>
    <td>
      <h5>
        <span class="badge <?php echo getOrderStatusClassAdmin($order->getStatusId()) ?>"><?php echo $order->getStatusName() ?></span>
      </h5>
    </td>
    <td>
      <button class="action-icon btn" data-bs-toggle="modal"
        data-bs-target="#order-detail" 
        id="view-order-detail"
        data-order-id="<?php echo $order->getId()?>"
        >
        <i class="mdi mdi-square-edit-outline"></i></button>
    </td>
  </tr>
<?php endforeach ?>