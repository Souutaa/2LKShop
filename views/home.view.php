<section class="slide-show container">
    <div class="sidebar">
        <div class="sidebar__item">
            <a href="/2LKShop/view/category/laptop" class="sidebar__link font-size-2 text-color--4">
                <i class="fa-solid fa-laptop sidebar__icon"></i>
                <span>Máy tính xách tay</span>
            </a>
        </div>
        <div class="sidebar__item">
            <a href="/2LKShop/view/category/pc" class="sidebar__link font-size-2 text-color--4">
                <i class="fa-solid fa-computer"></i>
                <span>Máy tính để bàn</span>
            </a>
        </div>
        <div class="sidebar__item">
            <a href="/2LKShop/view/category/vga" class="sidebar__link font-size-2 text-color--4">
                <i class="fa-solid fa-desktop"></i>
                <span>Card đồ họa</span>
            </a>
        </div>
        <div class="sidebar__item">
            <a href="/2LKShop/view/category/cpu" class="sidebar__link font-size-2 text-color--4">
                <i class="fa-solid fa-microchip"></i>
                <span>Vi xử lý</span>
            </a>
        </div>
        <div class="sidebar__item">
            <a href="/2LKShop/view/category/keyboard" class="sidebar__link font-size-2 text-color--4">
                <i class="fa-solid fa-keyboard"></i>
                <span>Bàn phím</span>
            </a>
        </div>
        <div class="sidebar__item">
            <a href="/2LKShop/view/category/mice" class="sidebar__link font-size-2 text-color--4">
                <i class="fa-regular fa-computer-mouse fontAwesome"></i>
                <span>Chuột</span>
            </a>
        </div>
        <div class="sidebar__item">
            <a href="/2LKShop/view/category/headphone" class="sidebar__link font-size-2 text-color--4">
                <i class="fa-solid fa-headphones"></i>
                <span>Tai nghe</span>
            </a>
        </div>
    </div>
    <div class="slider">
        <div class="slide"></div>
        <div class="slide__arrow"></div>
        <div class="slide__panigation"></div>
    </div>
</section>

<nav class="nav container">
    <a data-category='laptop' class="btn btn__primary nav__link">Laptop</a>
    <a data-category='pc' class="btn btn__primary nav__link">Máy bàn</a>
    <a data-category='vga' class="btn btn__primary nav__link">VGA</a>
    <a data-category='cpu' class="btn btn__primary nav__link">CPU</a>
    <a data-category='gear' class="btn btn__primary nav__link">Linh kiện</a>
</nav>
<div class="product-preview container u-margin-bottom-huge u-margin-top-big">
</div>
<script>
    $(document).ready(function (e) {
        $('.btn.btn__primary')[0].click();
    })

    $('.btn.btn__primary.nav__link').click(function (e) {
        e.preventDefault();
        $.ajax({
            method: 'GET',
            url: '<?php echo getPath($routes, 'getCategory') ?>',
            data: 'content=' + $(this).attr('data-category'),
            success: function (res) {
                $('.product-preview').html(res)

                $('.view-more').click(function (e) {
                    console.log($(this).attr('data-section'), $(this).attr('data-brand'))
                    $.redirect('/2LKShop/view/product', {
                        'category': JSON.stringify($(this).attr('data-section')),
                        'brand': JSON.stringify($(this).attr('data-brand'))
                    });
                })

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
                        alert('Vui lòng đăng nhập để mua hàng!')
                    })
                <?php endif ?>
                $('.btn.btn__primary.nav__link').removeClass('btn__primary--active')
                e.target.classList.add('btn__primary--active')
            }
        })
    })

</script>