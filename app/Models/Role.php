<?php

namespace App\Models;

use PDO;

class Role
{
  protected $roleId;
  protected $roleName;
  protected $roleDescription;
  protected $createdAt;
  protected $deletedAt;
  protected $deteleAble;
  protected $disabled;


  /**
   * Get the value of roleId
   */
  public function getRoleId()
  {
    return $this->roleId;
  }

  /**
   * Set the value of roleId
   *
   * @return  self
   */
  public function setRoleId($roleId)
  {
    $this->roleId = $roleId;

    return $this;
  }

  /**
   * Get the value of roleName
   */
  public function getRoleName()
  {
    return $this->roleName;
  }

  /**
   * Set the value of roleName
   *
   * @return  self
   */
  public function setRoleName($roleName)
  {
    $this->roleName = $roleName;

    return $this;
  }

  /**
   * Get the value of createdAt
   */
  public function getCreatedAt()
  {
    return $this->createdAt;
  }

  /**
   * Set the value of createdAt
   *
   * @return  self
   */
  public function setCreatedAt($createdAt)
  {
    $this->createdAt = $createdAt;

    return $this;
  }

  /**
   * Get the value of deletedAt
   */
  public function getDeletedAt()
  {
    return $this->deletedAt;
  }

  /**
   * Set the value of deletedAt
   *
   * @return  self
   */
  public function setDeletedAt($deletedAt)
  {
    $this->deletedAt = $deletedAt;

    return $this;
  }

  /**
   * Get the value of deteleAble
   */
  public function getDeteleAble()
  {
    return $this->deteleAble;
  }

  /**
   * Set the value of deteleAble
   *
   * @return  self
   */
  public function setDeteleAble($deteleAble)
  {
    $this->deteleAble = $deteleAble;

    return $this;
  }



  /**
   * Get the value of roleDescription
   */
  public function getRoleDescription()
  {
    return $this->roleDescription;
  }

  /**
   * Set the value of roleDescription
   *
   * @return  self
   */
  public function setRoleDescription($roleDescription)
  {
    $this->roleDescription = $roleDescription;

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

  public function read(string $roleId) {
    $db = connect();
    $getRoleSql = "SELECT `accounttype`.*
                  FROM `accounttype`
                  WHERE `accounttype`.`accountTypeID` = :roleId;";
    $getRoleStm = $db->prepare($getRoleSql);
    $getRoleStm->execute([
      ":roleId" => $roleId
    ]);

    $data = $getRoleStm->fetch(PDO::FETCH_ASSOC);

    $this->setRoleId($data["accountTypeID"]);
    $this->setRoleName($data["TypeName"]);
    $this->setRoleDescription($data["Description"]);
    $this->setCreatedAt($data["created_at"]);
    $this->setDeletedAt($data["Deleted_at"]);
    $this->setDeteleAble($data["Delete_able"]);
    $this->setDisabled($data["Disabled"]);

    return $this;
  }

  public function createRole(array $data)
  {

    $db = connect();
    $createRoleSql = "INSERT INTO `accounttype` 
                      (`accountTypeID`, `TypeName`, `Description`, `created_at`, `modified_at`, `Deleted_at`, `Delete_able`, `Disabled`) 
                      VALUES (:roleId, :roleName, :roleDescription, current_timestamp(), NULL, NULL, '1', '0')";
    $createRoleStm = $db->prepare($createRoleSql);
    $createRoleStm->execute([
      ":roleId" => $data["roleId"],
      ":roleName" => $data["roleName"],
      ":roleDescription" => $data["role-description"],
    ]);
  }

  public function updateRole(array $data)
  {
    $db = connect();
    $updateRoleSql = "UPDATE `accounttype` 
                      SET `TypeName` = :roleName, `Description` = :roleDescription
                      WHERE `accounttype`.`accountTypeID` = :roleId";
    $updateRoleStm = $db->prepare($updateRoleSql);
    $updateRoleStm->execute([
      ":roleName" => $data["role_name"],
      ":roleDescription" => $data["role_description"],
      ":roleId" => $data["role_id"],
    ]);
  }

  public function deleteRole(string $roleId) {
    $db = connect();

    $deleteSql = "UPDATE `accounttype` SET `Deleted_at` = current_timeStamp() WHERE `accounttype`.`accountTypeID` = :roleId";
    
    $deleteStm = $db->prepare($deleteSql);
    $deleteStm->execute([
      ":roleId" => $roleId,
    ]);

  }

  public function updateRoleState($roleId, $state)
  {
    $db = connect();

    $updateStateSql = "UPDATE `accounttype` 
                      SET `Disabled` = :isDisabled 
                      WHERE `accounttype`.`accountTypeID` = :roleId";
    $updateStateStm = $db->prepare($updateStateSql);
    $updateStateStm->execute([
      ':isDisabled' => $state,
      ':roleId' => $roleId,
    ]);
  }
}