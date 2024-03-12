<?php
namespace App\Controllers;

use App\Models\Product;
use App\Models\Products;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouteCollection;

class CartController {

  public function indexAction(RouteCollection $routes, Request $request) {
    startSession();
    $name = 'user/cart/index';
    require_once APP_ROOT . '/views/layout.view.php';
  }

  public function getCartItemsAction(RouteCollection $routes, Request $request) {
    $items = json_decode($_GET['cartItems']);
    $productsDetail = [];
    foreach($items as $key => $item) {
      $product = new Product();
      $product->read($key);
      $productsDetail[] = (object) array(
        'productLine' => $product->getProductLine(),
        'name' => $product->getProductName(),
        'price' => ($product->getPrice()),
        'quantity' => $item,
        'discount' => $product->getDiscount(),
        'stock' => $product->getStock(),
        'thumbnail' => $product->getThumbnail()
      );
    }
    echo json_encode($productsDetail);
  }

  public function paymentInfoAction(RouteCollection $routes, Request $request) {
    startSession();
    $name = 'user/cart/payment_info';
    require_once APP_ROOT . '/views/layout.view.php';
  }
} 