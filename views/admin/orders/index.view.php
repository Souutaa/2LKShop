
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="page-title-box">
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item">
              <a href="javascript: void(0);">TechShop</a>
            </li>

            <li class="breadcrumb-item active">Orders</li>
          </ol>
        </div>
        <h4 class="page-title">Orders</h4>
      </div>
    </div>
  </div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="row mb-2">
          <div class="col-xl-8">
            <form class="row gy-2 gx-2 align-items-center justify-content-xl-start justify-content-between">
              <!-- <div class="col-auto">
                <div class="d-flex align-items-center">
                  <label for="status-select" class="me-2">Status</label>
                  <select class="form-select" id="status-select">
                    <option selected="" value="0">Choose...</option>
                    <option value="1">Đang xử lý</option>
                    <option value="3">Đang giao</option>
                    <option value="4">Hoàn thành</option>
                    <option value="5">Đã hủy</option>
                  </select>
                </div>
              </div>
              <div class="col-1">
                <button class="btn btn-primary" id="filter-btn" type="button">Apply</button>
              </div> -->
            </form>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-centered mb-0" id="orders-datatable">
            <thead class="table-light">
              <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Payment Status</th>
                <th>Total</th>
                <th>Order Status</th>
                <th style="width: 125px">Action</th>
              </tr>
            </thead>
            <tbody id="user-order__list">
              <?php require ("order_list.view.php") ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- end card-body-->
    </div>
    <!-- end card-->
  </div>
  <!-- end col -->
</div>

<div id="order-detail" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="detailModal">

    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $("#filter-btn").click(function(e) {
      e.preventDefault();
      let statusId = $('#status-select').val();
      $.ajax({
        method: 'get',
        url: "<?php echo getPath($routes, 'adminOrders') ?>",
        data: {
          "statusCode": JSON.stringify(statusId)
        },
        success: function (res) {
          console.log(res)
          $('#user-order__list').html(res);
        }
      })
    })
  })

  $(document).ready(function () {
    $('#order-detail').on('shown.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var productId = button.data('order-id')
      $.ajax({
        type: 'get',
        url: `/2LKShop/admin/order/detail/${productId}`,
        success: function (res) {
          $('#detailModal').html(res)
        }
      })
    })
  })

</script>

<script>

  $(document).ready(function () {
    $("#orders-datatable").DataTable({
      language: {
        paginate: {
          previous: "<i class='mdi mdi-chevron-left'>",
          next: "<i class='mdi mdi-chevron-right'>"
        },
        info: "Showing orders _START_ to _END_ of _TOTAL_",
        lengthMenu: 'Display <select class=\'form-select form-select-sm ms-1 me-1\'><option value="5">5</option><option value="10">10</option><option value="20">20</option><option value="-1">All</option></select> products'
      },
      pageLength: 5,
      columns: [
        {
          orderable: !0
        }, {
          orderable: !0
        }, {
          orderable: !0
        }, {
          orderable: !0
        }, {
          orderable: !0
        }, {
          orderable: !1
        }],
      select: {
        style: "multi"
      },
      order: [[1, "dec"]],
      drawCallback: function () {
        $(".dataTables_paginate > .pagination").addClass("pagination-rounded"),
          $("#products-datatable_length label").addClass("form-label")
      }
    })
  });
</script>