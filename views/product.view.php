<div class="breadcrumb container">
    <a href="<?php echo $routes->get('homepage')->getPath(); ?>" class="breadcrumb__link text-color--1 font-size-2">
        <svg class="icon">
            <use xlink:href="/2LKShop/public/images/svg/symbol-defs.svg#icon-home"></use>
        </svg>
        <span class="para--sm">Trang chủ</span>
    </a>
    <svg class="icon text-color--2">
        <use xlink:href="/2LKShop/public/images/svg/symbol-defs.svg#icon-chevron-right"></use>
    </svg>
    <a href="" class="breadcrumb__link">
        <span class="para--sm text-color--1">
            <?php echo $product->getBrandID() ?>
        </span>
    </a>
    <svg class="icon text-color--2">
        <use xlink:href="/2LKShop/public/images/svg/symbol-defs.svg#icon-chevron-right"></use>
    </svg>
    <span class="breadcrumb__link">
        <span class="para--sm text-color--2">
            <?php echo $product->getProductName() ?>
        </span>
    </span>
</div>
<section class="container product-detail__areas u-margin-bottom-huge">
    <div class="product__img--default">
        <?php if ($product->getImages()): ?>
            <img src="<?php echo "/2LKShop/public/images/productImg/" . $product->getProductLine() . "/" . $product->getImages()[0] ?>"
                alt="" />
        <?php else: ?>
            <img src="<?php echo "/2LKShop/public/images/thumbNail/" . $product->getThumbNail() ?>" alt="" />
        <?php endif ?>
    </div>
    <!-- <div class="product__img-slide-list">
        <?php foreach ($product->getImages() as $image): ?>
            <div class="product__img-slide-item">
                <img src="<?php echo "/2LKShop/public/images/productImg/" . $product->getProductLine() . "/" . $image ?>"
                    alt="" class="product__img-item" />
            </div>
        <?php endforeach; ?>
        <div class="slide__arrow slide__container">
            <svg class="arrow__item">
                <use xlink:href="/2LKShop/public/images/svg/symbol-defs.svg#icon-chevron-left"></use>
            </svg>
            <svg class="arrow__item">
                <use xlink:href="/2LKShop/public/images/svg/symbol-defs.svg#icon-chevron-right"></use>
            </svg>
        </div>
    </div> -->
    <div class="product__detail--container">
        <h3 class="heading__secondary">
            <?php echo $product->getProductName() ?>
        </h3>
        <div class="product__details">
            <?php foreach ($product->getInfor() as $productInfo): ?>
                <div class="product__detail">
                    <svg class="icon">
                        <use xlink:href="/2LKShop/public/images/svg/symbol-defs.svg#icon-checkmark-outline"></use>
                    </svg>
                    <p class="para--sm text-color--2">
                        <?php echo $productInfo ?>
                    </p>
                </div>
            <?php endforeach ?>
        </div>
        <?php if ($product->getWarrantyPeriod() != null): ?>
            <span>Bảo hành:
                <?php echo $product->getWarrantyPeriod() ?> tháng
            </span>
        <?php else: ?>
            <span>Không có bảo hành</span>
        <?php endif ?>
        <div class="product__prices">
            <?php if ($product->getDiscount() != 0): ?>
                <div class="product__price--1 heading__secondary">
                    <?php echo number_format($product->getPrice() * (1 - $product->getDiscount() / 100)) ?>₫
                </div>
                <div class="product__price--2">
                    <?php echo number_format($product->getPrice()) ?>₫
                </div>
            <?php endif ?>
            <?php if ($product->getDiscount() == 0): ?>
                <div class="product__price--1 heading__secondary">
                    <?php echo number_format($product->getPrice()) ?>₫
                </div>
            <?php endif ?>

        </div>
        <?php if ($product->getStock() <= 0): ?>
            <button type="button" class="btn btn__primary btn__primary--disabled u-center-text" disabled>
                Hết hàng
            </button>
        <?php else: ?>
            <button type="button" data-stock="<?php echo $product->getStock() ?>"
                data-id="<?php echo $product->getProductLine() ?>"
                class="add-to-cart btn btn__primary btn__primary--active u-center-text">
                Thêm vào giỏ hàng
            </button>
        <?php endif; ?>
    </div>
</section>
<script>
    $(document).ready(function (e) {
        let cart = {};
        if (localStorage.getItem('cart')) {
            cart = JSON.parse(localStorage.getItem('cart'))
        }

        <?php if (isLoggedIn()): ?>
            $('.add-to-cart').click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                const productId = $(this).attr('data-id')
                if (Object.keys(cart).find(key => key === productId)) {
                    if (+cart[productId] + 1 > $(this).attr('data-stock')) {
                        Swal.fire({
                            toast: true,
                            icon: 'error',
                            position: 'top-end',
                            title: 'Sản phẩm đã hết hàng!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else {
                        cart[productId] = +cart[productId] + 1
                        Swal.fire({
                            toast: true,
                            icon: 'success',
                            position: 'top-end',
                            title: 'Thêm sản phẩm vào giỏ hàng thành công!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                } else {
                    cart[productId] = 1
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        position: 'top-end',
                        title: 'Thêm sản phẩm vào giỏ hàng thành công!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
                localStorage.setItem('cart', JSON.stringify(cart))
            })
        <?php else: ?>
            $('.add-to-cart').click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                alert("Vui lòng đăng nhập để mua hàng!")
            })
        <?php endif ?>
    })
</script>