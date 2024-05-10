<?php

namespace App\Models;

use PDO;

class Permission {
  
  protected $permissionId;
  protected $permissionName;
  protected $permissionDescription;
  protected $permissionGroupId;
  protected $permissionGroupName;
  protected $disabled;

  /**
   * Get the value of permissionId
   */ 
  public function getPermissionId()
  {
    return $this->permissionId;
  }

  /**
   * Set the value of permissionId
   *
   * @return  self
   */ 
  public function setPermissionId($permissionId)
  {
    $this->permissionId = $permissionId;

    return $this;
  }

  /**
   * Get the value of permissionName
   */ 
  public function getPermissionName()
  {
    return $this->permissionName;
  }

  /**
   * Set the value of permissionName
   *
   * @return  self
   */ 
  public function setPermissionName($permissionName)
  {
    $this->permissionName = $permissionName;

    return $this;
  }

  /**
   * Get the value of permissionDescription
   */ 
  public function getPermissionDescription()
  {
    return $this->permissionDescription;
  }

  /**
   * Set the value of permissionDescription
   *
   * @return  self
   */ 
  public function setPermissionDescription($permissionDescription)
  {
    $this->permissionDescription = $permissionDescription;

    return $this;
  }

  /**
   * Get the value of permissionGroupId
   */ 
  public function getPermissionGroupId()
  {
    return $this->permissionGroupId;
  }

  /**
   * Set the value of permissionGroupId
   *
   * @return  self
   */ 
  public function setPermissionGroupId($permissionGroupId)
  {
    $this->permissionGroupId = $permissionGroupId;

    return $this;
  }

  /**
   * Get the value of permissionGroupName
   */ 
  public function getPermissionGroupName()
  {
    return $this->permissionGroupName;
  }

  /**
   * Set the value of permissionGroupName
   *
   * @return  self
   */ 
  public function setPermissionGroupName($permissionGroupName)
  {
    $this->permissionGroupName = $permissionGroupName;

    return $this;
  }

  /**
   * Get the value of disabled
   */ 
  public function getDisabled()
  {
    return $this->disabled;
  }

  /**
   * Set the value of disabled
   *
   * @return  self
   */ 
  public function setDisabled($disabled)
  {
    $this->disabled = $disabled;

    return $this;
  }

  public function createPermission(array $data) {
    $db = connect();

    $addPermissionSql = "INSERT INTO 
                        `permission` (`PermissionID`, `PermissionName`, `description`, `disabled`, `PermisionGroupID`) 
                        VALUES (:permissionID, :permissionName, :description, '0', :groupId)";
    $addPermissionStm = $db->prepare($addPermissionSql);
    $addPermissionStm->execute([
      ':permissionID' => $data["permission_id"],
      ':permissionName' => $data["permission_name"],
      ':description' => $data["permission_description"],
      ':groupId' => $data["permissionGroupId"],
    ]);
  }

  public function updatePermissionState($permissionId, $state) {
    $db = connect();

    $updateStateSql = "UPDATE `permission` 
                      SET `disabled` = :isDisabled 
                      WHERE `permission`.`PermissionID` = :permissionId";
    $updateStateStm = $db->prepare($updateStateSql);
    $updateStateStm->execute([
      ':isDisabled' => $state,
      ':permissionId' => $permissionId,
    ]);
  }

  public function addPermissionToUserGroup($permissionId, $roleId) {
    $db = connect();

    $addPermissionSql = "INSERT INTO `accountpermission` (`ID`, `PermissionID`, `TypeID`) 
                          VALUES (NULL, :permissionId, :roleId)";
    $addPermissionStm = $db->prepare($addPermissionSql);
    $addPermissionStm->execute([
      ":permissionId" => $permissionId,
      ":roleId" => $roleId,
    ]);
  }
  
  public function removePermissionToUserGroup($permissionId, $roleId) {
    $db = connect();

    $addPermissionSql = "DELETE FROM `accountpermission` 
                          WHERE `accountpermission`.`PermissionID` = :permissionId 
                          AND `accountpermission`.`TypeID` = :roleId";
    $addPermissionStm = $db->prepare($addPermissionSql);
    $addPermissionStm->execute([
      ":permissionId" => $permissionId,
      ":roleId" => $roleId,
    ]);
  }
}