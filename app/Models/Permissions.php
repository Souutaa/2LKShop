<?php

namespace App\Models;

use PDO;

class Permissions {

  public $permissions = [];
  public $activePermission = [];

  public function getPermissionsWithGroupId(string $groupId) {
    $db = connect();

    $getPermissionSql = "SELECT * FROM `permission` WHERE `permission`.`PermisionGroupID` = :group";
    $getPermissionStm = $db->prepare($getPermissionSql);

    $getPermissionStm->execute([
      ":group" => $groupId
    ]);
    $data = $getPermissionStm->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($data as $item) {
      $permission = new Permission();
      $permission->setPermissionId($item['PermissionID']);
      $permission->setPermissionName($item['PermissionName']);
      $permission->setPermissionDescription($item['description']);
      $permission->setDisabled($item['disabled']);
      $this->permissions[] = $permission; 
    }
    return $this;
  }

  public function getAll(string $userGroup) {
    $db = connect();

    $getActiveRoleSql = "SELECT `accountpermission`.*
                      FROM `accountpermission`
                      WHERE `accountpermission`.`TypeID` = :userGroup
                      ;";
    $getActiveRoleStm = $db->prepare($getActiveRoleSql);
    $getActiveRoleStm->execute([
      ":userGroup" => $userGroup
    ]);

    $data = $getActiveRoleStm->fetchAll(PDO::FETCH_ASSOC);
    foreach($data as $item) {
      $this->activePermission[] = $item['PermissionID'];
    }

    $getPermissionSql = "SELECT * FROM `permission` WHERE `permission`.`PermisionGroupID` = :group";
    $getPermissionStm = $db->prepare($getPermissionSql);

    $permissionGroups = new PermissionGroups();
    $permissionGroups->getAll();

    foreach($permissionGroups->groups as $group) {
      if ($group->getDisabled() == 1) continue;
      $getPermissionStm->execute([
        ":group" => $group->getID()
      ]);

      $data = $getPermissionStm->fetchAll(PDO::FETCH_ASSOC);
      $permissions = [];
      foreach($data as $item) {
        $permission = new Permission();
        $permission->setPermissionId($item['PermissionID']);
        $permission->setPermissionName($item['PermissionName']);
        $permission->setPermissionDescription($item['description']);
        $permission->setDisabled($item['disabled']);
        $permissions[] = $permission;
      }
      $this->permissions[] = array($group->getName() => $permissions); 
    }
    return $this;
  }

}