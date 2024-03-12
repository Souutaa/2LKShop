
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
<div class="search__container container div-8-col">
  <p class="search__heading text-color--3 grid-full-app">
    Kết quả tìm kiếm cho “<span class="search__text-input"><?php echo $searchStr?></span>”
  </p>
  <div class="search__list">
    <?php foreach ($productList->productList as $product): ?>
      <div class="search__item">
        <img src="/2LKShop/public/images/thumbNail/<?php echo $product->getThumbnail() ?>" alt="<?php echo $product->getProductName()?>" class="search__item-img" />
        <div class="search__item-info-box">
          <h3 class="search__item-name font-size-1 text-color--4">
            <?php echo $product->getProductName()?>
          </h3>
          <span class="search__item-price text-color--4 font-size-1"><?php echo number_format($product->getPrice())?></span>
          <a href="/2LKShop/product/<?php echo $product->getProductLine()?>" class="btn btn__primary btn__primary--active see-product-detail">
            Xem sản phẩm
          </a>
        </div>
      </div>
    <?php endforeach?>
  </div>
</div>