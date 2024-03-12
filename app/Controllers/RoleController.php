<?php
namespace App\Controllers;

use App\Models\Permission;
use App\Models\PermissionGroups;
use App\Models\Permissions;
use App\Models\Role;
use App\Models\Roles;
use App\Models\User;
use App\Models\Users;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouteCollection;

class RoleController {
  public function getRolePermissionAction(RouteCollection $routes, Request $request) {
    startSession();
    $permissions = new Permissions();
    $role = json_decode($_GET['role']);
    $permissions->getAll($role);
    require_once APP_ROOT . ('/views/admin/permissions/permission_tables.view.php');
  }

  public function toggleDisableRoleAction(RouteCollection $routes, Request $request) {
    startSession();
    $role = new Role();
    $roleId = json_decode($_POST['roleId']);
    $state = json_decode($_POST['state']);
    $role->updateRoleState($roleId, $state);
  }

  public function createRoleAction(RouteCollection $routes, Request $request) {
    startSession();
    $role = new Role();
    $role->createRole($_POST);
  }
  
  public function editRoleAction(RouteCollection $routes, Request $request) {
    startSession();
    $role = new Role();
    $role->updateRole($_POST);
    print_r($_POST);
  }

  public function getEditRoleFormAction(RouteCollection $routes, Request $request) {
    startSession();
    $role = new Role();
    $role->read(json_decode($_GET['roleId']));
    require_once APP_ROOT . ('/views/admin/roles/edit.view.php');
  }

  public function deleteRoleAction(RouteCollection $routes, Request $request) {
    startSession();
    $role = new Role();
  }
}