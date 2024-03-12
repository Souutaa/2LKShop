<?php
namespace App\Controllers;

use App\Models\Order;
use App\Models\Orders;
use App\Models\OrderStatuses;
use App\Models\User;
use App\Models\Product;
use App\Models\Products;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouteCollection;

class OrderController {
  public function viewOrdersAction(RouteCollection $routes, Request $request) {
    startSession();

    $statusCode = json_decode($_GET['statusCode'] ?? "0");
    $offset = json_decode($_GET['offset'] ?? "0");

    $user = new User();
    $user = unserialize($_SESSION['user']);

    $orders = new Orders();
    $orders->getAllOrdersById($user->getUsername(), (int)$statusCode);
    $subOrders = new Orders();
    $subOrders->getOrdersById($user->getUsername(), (int)$statusCode, (int)$offset);
    if (isset($_GET['statusCode'])) {
      $name = 'orders/order_list';
      require_once APP_ROOT . "/views/user/$name.view.php";
    } else {
      $name = 'orders/index';
      require_once APP_ROOT . '/views/user/layout.view.php';
    }
  }

  public function viewOrderDetailAction(string $orderId, RouteCollection $routes, Request $request) {
    startSession();
    $order = new Order();
    $data = $order->read($orderId);
    $name = 'orders/detail';
    require_once APP_ROOT . '/views/user/layout.view.php';
   
  }

  public function viewPersonalInformationAction(RouteCollection $routes, Request $request) {
    startSession();
    $name = 'information/index';

    if (!isLoggedIn()) {
      $_SESSION['isLoggedIn'] = false;
      redirect(getPath($routes, 'homepage'));
    }
    if (isLoggedIn()) {
      $user = new User();
      $user = unserialize($_SESSION['user']);
    }
    $userName = $user -> getUsername();
    // $data = json_decode(file_get_contents("php://input"));
    // var_dump($data);
   if(isset($_POST['jsonData'])) {
     $data = json_decode($_POST['jsonData']);
     var_dump($data);
    $user ->UpdateUserInfo($userName, $data -> user__lastName, $data->user__firstName,$data-> user__email, $data->user__tel, $data->order__addressCity, $data->order__addressDistrict, $data->order__address);
    die();
  }
    // $LastName = $_GET['user__last-name'];
    // $email = $_GET['user__email'];
    // $tel = $_GET['user__tel'];
    // $addressCity = $_GET['city'];
    // $addressDistrict = $_GET['district'];
    // $Detailaddress = $_GET['detailedAddress'];
    // print_r($_GET);

    require_once APP_ROOT . '/views/user/layout.view.php';
  }

  public function createOrderAction(RouteCollection $routes, Request $request) {
    startSession();
    $order = new Order();
    $order->createOrder($_POST);
  }

  public function cancelOrderAction(string $id, RouteCollection $routes, Request $request) {
    startSession();
    $order = new Order();
    $order->cancelOrder($id);
    print_r($order);
  }

  public function getUserOrder(string $username, RouteCollection $routes, Request $request) {
    startSession();
  }

  public function getOrderDetail(string $id, RouteCollection $routes, Request $request) {
    startSession();
    $order = new Order();
    $data = $order->read($id);
    $statusList = new OrderStatuses();
    $statusList->getAll();
    require_once APP_ROOT . '/views/admin/orders/detail.view.php';
  }

  public function updateOrderStatusAction(RouteCollection $routes, Request $request) {
    startSession();
    $id = json_decode($_POST['orderId']);
    $statusId = json_decode(($_POST['orderStatus']));
    $order = new Order();
    if ($statusId == 5) {
      $order->cancelOrder($id);
    } else {
      $order->updateOrderStatus($id, $statusId);
    }
  }

}