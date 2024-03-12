<div class="breadcrumb container">
  <a href="<?php echo getPath($routes, 'homepage')?>" class="breadcrumb__link text-color--1">
    <svg class="icon">
      <use xlink:href="/2LKShop/public/images/SVG/symbol-defs.svg#icon-home"></use>
    </svg>
    <span class="para--sm">Trang chủ</span>
  </a>
  <svg class="icon text-color--2">
    <use xlink:href="/2LKShop/public/images/SVG/symbol-defs.svg#icon-chevron-right"></use>
  </svg>
  <a href="" class="breadcrumb__link">
    <span class="para--sm text-color--2">Giỏ hàng</span>
  </a>
</div>
<section class="shopping-cart container div-8-col mb-4">
</section>

<script>

  function calculateTotalPrice() {
    const priceList = document.querySelectorAll('.shopping-cart__item-price')
    const productQuantity = document.querySelectorAll('.shopping-cart__quantity-box > input')
    let total = 0
    let discount = 0;
    for (let i = 0; i < priceList.length; i++) {
      total += priceList[i].getAttribute('data-price') * productQuantity[i].value
      discount += priceList[i].getAttribute('data-price') * ((priceList[i].getAttribute('data-discount')/100)) * productQuantity[i].value
    }
    $('#price-total').text(`${formatPrice(total)}`)
    $('#discount-total').text(`${formatPrice(discount)}`)
    $('#price-last-total').text(`${formatPrice(total - discount)}`)
    localStorage.setItem('cartTotal', JSON.stringify({
      total,
      discount,
    }))
  }

  function deleteItemFromCart(productId) {
    let cart = JSON.parse(localStorage.getItem('cart'))
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        delete cart[productId]
        Swal.fire(
          'Deleted!',
          'Your file has been deleted.',
          'success'
        )
        localStorage.setItem('cart', JSON.stringify(cart))
        $(`.shopping-cart__item-${productId}`).remove();
        calculateTotalPrice();
        return true;
      } 
      else {
        return false;
      }
    })
  }

  $(document).ready(function (e) {
    let cart = {}
    if (localStorage.getItem('cart')) {
      cart = JSON.parse(localStorage.getItem('cart'))
    }

    if (Object.keys(cart).length > 0) {
      $('.shopping-cart.container').html(`
        <div class="shopping-cart__left">
          <div class="shopping-cart__title div-16-col ">
            <p class="text-color--1 font-size-1 gd--1">Hình ảnh</p>
            <p class="text-color--1 font-size-1 gd--2">Tên sản phẩm</p>
            <p class="text-color--1 font-size-1 gd--3">Giá bán</p>
            <p class="text-color--1 font-size-1 gd--4">Số lượng</p>
            <p class="text-color--1 font-size-1 gd--5"></p>
          </div>
          <div class="shopping-cart__list-item">
          </div>
        </div>
        <div class="shopping-cart__right">
          <!-- <div class="shopping-cart__promotion-box u-margin-bottom-medium">
            <input type="text" class="shopping-cart__promotion form__input" placeholder="Mã giảm giá" />
            <button class="btn btn__secondary btn--size-1" type="submit">
              Thêm
            </button>
          </div> -->
          <h3 class="heading__territory u-margin-bottom-small">Tổng tiền:</h3>
          <div class="shopping-cart__price-box u-margin-bottom-medium">
            <div class="shopping-cart__price">
              <span class="font-size-2 text-color--2 price-total">Tổng</span>
              <span class="font-size-4 text-color--2" id="price-total">0₫</span>
            </div>
            <div class="shopping-cart__price price-reduce">
              <span class="font-size-2 text-color--2">Giảm giá</span>
              <span class="font-size-4 color--red" id="discount-total">0₫</span>
            </div>
            <hr class="hr" />
            <div class="shopping-cart__price">
              <span class="font-size-1 text-color--1 price-last-total">Tổng cộng:</span>
              <span class="font-size-1 color--btn" id="price-last-total">0₫</span>
            </div>
          </div>
          <div class="shopping-cart__rule-box">
            <input type="checkbox" name="" id="shopping-cart__rule" required />
            <p class="font-size-3 text-color--2">
              Tôi đã đọc và đồng ý với
              <span class="color--btn">điều khoản và điều kiện</span> của
              website
            </p>
          </div>
          <a href="<?php echo getPath($routes, 'paymentInfo') ?>" class="btn btn__secondary btn__secondary--active u-center-text">Thanh toán
          </a>
        </div>
      `)
      
      $.ajax({
        method: 'get',
        data: {
          cartItems: JSON.stringify(cart)
        },
        url: "<?php echo getPath($routes, 'getCartItems')?>",
        success: (function (res) {
          const productList = JSON.parse(res)
          for(let index in productList) {
            $('.shopping-cart__list-item').append(`
              <div class="shopping-cart__item-${productList[index].productLine} div-16-col" >
                <img src="/2LKShop/public/images/thumbNail/${productList[index].thumbnail}" alt="${productList[index].name}" class="shopping-cart__item-img gd--1" />
                <div class="shopping-cart__item-info gd--2">
                  <h3 class="shopping-cart__item-name font-size-4 text-color--4">
                    ${productList[index].name}
                  </h3>
                </div>
                <h3 class="shopping-cart__item-price font-size-4 text-color--4 gd--3" data-price='${productList[index].price}' data-discount='${productList[index].discount}'>
                  ${formatPrice(productList[index].price)}
                </h3>
                <div class="shopping-cart__quantity-box gd--4">
                  <input type="number" min="0" max="${productList[index].stock}" step="1" value="${productList[index].quantity}" 
                  class="shopping-cart__item-quantity" data-id="${productList[index].productLine}"/>
                </div>
                <svg class="shopping-cart__item-trash icon gd--5 u-margin-top-sm" onClick="deleteItemFromCart('${productList[index].productLine}')">
                  <use xlink:href="/2LKShop/public/images/svg/symbol-defs.svg#icon-trash"></use>
                </svg>
              </div>
            `)
          }
          calculateTotalPrice();
          $('.shopping-cart__item-quantity').click(function(e) {
            let productId = $(this).attr('data-id')
            if (e.target.value <= 0) {
              if(!deleteItemFromCart(productId)) {
                e.target.value = 1;
                cart = {
                  ...cart,
                  [productId]: +e.target.value
                }
                localStorage.setItem('cart', JSON.stringify(cart))
              }
            } else {
              cart = {
                ...cart,
                [productId]: +e.target.value
              }
              localStorage.setItem('cart', JSON.stringify(cart))
            }
            calculateTotalPrice();
          })
        })
      })
      
    } else {
      $('.shopping-cart.container').html(
        `
          <div class="shopping-cart__empty">
            <img src="/2LKShop/public/images/SVG/cart-illustartion.svg" alt="" />
            <h3 class="heading__secondary">Giỏ hàng của bạn trống</h3>
            <p class="para--sm text-color--2 u-margin-bottom-medium">
              Có vẻ bạn chưa thêm mặt hàng nào vào giỏ
            </p>
            <a
              href="<?php echo getPath($routes, 'homepage')?>"
              class="btn btn__primary btn__primary--active u-center-text"
            >
              Tiếp tục mua sắm
            </a>
          </div>
      `)
    }

  })
</script>