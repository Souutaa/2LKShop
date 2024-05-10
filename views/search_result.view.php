
<div class="breadcrumb container">
  <a href="/2LKShop" class="breadcrumb__link text-color--4 font-size-2">
    <svg class="icon">
      <use xlink:href="/2LKShop/public/images/SVG/symbol-defs.svg#icon-home"></use>
    </svg>
    <span class="">Trang chủ</span>
  </a>
  <svg class="icon text-color--2">
    <use xlink:href="/2LKShop/public/images/SVG/symbol-defs.svg#icon-chevron-right"></use>
  </svg>
  <a href="" class="breadcrumb__link">
    <span class="text-color--2"><?php echo $searchStr?></span>
  </a>
</div>
<section class="container u-margin-bottom-big">
  <div class="filter-product">
    <div class="filter-price">
      <div class="filter-range">
        <div id="nonlinear" class="noUi-target noUi-ltr noUi-horizontal"></div>
        <span class="example-val" id="lower-value"></span>
        <span class="example-val" id="upper-value"></span>
      </div>
    </div>

    <div class="filter-options">
      <label for="status-select " class="form__label font-size-1">Filter:</label>
      <select class="form-select form__input" id="status-select" name="filterType" style="
          font-size: 1.5rem;
      ">
        <option selected value="DEFAULT">Sản phẩm nổi bật</option>
        <option value="PRICE_ASC">Giá: Tăng dần</option>
        <option value="PRICE_DESC">Giá: Giảm dần</option>
        <option value="NAME_ASC">Tên: A - Z</option>
        <option value="NAME_DESC">Tên: Z - A</option>
      </select>
    </div>
    <div class="filter-selections">
      <div class="filter-selection filter-price-checkbox">
        <h4 class="font-size-1 text-color--3">Giá:</h4>
        <div class="form__checkbox-box">
          <div class="form__field--inline">
            <input type="checkbox" class="form__input" id="price-range-1" data-range-min="100000"
              data-range-max='500000' />
            <label class="form-check-label" for="price-range-1">100.000đ - 500.000đ</label>
          </div>
          <div class="form__field--inline">
            <input type="checkbox" class="form__input" id="price-range-2" data-range-min="500000"
              data-range-max='2000000' />
            <label class="form-check-label" for="price-range-2">500.000đ - 2.000.000đ</label>
          </div>
          <div class="form__field--inline">
            <input type="checkbox" class="form__input" id="price-range-3" data-range-min="2000000"
              data-range-max='10000000' />
            <label class="form-check-label" for="price-range-3">2.000.000đ - 10.000.000đ</label>
          </div>
          <div class="form__field--inline">
            <input type="checkbox" class="form__input" id="price-range-4" data-range-min="10000000"
              data-range-max='20000000' />
            <label class="form-check-label" for="price-range-4">10.000.000đ - 20.000.000đ</label>
          </div>
          <div class="form__field--inline">
            <input type="checkbox" class="form__input" id="price-range-5" data-range-min="20000000"
              data-range-max='50000000' />
            <label class="form-check-label" for="price-range-5">20.000.000đ - 50.000.000đ</label>
          </div>
          <div class="form__field--inline">
            <input type="checkbox" class="form__input" id="price-range-6" data-range-min="50000000"
              data-range-max='75000000' />
            <label class="form-check-label" for="price-range-6">50.000.000đ - 75.000.000đ</label>
          </div>
          <div class="form__field--inline">
            <input type="checkbox" class="form__input" id="price-range-7" data-range-min="75000000"
              data-range-max='100000000' />
            <label class="form-check-label" for="price-range-7">75.000.000đ - 100.000.000đ</label>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="search__container container div-8-col">
  <h2 class="heading__secondary u-center-text u-margin-bottom-medium grid-full-app">
    Kết quả tìm kiếm cho “<span class="search__text-input"><?php echo $searchStr ?></span>”
  </h2>
  <div class="search__list">
    <?php foreach ($productList->productList as $product): ?>
        <div class="search__item">
          <img src="/2LKSHOP/public/images/thumbNail/<?php echo $product->getThumbnail() ?>" alt="<?php echo $product->getProductName() ?>" class="search__item-img" />
          <div class="search__item-info-box">
            <h3 class="search__item-name font-size-1 text-color--4">
              <?php echo $product->getProductName() ?>
            </h3>
            <span class="search__item-price text-color--4 font-size-1"><?php echo number_format($product->getPrice()) ?></span>
            <a href="/2LKShop/product/<?php echo $product->getProductLine() ?>" class="btn btn__primary btn__primary--active see-product-detail">
              Xem sản phẩm
            </a>
          </div>
        </div>
    <?php endforeach ?>
  </div>
</div>
<!-- <script src="/2LKShop/public/js/filter.js"></script> -->
<script src="/2LKShop/public/js/productPagination.js"></script>
<script src="https://unpkg.com/nouislider@10.0.0/distribute/nouislider.min.js"></script>
<script>
  var nonLinearSlider = document.getElementById("nonlinear");

  noUiSlider.create(nonLinearSlider, {
    connect: true,
    behaviour: "tap",
    step: 50000,
    start: [50000, 50000000],
    range: {
      min: 50000,
      max: 50000000,
    },
    format: wNumb({
      decimals: 0,
      thousand: ',',
      suffix: 'đ'
    })
  });

  var nodes = [
    document.getElementById("lower-value"), // 0
    document.getElementById("upper-value"), // 1
  ];

  // Display the slider value and how far the handle moved
  // from the left edge of the slider.
  nonLinearSlider.noUiSlider.on(
    "update",
    function (values, handle, unencoded, isTap, positions) {
      nodes[handle].innerHTML = values[handle];
      verifyBoxes(values);
    }
  );

  function verifyBoxes(v) {
    var boxesArr = [].slice
      .call(document.querySelectorAll(".box"))
      .map(function (item) {
        return item;
      });

    for (var i = 0; i < boxesArr.length; i++) {
      var box = boxesArr[i];
      var price = box.querySelector(".price").textContent;
      var priceNumb = parseInt(price);
      var vMin = v[0];
      var vMax = v[1];

      if (priceNumb > vMax || priceNumb < vMin) {
        box.classList.add("-close");
      } else {
        box.classList.remove("-close");
      }
    }
  }
</script>
