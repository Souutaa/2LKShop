<!-- start page title -->
<div class="row">
  <div class="col-12">
    <div class="page-title-box">
      <div class="page-title-right">
        <form class="d-flex">
          <div class="input-group">
            <input type="text" class="form-control form-control-light" id="dash-daterange" />
            <span class="input-group-text bg-primary border-primary text-white">
              <i class="mdi mdi-calendar-range font-13"></i>
            </span>
          </div>
          <a href="javascript: void(0);" class="btn btn-primary ms-2">
            <i class="mdi mdi-autorenew"></i>
          </a>
          <a href="javascript: void(0);" class="btn btn-primary ms-1">
            <i class="mdi mdi-filter-variant"></i>
          </a>
        </form>
      </div>
      <h4 class="page-title">Dashboard</h4>
    </div>
  </div>
</div>
<!-- end page title -->
<div class="row">
  <div class="col-xl-9 col-lg-16 order-lg-2 order-xl-1">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mt-2 mb-3">Top Selling Products</h4>

        <div class="table-responsive">
          <table class="table table-centered table-nowrap table-hover mb-0">
            <tbody>
            <?php foreach ($productSeller->productSeller as $product): ?>
              <tr>
                <td style="w-75">
                  <h5 class="font-14 my-1 fw-normal w-75 text-lg-left text-wrap">
                  <?php echo $product->getProductLine() ?>
                  </h5>
                  <span class="text-muted font-13"><?php echo $product->getCreatedAt() ?></span>
                </td>
                <td>
                  <h5 class="font-14 my-1 fw-normal"><?php echo number_format($product->getPrice()) ?>đ</h5>
                  <span class="text-muted font-13">Price</span>
                </td>
                <td>
                  <h5 class="font-14 my-1 fw-normal"><?php echo $product->getTotalOrder() ?></h5>
                  <span class="text-muted font-13">Quantity</span>
                </td>
                <td>
                  <h5 class="font-14 my-1 fw-normal"><?php echo number_format($product->getPrice()*$product->getTotalOrder()) ?>đ</h5>
                  <span class="text-muted font-13">Amount</span>
                </td>
              </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
        <!-- end table-responsive-->
      </div>
      <!-- end card-body-->
    </div>
    <!-- end card-->
  </div>
  <!-- end col-->

  <div class="col-xl-3 col-lg-6 order-lg-1">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title">Total Orders</h4>

        <div id="average-orders" class="apex-charts mb-4 mt-4" >
        </div>

        <div class="chart-widget-list">
        <?php foreach ($totalStatus->totalStatus as $status): ?>
            <?php
                $class = '';
                if ($status->getOrderStatusName() == "Đã Giao") {
                  $class = 'text-success';
                } elseif ($status->getOrderStatusName() == "Đã Hủy") {
                  $class = 'text-danger';
                } elseif ($status->getOrderStatusName() == "Đang Giao") {
                  $class = 'text-primary';
                }
                else $class= 'text-warning';
            ?>
            <p>
                <i class="mdi mdi-square <?php echo $class ?>"></i> <?php echo $status->getOrderStatusName() ?>
                <span class="float-end"> <?php echo $status->getOrderStatusTotal() ?></span>
            </p>
          <?php endforeach ?>
        </div>
      </div>
      <!-- end card-body-->
    </div>
    <!-- end card-->
  </div>
  <!-- end col-->
</div>
<div class="row">
  <div class="col-xl-9">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mb-4">Revenue of month</h4>
        <?php
          $revenues = []; // Initialize an empty array to store monthly revenues

          // Loop through 12 months of current year
          for ($month = 1; $month <= 12; $month++) {
            $revenue = 0; // Initialize revenue as 0
            foreach ($RevenueOfMonth->RevenueOfMonth as $status) {
              // Get the revenue for the current month if available
              if ($status->getMonth() == $month ) {
                $revenue = $status->getTotalRevenue();
                break;
              }
            }
            $revenues[] = $revenue; // Add monthly revenue to the array
          }
        ?>
        <div id="average-revenue" class="apex-charts mb-4 mt-4">
        </div>
      </div>
      <!-- end card body-->
    </div>
    <!-- end card -->
  </div>
  <!--  -->
</div>
<script>

  $(document).ready(function() {
    var options = {
      chart: {
        type: 'donut'
      },
      colors:['#ffbc00','#fa5c7c','#0acf97','#727cf5','#ffbc00'],
      fill: {
        colors: ['#ffbc00','#fa5c7c','#0acf97','#727cf5','#ffbc00'],
      },
      series: [
        <?php foreach ($totalStatus->totalStatus as $status): ?>
          <?php echo $status->getOrderStatusTotal() ?>,
        <?php endforeach ?>
      ],
      
      labels: ['Đang xử lý', 'Đã hủy', 'Đã giao', 'Đang Giao'],
      legend: {
        show: false
      }
      // dataLabels: {
      //   style: {
      //     colors: ['#F44336', '#E91E63', '#9C27B0','#9C27B0']
      //   }
      // },

    }

    var chart = new ApexCharts(document.querySelector("#average-orders"), options);

    chart.render();
  })

</script>
<script>
  $(document).ready(function() {
    var options = {
          series: [{
            name: "Desktops",
            data: [
              <?php foreach ($revenues as $revenue): ?>
              <?php echo $revenue ?>,
              <?php endforeach ?>
            ],
        }],
          chart: {
          height: 350,
          type: 'line',
          zoom: {
            enabled: false
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'straight'
        },
        grid: {
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
        }
    };
    var chart = new ApexCharts(document.querySelector("#average-revenue"), options);

    chart.render();
  })
</script>
