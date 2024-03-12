<?php

namespace App\Models;

use PDO;

class Roles {
  public $roles = [];

  public function getAll() {
    $db = connect();
    $getRoleSql = "SELECT * FROM `accounttype`";

    $getRoleStm = $db->prepare($getRoleSql);
    $getRoleStm->execute();

    $data = $getRoleStm->fetchAll(PDO::FETCH_ASSOC);

    foreach($data as $item) {
      $role = new Role();
      $role->setRoleId($item['accountTypeID']);
      $role->setRoleName($item['TypeName']);
      $role->setRoleDescription($item['Description']);
      $role->setCreatedAt($item['created_at']);
      $role->setDeteleAble($item['Delete_able']);
      $role->setDeletedAt($item['Deleted_at']);
      $role->setDisabled($item['Disabled']);
      
      $this->roles[] = $role;
    }
    return $this;
  }
}