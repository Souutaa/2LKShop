<?php

namespace App\Models;

use PDO;

class PermissionGroups {
  public $groups = [];

  public function getAll() {
    $db = connect();

    $getAllGroupSql = "SELECT * FROM `permissiongroup`";
    $getAllGroupStm = $db->prepare($getAllGroupSql);
    $getAllGroupStm->execute();

    $data = $getAllGroupStm->fetchAll(PDO::FETCH_ASSOC);

    foreach($data as $item) {
      $permissionGroup = new PermissionGroup();
      $permissionGroup->setID($item['PermisionGroupID']);
      $permissionGroup->setName($item['PermisionGroupName']);
      $permissionGroup->setDescription($item['Description']);
      $permissionGroup->setDisabled($item['Disabled']); 
      $this->groups[] = $permissionGroup;
    }

    return $this;
  }
}