<?php if (count($orders->orders) == 0): ?>
  <div class="user-order__empty">
    <img src="/2LKShop/public/images/SVG/cart-illustartion.svg" alt="" class="u-margin-bottom-big" />
    <h3 class="heading__secondary">Bạn chưa có đơn hàng nào</h3>
    <p class="para--sm text-color--2 u-margin-bottom-medium">
      Hãy lên đơn cùng chúng tôi nào
    </p>
  </div>
<?php else: ?>
  <?php foreach ($subOrders->orders as $order): ?>
    <div class="user-order__item div-16-col">
      <p class="user-order__id">#
        <?php echo $order->getId() ?>
      </p>
      <p class="user-order__name">
        <?php echo $user->getUsername() ?>
      </p>
      <p class="user-order__date-order">
        <?php echo $order->getCreatedAt() ?>
      </p>
      <p class="user-order__total-price">
        <?php echo number_format($order->getTotal()) ?>đ
      </p>
      <?php ?>
      <p class="user-order__status <?php echo getOrderStatusClass($order->getStatusId()) ?>"><?php echo $order->getStatusName() ?></p>
      <a href="<?php echo str_replace("{orderId}", $order->getId(), getPath($routes, 'viewOrderDetail')) ?>"
        class="btn-order__detail btn btn__primary">Chi tiết hóa đơn</a>
    </div>
  <?php endforeach; ?>
  <nav>
    <ul class="pagination">
      <button class="page-item pagination_btn <?php if (($_GET['offset'] ?? 0) == 0)
        echo "disabled" ?>" id="next-btn"
          data-offset="<?php echo ($_GET['offset'] ?? 0) - 5 ?>" <?php if (($_GET['offset'] ?? 0) == 0)
                   echo "disabled" ?>>
          <a class="page-link" href="javascript:void(0);">Previous</a>
        </button>
        <div id="page-items" class='d-flex'>
        </div>
        <button class="page-item pagination_btn
      <?php if (($_GET['offset'] ?? 0) >= count($orders->orders) - 5)
                   echo "disabled" ?>" id="next-btn"
          data-offset="<?php echo ($_GET['offset'] ?? 0) + 5 ?>" <?php if (($_GET['offset'] ?? 0) >= count($orders->orders) - 5)
                   echo "disabled" ?>>
          <a class="page-link" href="javascript:void(0);">Next</a>
        </button>
      </ul>
    </nav>
<?php endif ?>
<script>
  $(document).ready(function () {
    $('#page-items').empty();
    for (let i = 0; i < Math.ceil(<?php echo count($orders->orders) ?> / 5); i++) {
      if (i * 5 == <?php echo $_GET['offset'] ?? 0 ?>) {
        $('#page-items').append(`
          <li class="page-item active" data-offset="${i * 5}">
            <a class="page-link" href="javascript:void(0);">${i + 1}</a>
          </li>
        `)
      } else {
        $('#page-items').append(`
          <li class="page-item" data-offset="${i * 5}">
            <a class="page-link" href="javascript:void(0);">${i + 1}</a>
          </li>
        `)
      }
    }
    $('.page-item:not(:disabled)').click(function () {
      $.ajax({
        method: 'get',
        url: "<?php echo getPath($routes, 'viewOrders') ?>",
        data: {
          "statusCode": $('.user-order__title--active').attr('data-status-id'),
          "offset": ($(this).attr('data-offset'))
        },
        success: function (res) {
          $('.user-order__list').html(res);
        }
      })
    })
  })

</script>