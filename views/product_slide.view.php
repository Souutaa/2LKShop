<?php if(count($productList->productList) > 0):?>
  <div class="product-preview__catagories">
    <h2 class="heading__secondary u-margin-bottom-medium u-center-text">
      <?php if($section == "NoBrand"):?>
        <?php echo strtoupper($brand)?>
      <?php else:?>
        <?php echo $section ?>
      <?php endif?>
    </h2>
    <div class="product__container grid-4-col">
      <?php
      $count = 0;
      foreach ($productList->productList as $product): ?>
        <a href="./product/<?php echo $product->getProductLine() ?>" class="cart">
          <img src="<?php echo "/2LKShop/public/images/thumbNail/" . $product->getThumbNail() ?>" alt=""
            class="cart__img" />
          <div class="cart__wrapper">
            <h3 class="cart__name font-size-1">
              <?php echo $product->getProductName() ?>
            </h3>
            <span class="cart__price font-color-1">
              <?php echo number_format($product->getPrice()) ?>đ
            </span>
            <button class="btn btn__primary btn__primary--active add-to-cart"
              data-stock="<?php echo $product->getStock() ?>" data-id="<?php echo $product->getProductLine() ?>">
              Thêm vào giỏ
            </button>
          </div>
        </a>
        <?php
        $count++;
        if ($count >= $limit)
          break;
        ?>
      <?php endforeach; ?>
    </div>
    <button class="btn btn__secondary btn--size-1 product-see-more u-margin-top-big view-more" 
      data-section="<?php echo $brand?>" 
      data-brand="<?php echo $product->getBrandID()?>"
      type="button"
    >
      Xem thêm
    </button> 
  </div>
<?php endif;?>