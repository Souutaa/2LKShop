<?php 
  $user = getSessionUser();

?>

<div class="order-detail__container div-12-col">
  <h4 class="heading__territory u-margin-bottom-medium grid-full-app">
    Các sản phẩm từ hóa đơn <span class="order__id">#
      <?php echo $data['data']['OrderID'] ?>
    </span>
  </h4>
  <div class="col-sm-12">
    <?php if ($data['data']['StatusID'] == 5 || $data['data']['StatusID'] == 4 || !(in_array('Or_Edit', $user->getPermissions()))): ?>
      <div class="col-sm-6">
        <label for="status-select" class="form-label">Trạng thái đơn hàng</label>
        <span class="badge <?php echo getOrderStatusClassAdmin($data['data']['StatusID']) ?>"><?php echo $data['data']['StatusName'] ?></span>
        </select>
      </div>
    <?php else: ?>
      <div class="col-sm-6">
        <label for="status-select" class="form-label">Trạng thái đơn hàng</label>
        <select class="form-select" name="order_status" id="status-select">
          <?php foreach ($statusList->statusList as $status): ?>
            <option value=<?php echo $status->getStatusId() ?>     <?php if ($data['data']['StatusID'] == $status->getStatusId())
                      echo "selected" ?>><?php echo $status->getStatusName() ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-auto">
        <button class="btn btn-primary" type="submit" id="update-status-btn"
          data-order-id="<?php echo $data['data']['OrderID'] ?>">
          Save change
        </button>
      </div>
    <?php endif; ?>
  </div>
  <div class="order-detail__wrapper">
    <div class="order-detail__titles div-8-col">
      <h4 class="order-detail__title font-size-1 text-color--4">
        Sản phẩm
      </h4>
      <h4 class="order-detail__title font-size-1 text-color--4">
        Số lượng
      </h4>
      <h4 class="order-detail__title font-size-1 text-color--4">Giá</h4>
      <h4 class="order-detail__title font-size-1 text-color--4">
        Tổng
      </h4>
    </div>
    <?php
    $total = 0;
    $discount = 0;
    ?>
    <?php foreach ($data['products'] as $product):
      $total += $product['purchasePrice'] * $product['quantity'];
      $discount += $product['purchasePrice'] * ($product['purchaseDiscount'] / 100);
      ?>
      <div class="order-detail__item div-8-col">
        <div class="order-detail__product-name font-size-2 text-color--4">
          <?php echo $product['Product_Name'] ?>
          <?php if (strtotime($product['warranty_period'] ?? '') > strtotime(date('Y-m-d', time()))): ?>
            <span class="order-detail__product-warranty">Bảo hàng đến:
              <?php echo $product['warranty_period'] ?>
            </span>
          <?php else: ?>
            <span class="order-detail__product-warranty">Hết bảo hành</span>
          <?php endif ?>
        </div>
        <p class="order-detail__product-quantity font-size-2 text-color--4">
          <?php echo $product['quantity'] ?>
        </p>
        <p class="order-detail__product-price font-size-2 text-color--4">
          <?php echo number_format($product['purchasePrice']) ?>đ
        </p>
        <p class="order-detail__product-total-price font-size-2 text-color--4">
          <?php echo number_format($product['purchasePrice'] * $product['quantity']) ?>đ
        </p>
      </div>
    <?php endforeach ?>
  </div>
  <div class="order-detail__summary">
    <div class="shopping-cart__price">
      <span class="font-size-2 text-color--2 price-total">Tổng</span>
      <span class="font-size-4 text-color--2" id="order-detail__total-price">
        <?php echo number_format($total) ?>₫
      </span>
    </div>
    <div class="shopping-cart__price price-reduce">
      <span class="font-size-2 text-color--2">Giảm giá</span>
      <span class="font-size-4 color--red" id="order-detail__reduce">-
        <?php echo number_format($discount) ?>₫
      </span>
    </div>
    <div class="shopping-cart__price">
      <span class="font-size-1 text-color--1 price-last-total" id="order-detai__last-total">Tổng cộng:</span>
      <span class="font-size-1 color--btn">
        <?php echo number_format($data['data']['Total']) ?>₫
      </span>
    </div>
  </div>
  <div class="order-detail__ship-information">
    <h2 class="order-detail__receiver font-size-1 text-color--4">
      <?php echo $data['data']['fullname'] ?>
    </h2>
    <p class="order-detail__tel text-color--4">
      <?php echo $data['data']['phoneNumber'] ?>
    </p>
    <p class="order-detail__address text-color--4">
      <?php echo $data['data']['address'] ?>
    </p>
    <p class="order-detail__note text-color--4">
      <?php echo $data['data']['note'] ?>
    </p>
  </div>
  <div class="mb-3 modal-footer">
    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
      Close
    </button>
  </div>
</div>

<script>

  $(document).ready(function () {
    $('#update-status-btn').click(function () {
      let orderStatus = $('#status-select').find(":selected").val()
      let orderId = $(this).attr('data-order-id');
      $.ajax({
        type: 'post',
        url: '/2LKShop/admin/order/updateStatus',
        data: {
          'orderStatus': JSON.stringify(orderStatus),
          'orderId': JSON.stringify(orderId),
        },
        success: function (res) {
          Swal.fire({
            title: 'Success!',
            text: 'Order status updated!',
            icon: 'success',
            confirmButtonTeNxt: 'Cool!'
          }).then(() => {
            location.reload();
          })
        }
      })
    })
  })

</script>