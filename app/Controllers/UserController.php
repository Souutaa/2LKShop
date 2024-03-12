<?php
namespace App\Controllers;

use App\Models\Brands;
use App\Models\Categories;
use App\Models\Orders;
use App\Models\PermissionGroups;
use App\Models\Permissions;
use App\Models\Products;
use App\Models\Role;
use App\Models\Roles;
use App\Models\User;
use App\Models\Users;
use App\Models\Warranties;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouteCollection;

class UserController {

  public function getEditUserFormAction(RouteCollection $routes, Request $request) {
    startSession();
    $user = new User();
    $user -> getUser(json_decode($_GET['username']));
    $roles = new Roles();
    $roles->getAll();
    require_once APP_ROOT . '/views/admin/users/edit.view.php';
  }

  public function updateUserInfoAction(RouteCollection $routes, Request $request) {
    startSession();
    $user = new User();
    $user->updateUserDetail($_POST);
  }

  public function deactiveUserAction(RouteCollection $routes, Request $request) {
    $user = new User();
    $user->deactiveUser(json_decode($_POST['username']));
  }

}