<div class="order-detail__container div-8-col">
  <h4 class="heading__territory u-margin-bottom-medium grid-full-app">
    Các sản phẩm từ hóa đơn <span class="order__id">#
      <?php echo $data['data']['OrderID'] ?>
    </span>
  </h4>
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
        <a href='/2LKShop/product/<?php echo $product['Product_Line'] ?>'
          class="order-detail__product-name font-size-2 text-color--4">
          <?php echo $product['Product_Name'] ?>
          <?php if (strtotime($product['warranty_period']) > strtotime(date('Y-m-d', time()))):?>
            <span class="order-detail__product-warranty">Bảo hàng đến: <?php echo $product['warranty_period']?></span>
          <?php else: ?>
            <span class="order-detail__product-warranty">Hết bảo hành</span>
          <?php endif ?>
        </a>  
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
  <?php if ($data['data']['Status'] == 1): ?>
    <button class="btn btn__danger u-center-text grid-full-app" id="cancel-btn"
      data-order-id="<?php echo $data['data']['OrderID'] ?>">
      Hủy đơn hàng
    </button>
  <?php endif ?>
</div>

<script>
  $(document).ready(function () {
    $('#cancel-btn').click(function (e) {
      const orderId = $(this).attr('data-order-id')
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            method: 'post',
            url: `/2LKShop/cancelOrder/${orderId}`,
            success: function (res) {
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              ).then((result) => {
                if (result.isConfirmed) {
                  window.location = "<?php echo getPath($routes, 'viewOrders') ?>"
                }
              })
            }
          })
        }
        else {
          window.location = "<?php echo getPath($routes, 'viewOrders') ?>"
        }
      })
    })
  })
</script>