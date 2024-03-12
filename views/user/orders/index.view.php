<div class="user__container user__container--no-bg">
  <?php if (count($orders->orders) == 0): ?>
    <div class="user-order__empty">
      <img src="/2LKShop/public/images/SVG/cart-illustartion.svg" alt="" class="u-margin-bottom-big" />
      <h3 class="heading__secondary">Bạn chưa có đơn hàng nào</h3>
      <p class="para--sm text-color--2 u-margin-bottom-medium">
        Hãy lên đơn cùng chúng tôi nào
      </p>
    </div>
  <?php else: ?>
    <div class="user-order__titles">
      <h3 class="user-order__title text-color--2 status-change-btn user-order__title--active" data-status-id="0">
        Tất cả
      </h3>
      <h3 class="user-order__title text-color--2 status-change-btn" data-status-id="1">Đang xử lý</h3>
      <h3 class="user-order__title text-color--2 status-change-btn" data-status-id="3">Đang giao</h3>
      <h3 class="user-order__title text-color--2 status-change-btn" data-status-id="4">Hoàn thành</h3>
      <h3 class="user-order__title text-color--2 status-change-btn" data-status-id="5">Đã hủy</h3>
    </div>
    <div class="user-order__list" id="user-order__list">
      <?php require_once("order_list.view.php") ?>
    </div>
    
  <?php endif ?>
</div>

<script>
  $(document).ready(function () {
    $('.status-change-btn').click(function (e) {
      $.ajax({
        method: 'get',
        url: "<?php echo getPath($routes, 'viewOrders') ?>",
        data: {
          "statusCode": JSON.stringify($(this).attr("data-status-id"))
        },
        success: function (res) {
          $('.user-order__list').html(res);
        }
      })
      $('.status-change-btn').removeClass('user-order__title--active')
      $(this).addClass('user-order__title--active')
    })

    
  })

</script>