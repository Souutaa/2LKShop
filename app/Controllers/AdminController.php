<?php
namespace App\Controllers;

use App\Models\Brands;
use App\Models\Categories;
use App\Models\Dashboards;
use App\Models\Orders;
use App\Models\PermissionGroups;
use App\Models\Permissions;
use App\Models\Products;
use App\Models\Role;
use App\Models\Roles;
use App\Models\DashBoard;
use App\Models\User;
use App\Models\Users;
use App\Models\Warranties;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouteCollection;

class AdminController {
  public function indexHomeAction(RouteCollection $routes, Request $request) {
    startSession();
    $name = 'home';
    $productSeller = new Dashboards();
    $productSeller->getProductBestSeller();

    $totalStatus = new Dashboards();
    $totalStatus->getTotalOrderStatus();
    $RevenueOfMonth =new DashBoards();
    $RevenueOfMonth->getRevenue();
    require_once APP_ROOT . '/views/admin/layout.view.php';
  }

  public function indexProductAction(RouteCollection $routes, Request $request) {
    startSession();
    $user = new User();
    $user = unserialize($_SESSION['user']);
    if (!in_array('P_View', $user->getPermissions())) {
      redirect(getPath($routes, 'homepage'));
      die();
    }
    $warrantyList = new Warranties();
    $warrantyList->getAll();
    $productList = new Products();
    $productList->getAll(includeDeleted: true, includeOutOfStock: true);
    $brands = new Brands();
    $brands->readAll();
    $categories = new Categories();
    $categories->readAll();
    $name = 'product/new_index';
    require_once APP_ROOT . '/views/admin/layout.view.php';
  }

  public function indexOrderAction(RouteCollection $routes, Request $request) {
    startSession();
    $user = new User();
    $user = unserialize($_SESSION['user']);
    if (!in_array('Or_View', $user->getPermissions())) {
      redirect(getPath($routes, 'homepage'));
      die();
    }
    $statusCode = json_decode($_GET['statusCode'] ?? "0");
    $orders = new Orders();
    $orders->getAllOrders($statusCode);
    if (isset($_GET['statusCode'])) {
      $name = 'orders/order_list';
      require_once APP_ROOT . "/views/admin/$name.view.php";
    } else {
      $name = 'orders/index';
      require_once APP_ROOT . '/views/admin/layout.view.php';
    }
  }

  public function indexUserAction(RouteCollection $routes, Request $request) {
    startSession();
    $user = new User();
    $user = unserialize($_SESSION['user']);
    if (!in_array('U_View', $user->getPermissions())) {
      redirect(getPath($routes, 'homepage'));
      die();
    }
    $name = 'users/index';
    $users = new Users();
    $users->getAllUsers();
    $roles = new Roles();
    $roles->getAll();
    require_once APP_ROOT . '/views/admin/layout.view.php';
  }

  public function indexBrandAction(RouteCollection $routes, Request $request) {
    startSession();
    $user = new User();
    $user = unserialize($_SESSION['user']);
    if (!in_array('Br_View', $user->getPermissions())) {
      redirect(getPath($routes, 'homepage'));
      die();
    }
    $name = 'brand/index';    
    $BrandList = new Brands();
    $BrandList->getAllBrands();
    require_once APP_ROOT . '/views/admin/layout.view.php';
  }

  public function indexCategoryAction(RouteCollection $routes, Request $request) {
    startSession();
    $user = new User();
    $user = unserialize($_SESSION['user']);
    if (!in_array('Ca_View', $user->getPermissions())) {
      redirect(getPath($routes, 'homepage'));
      die();
    }
    $name = 'category/index';    
    $categories = new Categories();
    $categories->readAll();
    require_once APP_ROOT . '/views/admin/layout.view.php';
  }
  public function indexRoleAction(RouteCollection $routes, Request $request) {
    startSession();
    $user = new User();
    $user = unserialize($_SESSION['user']);
    if (!in_array('R_View', $user->getPermissions())) {
      redirect(getPath($routes, 'homepage'));
      die();
    }
    $roles = new Roles();
    $roles->getAll();
    $name = 'roles/index';
    require_once APP_ROOT . '/views/admin/layout.view.php';
  }

  public function indexPermissionAction(RouteCollection $routes, Request $request) {
    startSession();
    $user = new User();
    $user = unserialize($_SESSION['user']);
    if (!in_array('Per_View', $user->getPermissions())) {
      redirect(getPath($routes, 'homepage'));
      die();
    }
    $roles = new Roles();
    $roles->getAll();
    $name = 'permissions/index';
    require_once APP_ROOT . '/views/admin/layout.view.php';
  }
  
  public function indexPermissionGroupAction(RouteCollection $routes, Request $request) {
    startSession();
    $user = new User();
    $user = unserialize($_SESSION['user']);
    if (!in_array('PerGr_View', $user->getPermissions())) {
      redirect(getPath($routes, 'homepage'));
      die();
    }
    $permissionGroups = new PermissionGroups();
    $permissionGroups->getAll();
    $name = 'permissionGroups/index';
    require_once APP_ROOT . '/views/admin/layout.view.php';
  }
}