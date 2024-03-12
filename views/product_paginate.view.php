<?php if(count($productList->productList) == 0):?>
  <span>Không có sản phẩm!</span>
<?php endif?>
<div class="product__container grid-full-app grid-4-col-auto" id="render-cart">
  <?php foreach ($productList->productList as $product): ?>
    <div class="cart">
      <a href="/2LKShop/product/<?php echo $product->getProductLine() ?>" class="cart__item">
        <img src="/2LKShop/public/images/thumbNail/<?php echo $product->getThumbNail() ?>" alt="" class="cart__img" />
        <div class="cart__wrapper">
          <h3 class="cart__name font-size-1">
            <?php echo $product->getProductName() ?>
          </h3>
          <span class="cart__price font-color-1">
            <?php echo number_format($product->getPrice()) ?>
          </span>
          <button class="btn btn__primary btn__primary--active add-to-cart">
            Thêm vào giỏ
          </button>
        </div>
      </a>
    </div>
  <?php endforeach ?>
</div>